<?php

namespace App\Services;

use App\Http\Requests\StorePaperRequest;
use App\Http\Requests\UpdatePaperRequest;
use App\Models\Paper;
use Illuminate\Database\Eloquent\Collection;

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
        return Paper::create($request->all());
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
