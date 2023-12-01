<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{asset('style.css')}}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body class="flex flex-row">
    <nav class="w-[18%] bg-sky-950 h-screen sticky top-0">
        <div class="header flex items-center justify-center">
            <a href="{{route('home')}}" class="text-center text-white text-2xl font-semibold py-8 w-[85%] border-b-2 border-white">SIANGAN FILKOM</a>
        </div>
        <div class="menu">
            <ul class="py-8 ps-6">
                @auth('sarpra')
                    <li class="py-2 text-white font-light"><a href="{{route('riwayat.index')}}"><i class="fa-solid fa-clock-rotate-left mr-3"></i>Riwayat Peminjaman</a></li>
                    <li class="py-2 text-white font-light"><a href="{{route('logout')}}" class="text-[#FFD5CA]"><i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>Keluar</a></li>
                @endauth

                @auth('web')
                    @if(auth()->user()->BEM == 0)
                        <li class="py-2 text-white font-light"><a href="{{route('home')}}" class="active"><i class="fa-solid fa-plus text-white mr-3"></i>Tambah Peminjaman</a></li>
                        <li class="py-2 text-white font-light"><a href="{{route('riwayat.index')}}"><i class="fa-solid fa-clock-rotate-left mr-3"></i>Riwayat Peminjaman</a></li>
                        <li class="py-2 text-white font-light"><a href="{{route('pesan.index')}}"><i class="fa-regular fa-envelope mr-3"></i>Pesan Masuk</a></li>
                        <li class="py-2 text-white font-light"><a href="{{route('logout')}}" class="text-[#FFD5CA]"><i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>Keluar</a></li>
                    @else
                        <li class="py-2 text-white font-light"><a href="{{route('riwayat.index')}}"><i class="fa-solid fa-clock-rotate-left mr-3"></i>Riwayat Peminjaman</a></li>
                        <li class="py-2 text-white font-light"><a href="{{route('logout')}}" class="text-[#FFD5CA]"><i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>Keluar</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </nav>
    <div class="w-[82%] bg-white py-8 px-10 flex flex-col gap-10">
        @yield('content')
    </div>
    <script src="{{asset('script.js')}}"></script>
    <script src="https://kit.fontawesome.com/0cf4c39c1c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

    @yield('extra-scripts')
</body>
</html>