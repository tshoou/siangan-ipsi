<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Siangan FILKOM</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary">
    <nav class="bg-primary bg-red p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-white">Siangan Filkom</h1>
            <div class="md:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="hidden md:flex">
                <ul class="text-white flex items-center">
                    <li><a href="#" class="block mx-2">Beranda</a></li>
                    <li><a href="#" class="block mx-2">Ruangan Filkom</a></li>
                    @if (Route::has('login'))
                    <li>
                    @auth
                        <a  href="{{ url('/mahasiswa-dashboard') }}" 
                            class="border-secondary600 border-2 ml-2 text-white hover:bg-secondary600  py-2 px-6 inline-block rounded-sm font-semibold transition duration-300">Dashboard</a>
                    @else
                    <a  href="{{ route('login') }}" 
                            class="border-secondary600 border-2 ml-2 text-white hover:bg-secondary600  py-2 px-6 inline-block rounded-sm font-semibold transition duration-300">Login</a>
                            @if (Route::has('register'))
                            <a  href="{{ route('register') }}" 
                            class="border-secondary600 border-2 ml-2 text-white hover:bg-secondary600  py-2 px-6 inline-block rounded-sm font-semibold transition duration-300">Register</a>
                            @endif
                    @endauth
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <aside
        class="md:hidden bg-primary text-white w-64 h-screen fixed top-0 left-0 overflow-y-auto transition-transform duration-300 transform -translate-x-full md:translate-x-0">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Menu</h2>
            <ul class="space-y-2">
                <li><a href="#" class="block">Beranda</a></li>
                <li><a href="#" class="block">Berita</a></li>
                <li><a href="#" class="block">Jadwal Kuliah</a></li>
                <li><a href="#" class="block">Pengumuman</a></li>
                <li><a href="#" class="block">Kontak</a></li>
            </ul>
        </div>
    </aside>
    <script>
        // Logika untuk menampilkan/menyembunyikan sidebar pada tombol menu responsif
        const menuToggle = document.getElementById("menu-toggle");
        const sidebar = document.querySelector("aside");

        menuToggle.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
        });
    </script>
    <div class="mx-auto text-center flex justify-items-center flex-col py-44">
        <h2 class="text-4xl font-semibold mb-4 text-white">Selamat Datang di Siangan Filkom</h2>
        <p class="text-lg text-white">Aplikasi Peminjaman Ruangan Fakultas Ilmu Komputer</p>
        <div>
            <a href="#"
                class="bg-secondary600 text-white hover:bg-secondary300  py-2 px-4 mt-4 inline-block rounded-full text-md font-semibold transition duration-300">Mulai
                Sekarang</a>
        </div>
    </div>
    </div>
</body>

</html>