<?php

namespace App\Services;

use App\Http\Requests\StorePaperRequest;
use App\Http\Requests\UpdatePaperRequest;
use App\Models\Paper;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class PaperService
{
    /**
     * get all papers
     * @return LengthAwarePaginator
     */
    public function search(?string $search_sentence): LengthAwarePaginator
    {
        $query = Paper::query();

        if ($search_sentence) {
            // 全角スペースを半角に変換
            $search_sentence = mb_convert_kana($search_sentence, 's');

            $keywords = preg_split('/[\s,]+/', $search_sentence, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($keywords as $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('memo', 'like', '%' . $keyword . '%')
                        ->orWhere('author', 'like', '%' . $keyword . '%')
                        ->orWhere('journal', 'like', '%' . $keyword . '%')
                        ->orWhere('publisher', 'like', '%' . $keyword . '%')
                        ->orWhere('year', 'like', '%' . $keyword . '%');
                });
            }
        }
        return $query->latest()->paginate(15);
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
     * @throws Exception
     */
    private function uploadPdf(UploadedFile $file, string $title)
    {
        $path = '/';
        $pdf_name = $this->normalizeTitle($title) . '.pdf';
        if (Storage::disk('s3')->putFileAs($path, $file, $pdf_name) === false) {
            throw new Exception('PDFのアップロードに失敗しました。');
        }
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
        $title = str_replace("\\", "￥", $title);
        $title = str_replace("/", "／", $title);
        $title = str_replace(":", "：", $title);
        $title = str_replace("*", "＊", $title);
        $title = str_replace("?", "？", $title);
        $title = str_replace("\"", "”", $title);
        $title = str_replace("<", "＜", $title);
        $title = str_replace(">", "＞", $title);
        $title = str_replace("|", "｜", $title);
        $title = mb_convert_kana($title, 's');
        $title = str_replace(" ", "_", $title);
        $title = preg_replace('/_+/', '_', $title);
        return mb_strtolower($title);
    }

    /**
     * delete the paper
     * @param Paper $paper
     * @return bool
     */
    public function delete(Paper $paper)
    {
        return $paper->delete();
    }
}
