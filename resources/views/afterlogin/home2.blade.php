@extends('template.template')

@section('title')
    Tambah Peminjaman - Mengisi Form
@endsection

@section('content')
    <div class="flex flex-row text-[#97A6BB] gap-4">
            <p class="active text-black">Memilih Ruangan dan Waktu Peminjaman</p>
            <div class="line my-auto line-black"></div>
            <p class="active text-black">Mengisi Form</p>
            <div class="line my-auto"></div>
            <p>Permintaan Diajukan</p>
    </div>
        <form action="{{route('store2', ['peminjamanId' => $peminjaman->id_peminjaman])}}" method="post" class="flex flex-col gap-4" enctype="multipart/form-data">
            @csrf
            <div class="py-4 px-4 bg-[#5C738E] rounded-lg flex flex-col gap-4">
                <div class="flex flex-row justify-between gap-5">
                    <div class="flex flex-row gap-10 w-[50%]">
                        <label for="nama_ruangan" class="text-white my-auto w-[40%]">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" id="nama_ruangan" class="rounded-lg px-2 py-1 w-[65%] bg-white" value="{{$peminjaman->nama_ruang}}" disabled>
                    </div>
                    <div class="flex flex-row gap-10 w-[50%]">
                        <label for="nama_ruangan" class="text-white my-auto w-[40%]">Waktu Mulai</label>
                        <input type="text" min="6" max="20" name="waktu_mulai" id="waktu_mulai" class="rounded-lg px-2 py-1 w-[65%] bg-white" value="{{$peminjaman->waktu_mulai}}" disabled>
                    </div>
                </div>
                <div class="flex flex-row justify-between gap-5">
                    <div class="flex flex-row gap-10 w-[50%]">
                        <label for="nama_ruangan" class="text-white my-auto w-[40%]">Tanggal Peminjaman</label>
                        <input type="text" name="nama_ruangan" id="nama_ruangan" class="rounded-lg px-2 py-1 w-[65%] bg-white" value="{{$peminjaman->tgl_peminjaman->locale('id_ID')->isoFormat('Do MMMM YYYY')}}" disabled>
                    </div>
                    <div class="flex flex-row gap-10 w-[50%]">
                        <label for="nama_ruangan" class="text-white my-auto w-[40%]">Waktu Selesai</label>
                        <input type="text" min="6" max="20" name="waktu_selesai" id="waktu_selesai" class="rounded-lg px-2 py-1 w-[65%] bg-white" value="{{$peminjaman->waktu_selesai}}" disabled>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="nama_kegiatan" class="text-black font-semibold text-base">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="p-2 border-black border-[1px] rounded-xl w-[100%]" value="{{$peminjaman->nama_kegiatan}}" required>
            </div>
            <div class="flex flex-col gap-2">
                <label for="jumlah_partisipan" class="text-black font-semibold">Jumlah Partisipan</label>
                <input type="number" name="jumlah_partisipan" id="jumlah_partisipan" class="p-2 border-black border-[1px] rounded-xl w-[100%]" value="{{$peminjaman->jumlah_peserta}}" required>
            </div>
            <p class="text-black font-semibold">Kumpulkan semua berkas peminjaman yang diperlukan dengan format PDF. Template Dokumen dapat diunduh memakai email UB dengan <a href="https://docs.google.com/document/d/1qAkqXOEKpQCAT-z6KnDBObclsKI7Qlk_/edit?usp=sharing&ouid=111317562926896106326&rtpof=true&sd=true" target="_blank" class="text-[#E65D2E] hover:underline">Klik di sini</a></p>
            <p class="text-black font-semibold">Berkas Peminjaman dan Kartu Tanda Mahasiswa dengan File yang dipisah</p>
                        
            <div id="dropArea" class="flex items-center justify-center w-full border-[1px] border-black rounded-lg">
                <label for="fileInput" class="flex flex-col items-center justify-center w-full border-2 pt-5 pb-6 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm py-2 px-4 bg-[#E65D2E] rounded-lg text-white"><span class="font-semibold">Jelajah</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400" id="message">Silakan upload dua file tersebut sekaligus, pastikan ktm urutan pertama dan surat peminjaman urutan kedua</p>
                    </div>
                    <div id="fileList" class="flex flex-col gap-2 w-[85%] mt-4 px-4 mx-auto">
                        
                    </div>
                    <input id="fileInput" type="file" hidden name="file[]" multiple="multiple" onchange="handleFiles()"/>
                </label>
            </div> 
            <button type="submit" class="bg-[#E65D2E] rounded-xl px-7 py-2 text-center text-stone-50 text-xl font-bold leading-normal">Selanjutnya</button>
        </form>
@endsection

@section('extra-scripts')
    <script>
        // function handleDragOver(event) {
        //     event.preventDefault();
        //     document.getElementById('dropArea').classList.add('active');
        // }

        // function handleDragLeave(event) {
        //     event.preventDefault();
        //     document.getElementById('dropArea').classList.remove('active');
        // }

        // function handleDrop(event) {
        //     event.preventDefault();
        //     document.getElementById('dropArea').classList.remove('active');

        //     var files = event.dataTransfer.files;
        //     var fileInput = document.getElementById('dropzone-file');
        //     for (var i = 0; i < files.length; i++) {
        //         fileInput.files = fileInput.files || new FileList();
        //         fileInput.files[fileInput.files.length] = files[i];
        //     }
        //     handleFiles(files);
        // }

        function handleFiles() {
            $('.filelist').remove();
            var fileInput = document.getElementById ("fileInput");
            var fileList = document.getElementById ("fileList");

            if(fileInput.files.length > 2){
                alert("Tidak bisa mengupload lebih dari dua file, silakan reload untuk memperbarui file yang telah diupload")
            }
            if ('files' in fileInput) {
                for(var i = 0; i < fileInput.files.length; i++){
                    var listItem = document.createElement('div');
                    listItem.className = 'filelist p-2 bg-gray-300 rounded-lg w-[100%]';
                    
                    var file = fileInput.files[i];
                    var fileName = document.createElement('p');
                    fileName.className = 'ml-3 text-black';
                    if ('name' in file) {
                        fileName.textContent = file.name;
                    }
                    else {
                        fileName.textContent = file.fileName;
                    }

                    var button = '<div class="flex flex-row gap-2 mx-auto"><div class="rounded-lg p-3 bg-gray-300"><i class="fa-solid fa-eye text-center"></i></div><div class="rounded-lg py-3 px-4 bg-gray-300"><i class="fa-solid fa-xmark text-center"></i></div></div>'

                    listItem.appendChild(fileName);
                    fileList.appendChild(listItem);
                }
            }

            // for (var i = 0; i < files.length; i++) {
            //     var file = files[i];
            //     var listItem = document.createElement('div');
            //     listItem.className = 'p-2 bg-gray-300 rounded-lg w-[100%]';

            //     var fileName = document.createElement('p');
            //     fileName.className = 'ml-3 text-black';
            //     fileName.textContent = file.name;

            //     var button = '<div class="flex flex-row gap-2 mx-auto"><div class="rounded-lg p-3 bg-gray-300"><i class="fa-solid fa-eye text-center"></i></div><div class="rounded-lg py-3 px-4 bg-gray-300"><i class="fa-solid fa-xmark text-center"></i></div></div>'

            //     listItem.appendChild(fileName);
            //     fileList.appendChild(listItem);
                
            // }
        }

        // Open file input when clicking on the drop area
        document.getElementById('dropArea').addEventListener('click', function () {
            document.getElementById('fileInput').click();
        });

        $(document).ready(function() {
            $('#waktu_selesai').val($('#waktu_selesai').val()+':00')
            $('#waktu_mulai').val($('#waktu_mulai').val()+':00')
        })
    </script>
@endsection