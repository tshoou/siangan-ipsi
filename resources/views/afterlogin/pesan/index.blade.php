@extends('template.template')

@section('title')
    Pesan Masuk
@endsection

@section('content')
    <p class="text-black text-xl font-semibold">Minggu, 12 Oktober 2022</p>
    <div class="bg-gray-100 px-1 py-3 h-full rounded-lg border border-stone-950">
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th scope="col" class="px-6 py-4 font-semibold">Dari</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Pesan</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Waktu</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Keterangan</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($pesan as $item)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="whitespace px-6 py-4 font-medium font-semibold">{{$item->sender}}</td>
                        <td class="whitespace px-6 py-4">{{$item->content}}</td>
                        <td class="whitespace px-6 py-4">{{$item->created_at->locale('id_ID')->isoFormat('LLLL')}}</td>
                        <td class="whitespace px-6 py-4">
                        @if($item->status_sekarang == 'disetujui')
                            <a class="px-7 py-4 rounded-xl border border-red-500 text-center text-red-500 font-semibold">Unduh</a>
                        @elseif($item->status_sekarang == 'revisi')
                            <a href="{{route('home2', ['peminjamanId' => $item->id_peminjaman])}}" class="px-7 py-4 rounded-xl border border-red-500 text-center text-red-500 font-semibold">Revisi</a>
                        @else
                            
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('extra-scripts')
@endsection
