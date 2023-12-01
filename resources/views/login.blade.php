@extends('template.auth')

@section('title')
    Masuk
@endsection

@section('content')
    <div class="flex flex-col gap-3">
        <p class="text-3xl font-semibold text-white text-center">MASUK</p>
        <p class="text-white text-center font-light">Masukkan data anda untuk Masuk</p>
    </div>
    <form action="{{route('loginProcess')}}" class="flex flex-col mx-auto gap-8 justify-center w-[30%]" method="post">
        @csrf
        <div class="flex flex-col gap-4 w-[100%]">
            <div class="flex flex-col gap-2">
                <label for="nim" class="text-white">NIM</label>
                <input type="text" name="nim" id="nim" class="p-3 bg-stone-50 rounded-xl">
            </div>
            <div class="flex flex-col gap-2">
                <label for="nim" class="text-white">Kata Sandi</label>
                <div>
                    <input type="password" name="password" id="password" class="p-3 bg-stone-50 rounded-xl w-[100%]">
                    <span id="togglePassword" class="eye-icon absolute right-[36%] top-[59%] cursor-pointer"
                        onclick="togglePassword()"><i class="fa-regular fa-eye"></i></span>
                </div>
            </div>
        </div>
        <button type="submit"
            class="bg-[#E65D2E] rounded-xl px-7 py-2 text-center text-stone-50 text-xl font-bold leading-normal">Masuk</button>
    </form>
    <div>
        <p class="text-white">Belum punya akun? <a href="{{route('register')}}" class="text-[#E65D2E] hover:underline">Daftar</a></p>
    </div>
@endsection
