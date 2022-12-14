@extends('layouts.template')
@section('title', '論文作成')
@section('content')
    <h1 class="text-lg">Paper Register</h1>
    <form action="{{ route("papers.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>
            Title
            <input name="title">
        </label>

        <label>
            Memo
            <input name="memo">
        </label>

        <label>
            URL
            <input name="url">
        </label>

        <label>
            PDF
            <input name="pdf" type="file" accept="application/pdf">
        </label>

        <button type="submit">submit</button>
    </form>
@endsection
