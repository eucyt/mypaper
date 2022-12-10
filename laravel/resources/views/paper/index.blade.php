@extends('layouts.common')
@section('title', '論文一覧')
@section('content')
    <h1 class="text-lg">All Papers</h1>
    <ul>
        @foreach($papers as $paper)
            <li>
                {{ $paper->title }}
            </li>
        @endforeach
    </ul>
@endsection
