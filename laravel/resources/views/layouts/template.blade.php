<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="css/common.css"/>
    @yield('stylesheet')
</head>
<body>
@include('common.validation-message')
@yield('content')
</body>
</html>
