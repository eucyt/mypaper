<?php

namespace App\Services;

use App\Http\Requests\StorePaperRequest;
use App\Http\Requests\UpdatePaperRequest;
use App\Models\Paper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PaperService
{
    /**
     * get all papers
     * @return Collection
     */
    public function findAll(): Collection
    {
        return Paper::all();
    }

    /**
     * create a new paper
     * @param StorePaperRequest $request
     * @return void
     */
    public function create(StorePaperRequest $request)
    {
        $paper = Paper::create($request->all());

        if ($request->file('pdf')) {
            $uploaded_url = $this->uploadPdf($request->file('pdf'), $request->title);
            $paper->pdf_url = $uploaded_url;
            $paper->save();
        }
    }

    /**
     * update the paper
     * @param UpdatePaperRequest $request
     * @param Paper $paper
     * @return void
     */
    public function update(UpdatePaperRequest $request, Paper $paper)
    {
        $paper->fill($request->all())->save();

        # TODO: delete pdf
        if ($request->file('pdf')) {
            $uploaded_url = $this->uploadPdf($request->file('pdf'), $request->title);
            $paper->pdf_url = $uploaded_url;
            $paper->save();
        }
    }


    /**
     * delete paper's pdf url
     * @param Paper $paper
     * @return void
     */
    public function unregisterPdf(Paper $paper)
    {
        $paper->pdf_url = null;
        $paper->save();
    }


    /**
     * upload PDF
     * @param UploadedFile $file
     * @param string $title
     * @return string
     */
    private function uploadPdf(UploadedFile $file, string $title)
    {
        $path = '/';
        $pdf_name = $this->normalizeTitle($title) . '.pdf';
        Storage::disk('s3')->putFileAs($path, $file, $pdf_name);
        return config('filesystems.disks.s3.url') . '/'
            . config('filesystems.disks.s3.bucket') . $path . $pdf_name;
    }


    /**
     * normalize title
     * Return must have only lowercase alphabets and underscore.
     * @param string $title
     * @return string
     */
    private function normalizeTitle(string $title)
    {
        $tmp = preg_replace('/[^0-9a-zA-Z]/', '_', $title);
        return mb_strtolower(preg_replace('/_+/', '_', $tmp));
    }
}
