@extends('template.template')

@section('title')
    Tambah Peminjaman - Permintaan Diajukan
@endsection

@section('content')
    <div class="flex flex-row text-[#97A6BB] gap-4">
        <p class="active text-black">Memilih Ruangan dan Waktu Peminjaman</p>
        <div class="line my-auto line-black"></div>
        <p class="active text-black">Mengisi Form</p>
        <div class="line my-auto line-black"></div>
        <p class="active text-black">Permintaan Diajukan</p>
    </div>
    <div class="flex flex-col justify-center items-center h-full gap-4">
        <img src="{{asset('rafiki.png')}}" alt="Success" class="w-[35%]">
        <p class="text-black font-semibold text-center">Selamat! Permintaan anda sudah kami terima. Silakan <span class="text-[#E65D2E]">menyerahkan Kartu Tanda Mahasiswa ke Sekretariat BEM FILKOM UB</span> untuk melanjutkan proses peminjaman ruangan.</p>
    </div>
    <div class="flex flex-col">
        <a href="{{route('riwayat.index')}}" class="bg-[#E65D2E] rounded-xl px-7 py-2 text-center text-stone-50 text-xl font-bold leading-normal">Selanjutnya</a>
    </div>
@endsection

@section('extra-scripts')
    
@endsection