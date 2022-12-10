<?php

namespace App\Services;

use App\Http\Requests\StorePaperRequest;
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

    public function create(StorePaperRequest $request)
    {
        return Paper::create($request->all());
    }
}
