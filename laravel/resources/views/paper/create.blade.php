@extends('layouts.template')
@section('title', '論文作成')
@section('content')
    <h1 class="text-lg">Paper Register</h1>
    <form action="{{ route("papers.store") }}" method="POST">
        @csrf
        <input name="title">
        <input name="memo">
        <input name="url">
        <input name="pdf">

        <button type="submit">submit</button>
    </form>
@endsection
