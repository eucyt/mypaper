<?php

namespace App\Services;

use App\Http\Requests\StorePaperRequest;
use App\Http\Requests\UpdatePaperRequest;
use App\Models\Paper;
use Illuminate\Database\Eloquent\Collection;
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
     * @return mixed
     */
    public function create(StorePaperRequest $request)
    {
        $paper = Paper::create($request->all());

        $pdf_file = $request->file('pdf');
        $path = '/';
        // TODO: make filename from paper title
        $pdf_name = 'tmp.pdf';
        Storage::disk('s3')->putFileAs($path, $pdf_file, $pdf_name);
        $paper->pdf_url = config('filesystems.disks.s3.url') . '/'
            . config('filesystems.disks.s3.bucket') . $path . $pdf_name;

        return $paper->save();
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
    }
}
