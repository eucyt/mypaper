<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    @yield('stylesheet')
</head>
<body
    class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-600">
@include('common.header')
<div class="w-full mt-6 mx-6 md:mx-auto md:w-4/5 xl:w-2/3">
    @include('common.validation-message')
    @yield('content')
</div>
</body>
</html>
