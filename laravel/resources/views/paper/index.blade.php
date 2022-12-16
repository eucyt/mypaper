@extends('layouts.template')
@section('title', '論文一覧')
@section('content')
    <a href={{ route('papers.create') }}>
        <button type="button"
                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            新規登録
        </button>
    </a>

    <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 my-6">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Title
                </th>
                <th scope="col" class="py-3 px-6">
                    Memo
                </th>
                <th scope="col" class="py-3 px-6">
                    Author
                </th>
                <th scope="col" class="py-3 px-6">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($papers as $paper)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $paper->title }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $paper->memo }}
                    </td>
                    <td class="py-4 px-6">
                        Author
                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ route('papers.edit', $paper->id) }}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $papers->links() }}
    </div>

@endsection
