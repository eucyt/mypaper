@extends('layouts.template')
@section('title', '論文作成')
@section('content')
    <form action="{{ route("papers.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Title
                <input name="title" type="text"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </label>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Memo
                <input name="memo" type="text"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </label>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                URL
                <input name="url" type="text"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </label>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                PDF
                <input name="pdf" type="file" accept="application/pdf">
            </label>
        </div>

        <button type="submit"
                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            submit
        </button>
    </form>
@endsection
