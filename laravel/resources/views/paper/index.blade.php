@extends('layouts.template')
@section('title', '論文一覧')
@section('content')
    <a href={{ route('papers.create') }}>
        <button type="button"
                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            新規登録
        </button>
    </a>

    <form action="{{ route('papers.index') }}" method="GET">
        <div class="flex w-full">
            <label class="flex-1 pr-3">
                <input name="keyword_sentence" type="text" value="{{old("keyword_sentence")}}"
                       class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </label>

            <button type="submit"
                    class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                検索
            </button>
        </div>
    </form>

    <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 my-6 table-fixed">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="w-5/12 py-3 px-6">
                    Title
                </th>
                <th scope="col" class="w-1/3 py-3 px-6">
                    Memo
                </th>
                <th scope="col" class="w-1/12 py-3 px-6">
                    Author
                </th>
                <th scope="col" class="w-1/12 py-3 px-6">
                    Link
                </th>
                <th scope="col" class="w-1/12 py-3 px-6">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($papers as $paper)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row"
                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white truncate">
                        <a href="{{ route('papers.edit', $paper->id) }}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $paper->title }}</a>
                    </th>
                    <td class="py-4 px-6 truncate">
                        {{ $paper->memo }}
                    </td>
                    <td class="py-4 px-6 truncate">
                        {{ $paper->author }}
                    </td>
                    <td class="py-4 px-6">
                        <a href={{ $paper->url }} target="_blank"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Link
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('papers.destroy', $paper->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit"
                                    class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm px-2 py-1 text-center my-auto dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-800">
                                delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $papers->links() }}
    </div>

@endsection
