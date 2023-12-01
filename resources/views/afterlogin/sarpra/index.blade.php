@extends('template.template')

@section('title')
    Riwayat Peminjaman
@endsection

@section('content')
    <p class="text-black text-xl font-semibold">{{$date->locale('id_ID')->isoFormat('dddd, D MMMM YYYY')}}</p>
    <div class="bg-gray-100 px-1 py-3 h-full rounded-lg border border-stone-950">
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th scope="col" class="px-6 py-4">ID</th>
                    <th scope="col" class="px-6 py-4">Ruangan</th>
                    <th scope="col" class="px-6 py-4">Nama Kegiatan</th>
                    <th scope="col" class="px-6 py-4">Jumlah Partisipan</th>
                    <th scope="col" class="px-6 py-4">Tanggal</th>
                    <th scope="col" class="px-6 py-4">Waktu Mulai</th>
                    <th scope="col" class="px-6 py-4">Waktu Selesai</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                        <th scope="col" class="px-6 py-4">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($peminjaman as $item)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="whitespace px-6 py-4 font-medium font-semibold">{{$item->id_peminjaman}}</td>
                        <td class="whitespace px-6 py-4">{{$item->nama_ruang}}</td>
                        <td class="whitespace px-6 py-4">{{$item->nama_kegiatan}}</td>
                        <td class="whitespace px-6 py-4">{{$item->jumlah_peserta}} orang</td>
                        <td class="whitespace px-6 py-4">{{$item->tgl_peminjaman->locale('id_ID')->isoFormat('Do MMMM YYYY')}}</td>
                        <td class="whitespace px-6 py-4">{{$item->waktu_mulai}}:00</td>
                        <td class="whitespace px-6 py-4">{{$item->waktu_selesai}}:00</td>
                        <td class="whitespace px-6 py-4">
                            @if($item->status_peminjaman == 'diproses')
                                <p class="bg-sky-50 border border-sky-400 rounded-xl px-2 py-1 text-sky-400 text-center">Diproses</p>
                            @elseif($item->status_peminjaman == 'belum dilihat')
                                <p class="bg-gray-50 border border-gray-400 rounded-xl px-2 py-1 text-gray-400 text-center">Belum Dilihat</p>
                            @elseif($item->status_peminjaman == 'pending')
                                <p class="bg-gray-50 border border-gray-400 rounded-xl px-2 py-1 text-gray-400 text-center">Pending</p>
                            @elseif($item->status_peminjaman == 'ditolak')
                                <p class="bg-red-50 border border-red-400 rounded-xl px-2 py-1 text-red-400 text-center">Ditolak</p>
                            @elseif($item->status_peminjaman == 'disetujui')
                                <p class="bg-green-50 border border-green-400 rounded-xl px-2 py-1 text-green-400 text-center">Disetujui</p>
                            @else
                                <p class="bg-amber-50 border border-amber-400 rounded-xl px-2 py-1 text-amber-400 text-center">Revisi</p>
                            @endif
                        </td>

                            <td class="whitespace px-6 py-4">
                                <button id="dropdown-button-{{$item->id_peminjaman}}" onclick="toggleDropdown({{$item->id_peminjaman}})" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                        </svg>
                                </button>
                                <div id="dropdown-menu-{{$item->id_peminjaman}}" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                                    <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                                        <a href="{{ asset('storage/syarat/' . $item->surat_peminjaman) }}" target="_blank" class="block px-4 py-2 mb-1 text-sm text-gray-700 rounded-md bg-white hover:bg-gray-100" role="menuitem">Lihat Surat</a>
                                        <a href="{{ asset('storage/syarat/' . $item->ktm_digital) }}" target="_blank" class="block px-4 py-2 mb-1 text-sm text-gray-700 rounded-md bg-white hover:bg-gray-100" role="menuitem">Lihat KTM</a>
                                        <a href="{{route('pengajuan.setSetuju', ['pengajuanId' => $item->id_peminjaman])}}" class="block px-4 py-2 mb-1 text-sm text-gray-700 rounded-md bg-white hover:bg-gray-100" role="menuitem">Set setuju</a>
                                        <a href="#" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block px-4 py-2 mb-1 text-sm text-gray-700 rounded-md bg-white hover:bg-gray-100" role="menuitem">Set tolak</a>
                                        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Alasan Penolakan
                                                        </h3>
                                                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">X</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-4 md:p-5">
                                                        <form class="space-y-4" action="{{route('pengajuan.setTolak', ['pengajuanId' => $item->id_peminjaman])}}" method="post">
                                                            @csrf
                                                            <div>
                                                                <textarea name="alasan" placeholder="Tuliskan alasan penolakan di sini" id="alasan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required></textarea>
                                                            </div>
                                                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('extra-scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
        let isDropdownOpen = false;
        let isModalOpen = false;

        function toggleDropdown(id) {
            const dropdownButton = document.getElementById('dropdown-button-'+id);
            const dropdownMenu = document.getElementById('dropdown-menu-'+id);
            isDropdownOpen = !isDropdownOpen;
            if (isDropdownOpen) {
                dropdownMenu.classList.remove('hidden');
            } else {
                dropdownMenu.classList.add('hidden');
            }
        }

        function toggleModal(id){
            // const modalButton = document.getElementById('dropdown-button-'+id);
            const modalMenu = document.getElementById('modal-'+id);
            isModalOpen = !isModalOpen;
            if (isModalOpen) {
                modalMenu.classList.remove('hidden');
            } else {
                modalMenu.classList.add('hidden');
            }
        }
    </script>
@endsection
