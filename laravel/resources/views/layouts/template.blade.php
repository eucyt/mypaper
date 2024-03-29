<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css"/>
    @yield('stylesheet')
</head>
<body
    class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-600">
@include('common.header')
<div class="max-w-full m-6">
    @include('common.validation-message')
    @yield('content')
</div>
<script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
</body>
</html>
