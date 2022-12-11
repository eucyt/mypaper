@extends('layouts.template')
@section('title', '論文一覧')
@section('content')
    <h1 class="text-lg">All Papers</h1>
    <a href={{ route('papers.create') }}>新規登録</a>
    <ul>
        @foreach($papers as $paper)
            <li>
                <a href="{{ route('papers.edit', $paper->id) }}">{{ $paper->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection
