@extends('template.auth')

@section('title')
    Daftar
@endsection

@section('content')
    <div class="flex flex-col gap-3">
            <p class="text-3xl font-semibold text-white text-center">DAFTAR</p>
            <p class="text-white text-center font-light">Masukkan data anda untuk Daftar</p>
        </div>
        <form action="{{route('registerProcess')}}" class="flex flex-col mx-auto gap-8 w-[80%] justify-center" method="post">
            @csrf
            <div class="flex flex-row gap-6">
                <div class="flex flex-col gap-4 w-[100%]">
                    <div class="flex flex-col gap-2">
                        <label for="nim" class="text-white">NIM</label>
                        <input type="text" name="nim" id="nim" class="p-3 bg-stone-50 rounded-xl">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="nim" class="text-white">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="p-3 bg-stone-50 rounded-xl">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="nim" class="text-white">Kata Sandi</label>
                        <input type="password" name="password" id="password" class="p-3 bg-stone-50 rounded-xl">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="nim" class="text-white">Nomor Telepon (Whatsapp)</label>
                        <input type="text" name="no_telp" id="no_telp" class="p-3 bg-stone-50 rounded-xl">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="nim" class="text-white">Email</label>
                        <input type="email" name="email" id="email" class="p-3 bg-stone-50 rounded-xl" placeholder="Ex: klamarr323@gmail.com">
                    </div>
                </div>
                <div class="flex flex-col gap-4 w-[100%]">
                    <div class="flex flex-col gap-2">
                        <label for="tgl_lahir" class="text-white">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="self-stretch p-3 bg-stone-50 rounded-xl">
                    </div>
                     <div class="flex flex-col gap-2">
                        <label for="alamat" class="text-white">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="self-stretch p-3 bg-stone-50 rounded-xl">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="jenis_kelamin" class="text-white">Jenis Kelamin</label>
                        <div class="flex flex-row gap-10 py-3">
                            <div class="flex flex-row gap-3">
                                <input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki">
                                <label for="jenis_kelamin" class="text-white">Laki-laki</label>
                            </div>
                             <div class="flex flex-row gap-3">
                                <input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                                <label for="jenis_kelamin" class="text-white">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="isBem" class="text-white">Apakah anda Anggota Adkeu BEM FILKOM UB?</label>
                        <div class="flex flex-row gap-10 py-3">
                            <div class="flex flex-row gap-3">
                                <input type="radio" name="isBem" id="isBem" value="1">
                                <label for="isBEM" class="text-white">Iya</label>
                            </div>
                             <div class="flex flex-row gap-3">
                                <input type="radio" name="isBem" id="isBem" value="0">
                                <label for="isBEM" class="text-white">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-[#E65D2E] rounded-xl px-7 py-2 text-center text-stone-50 text-xl font-bold leading-normal">Daftar</button>
        </form>
        <div>
            <p class="text-white">Sudah punya akun? <a href="{{route('login')}}" class="text-[#E65D2E] hover:underline">Masuk</a></p>
        </div>
@endsection
