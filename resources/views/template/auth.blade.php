<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{asset('style.css')}}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/0cf4c39c1c.js" crossorigin="anonymous"></script>
</head>
<body class="bg-sky-950 py-6">
    <div class="h-screen flex flex-col items-center justify-center gap-7">
        @yield('content')
    </div>

    <script src="{{asset('script.js')}}"></script>
</body>
</html>