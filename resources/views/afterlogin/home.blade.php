@extends('template.template')

@section('title')
    Tambah Peminjaman - Memilih Ruangan dan Waktu Peminjaman
@endsection

@section('content')
    <div class="flex flex-row text-[#97A6BB] gap-4">
        <p class="active text-black">Memilih Ruangan dan Waktu Peminjaman</p>
        <div class="line my-auto"></div>
        <p>Mengisi Form</p>
        <div class="line my-auto"></div>
        <p>Permintaan Diajukan</p>
    </div>
    <form action="{{route('submit')}}" method="post" class="flex flex-col gap-5">
        @csrf
        <div class="horizontal-scroll-flexbox gap-3">
            @if (sizeof($ruangan) == 0)
                <p>Tidak ada ruangan terdaftar</p>
            @else
                @foreach ($ruangan as $r)
                    <input type="radio" name="ruangan" id="{{$r->id_ruangan}}" class="ruangan" value="{{$r->id_ruangan}}" required>
                    <label for="{{$r->id_ruangan}}" class="label card p-4 flex flex-col gap-3 rounded-xl w-[25%] bg-[#FAF9F9]">
                        <img src="{{asset('Frame 330.png')}}" alt="" class="rounded-md">
                        <p class="text-center text-black font-semibold">{{$r->nama_ruang}}</p>
                    </label>
                @endforeach
            @endif
        </div>
        <div class="flex flex-col gap-2">
            <label for="tgl_pinjam" class="text-black font-semibold" required>Tanggal Peminjaman</label>
            <input type="date" name="tgl_pinjam" id="tgl_pinjam" min="<?= date('Y-m-d') ?>" onchange="updateAvailableHour()"
                class="p-2 border-black border-[1px] rounded-xl w-[100%]">
        </div>
        <div class="flex flex-col gap-2">
            <label for="tgl_pinjam" class="text-black font-semibold">Waktu Mulai</label>
            <div class="flex flex-col gap-2">
                <div class="loadingSpinner mx-auto w-[100%]" style="text-align: center;">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                </div>
                <div class="flex-container gap-2" id="timeStartContainer">
                    <p class="text-center alert-text">Silakan pilih ruangan dan tanggal terlebih dahulu</p>
                    {{-- @for ($i = 6; $i <= 20; $i++)
                        <input type="radio" name="timeStart" id="timeStart{{$i}}" class="time">
                        <label for="timeStart{{$i}}"
                            class="label text-center border-black border-[1px] py-2 w-[30%] rounded-lg flex-item">{{$i}}.00</label>
                    @endfor --}}
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <label for="tgl_pinjam" class="text-black font-semibold">Waktu Selesai</label>
            <div class="flex flex-col gap-2">
                <div class="loadingSpinner mx-auto w-[100%]" style="text-align: center;">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                </div>
                <div class="flex-container gap-2" id="timeDoneContainer">
                    <p class="text-center alert-text">Silakan pilih ruangan dan tanggal terlebih dahulu</p>
                    {{-- @for ($i = 6; $i <= 20; $i++)
                        <input type="radio" name="timeDone" id="timeDone{{$i}}" class="time">
                        <label for="timeDone{{$i}}"
                            class="label text-center border-black border-[1px] py-2 w-[30%] rounded-lg flex-item">{{$i}}.00</label>
                    @endfor --}}
                </div>
            </div>
        </div>
        <button type="submit"
            class="bg-[#E65D2E] rounded-xl px-7 py-2 text-center text-stone-50 text-xl font-bold leading-normal">Selanjutnya</button>
    </form>
@endsection

@section('extra-scripts')
    <script>
        $(document).ready(function() {
            $("#tgl_pinjam").change(function() {
                // Display the loading spinner while the request is in progress
                $(".loadingSpinner").show();
                $(".flex-container").hide();
                $(".alert-text").hide();

                // Get the selected date
                var selectedDate = $(this).val();
                var ruanganId = $('input[name="ruangan"]').val();
                console.log(ruanganId);

                // Make an AJAX GET request with the selected date
                $.ajax({
                type: "GET",
                url: "{{ url('/') }}/api/getjadwal",
                data: { 
                    tgl_peminjaman: selectedDate, 
                    id_ruangan: ruanganId, 
                },
                success: function(data) {
                    // Hide the loading spinner on success
                    $(".loadingSpinner").hide();

                    updateRadioButtons(data.data);
                    $(".flex-container").show();
                },
                error: function(error) {
                    console.error("Error:", error);
                    // Hide the loading spinner on error
                    $(".loadingSpinner").hide();
                    $(".flex-container").show();
                    $(".alert-text").show();
                }
                });
            });

            function updateRadioButtons(data) {
                // Assume data is an array of options, each having a 'value' and 'label'
                // Example: data = [{value: 'red', label: 'Red'}, {value: 'blue', label: 'Blue'}]

                // Clear existing radio buttons
                $(".time").remove();
                $(".time-label").remove();

                // Create new radio buttons based on data
                if(data.length == 0){
                    for(let i = 6; i <= 20; i++){
                        var timeDone = '<input type="radio" name="timeDone" id="timeDone'+i+'" class="time" required value='+i+'> <label for="timeDone'+i+'" class="label time-label text-center border-black border-[1px] py-2 w-[30%] rounded-lg flex-item">'+i+'.00</label>'
                        var timeStart = '<input type="radio" name="timeStart" id="timeStart'+i+'" class="time" required value='+i+'> <label for="timeStart'+i+'" class="label time-label text-center border-black border-[1px] py-2 w-[30%] rounded-lg flex-item">'+i+'.00</label>'
                        $("#timeDoneContainer").append(timeDone)
                        $("#timeStartContainer").append(timeStart)
                    }
                } else {
                    for(let i = 6; i <= 20; i++){
                        var timeDone = '<input type="radio" name="timeDone" id="timeDone'+i+'" class="time" disabled required value='+i+'> <label for="timeDone'+i+'" class="label time-label text-center border-black border-[1px] py-2 w-[30%] rounded-lg flex-item">'+i+'.00</label>'
                        var timeStart = '<input type="radio" name="timeStart" id="timeStart'+i+'" class="time" disabled required value='+i+'> <label for="timeStart'+i+'" class="label time-label text-center border-black border-[1px] py-2 w-[30%] rounded-lg flex-item">'+i+'.00</label>'
                        $("#timeDoneContainer").append(timeDone)
                        $("#timeStartContainer").append(timeStart)
                    }
                }

                // Make sure to handle the default case if needed
            }
        });
    </script>
@endsection
