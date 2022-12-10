<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaperRequest;
use App\Http\Requests\UpdatePaperRequest;
use App\Models\Paper;
use App\Services\PaperService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PaperController extends Controller
{
    private $paper_service;

    public function __construct(PaperService $paper_service)
    {
        $this->paper_service = $paper_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $papers = $this->paper_service->findAll();
        return view('paper.index', compact("papers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('paper.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePaperRequest $request
     * @return RedirectResponse
     */
    public function store(StorePaperRequest $request)
    {
        $this->paper_service->create($request);
        return redirect()->route('paper.index')->with('message', '登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param Paper $paper
     * @return Application|Factory|View
     */
    public function show(Paper $paper)
    {
        return view('paper.show', compact('paper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Paper $paper
     * @return Response
     */
    public function edit(Paper $paper)
    {
        // TODO
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePaperRequest $request
     * @param Paper $paper
     * @return Response
     */
    public function update(UpdatePaperRequest $request, Paper $paper)
    {
        // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Paper $paper
     * @return Response
     */
    public function destroy(Paper $paper)
    {
        // TODO
    }
}