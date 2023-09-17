<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">

    {{-- PWA --}}
    <link rel="manifest" href="/manifest.json">
    <script src="/pwa.js"></script>
    <script src="/sw.js"></script>
    <link rel="apple-touch-icon" href="images/hello-icon-152.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="white"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Hello World">
    <meta name="msapplication-TileImage" content="images/hello-icon-144.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    {{-- A --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <title>Rekapitulasi Presensi Kegiatan Social Sunday</title>
    <style>
        html,body{
            height: 100%;
        }
        p{
            margin: 0px;
            padding: 0px;
        }
        #borderch{
            border :0px solid red;
        }
        .c1{
            background-color: white;
        }
        .tx{
            font-weight: bold;
            text-align:center;
        }
        .cust_card{
            padding:10px; border : 1px solid black;margin:10px;
            border-radius: 10px;
            background-color: #DAC0A3;
            font-weight: bold;
            box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)
        }

        /* tabel */
        #rekap_tabel tr, #rekap_tabel td, #rekap_tabel th{
            border : 1px solid black;
        }
        
        /* Buttons for export */
        dataTables_wrapper .dt-buttons .buttons-excel {
            background-color: #4caf50; /* Change to your desired green color */
            color: #fff; /* Set text color to white or a color that contrasts well */
            border: none; /* Remove button border */
            border-radius: 5px; /* Add rounded corners if desired */
            padding: 8px 16px; /* Adjust padding as needed */
        }

        .dataTables_wrapper .dt-buttons .buttons-excel {
            background-color: #45a049; /* Change to a slightly darker shade on hover */
            color:white;
        }
        
        .logout-container{
            display: flex;
            font-size: 25px;
            align-items: center;
            justify-content: center;
            margin-left : 10px;
        }

        .logout-container button{
            background-color: transparent;
            border : none;
        }
    </style>
    <script>
         // init
            let id_siswa = [];
            let status_siswa = [];
            let id_presensi = [];
            let st;
            let repeat = 0;
            function getData(){
               @if(isset($data_presensi))
                    @foreach($data_presensi as $dp)
                        id_presensi.push('{{$dp->id}}');
                    @endforeach
               @endif
               @if(isset($data_peserta))
               @foreach($data_peserta as $x)
                id_siswa.push('{{$x->id_peserta}}');
                st = $('input[name="status_{{$x->id_peserta}}"]:checked').val();
                status_siswa.push(st);
               @endforeach
               @endif
            }
    </script>
</head>
<body style="background-color: #EADBC8">
    <div class="d-flex p-2 justify-content-between" style="border-radius: 0px 0px 15px 15px;border:1px solid black;background-image: linear-gradient(to bottom, #EADBC8, #DAC0A3);">
        <div class="d-flex">
            <div id="borderch">
                <img src="/img/person.jpg" style="width:58px; height:58px;border-radius: 30px;object-fit: cover;" alt="">
            </div>
            <div style="font-size:23px; margin-left:10px;">
                <p style="font-weight: bold">Halo, Andy!</p>
                <div style="border:1px solid black" id="separator"></div>
                <p style="font-size:18px;">Volunteers KEP</p>
            </div>
        </div>
        <div style="display: flex; float-right">
            <div class="logout-container">
                <form action="{{route('logout')}}" method="POST">
                @csrf
                <button><i  class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </form>
            </div>
            <div id="home" class="logout-container">
                <i  class="fa-solid fa-house"></i>
            </div>
            <div style="display: flex;align-items:center;margin-left:10px;">
               <img src="/img/logo.png" alt="" style="width:50px;height:50px;">
            </div>
        {{-- <img src="/img/burger-bar.png" alt="" style="width:50px; heght:50px;"> --}}
        </div>
    </div>

    {{-- card for find class --}}
    <div class="cust_card">
        <table style="width:100%">
            {{-- search --}}
            <form id="form_cari_kelas" action="" method="POST">
                @csrf
                <input type="hidden" name="s_kelas" id="s_kelas">
                <input type="hidden" name="s_waktu" id="s_waktu">
            </form> 
            <tr>
                {{-- Form Cari Kelas --}}
                @php
                    if($jabatan == 'Manajemen'){
                        $link = 'manajemen.rekap_cari_kelas';
                    }else{
                        $link = 'admin.rekap_cari_kelas';
                    }
                @endphp
                <form action='{{route("$link")}}'>
                    
                <td>Kelas</td>
                <td><select name="kelas" id="kelas">
                    @foreach ($data_kelas as $data_kelas)
                        @if(isset($id_kelas))
                            @if($data_kelas->id_kelas == $id_kelas)
                                <option value="{{$data_kelas->id_kelas}}" selected>{{$data_kelas->kelas}}</option>
                            @else
                                <option value="{{$data_kelas->id_kelas}}">{{$data_kelas->kelas}}</option>
                            @endif
                        @else
                            <option value="{{$data_kelas->id_kelas}}">{{$data_kelas->kelas}}</option>
                        @endif
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>Tanggal Pelaksanaan</td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="date" name="waktu_start" id="waktu_start" required><span> s.d </span><input type="date" name="waktu_end" id="waktu_end" required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="float:right;"><button style="margin: 10px 0px 10px 0px" class="btn btn-success" id="find_class" type="submit">Cari</button></td>
            </tr>
        </table>
    </form>
    {{-- Content --}}
    </div>
    <div class="cust_card" style="overflow: auto">
        <p>Data Presensi Peserta Didik</p>
        @if(isset($data_tabel))
        @php
            $x = 0;
            $status_view = null;
        @endphp
        <table id='rekap_tabel' style="width: 100%">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center">No</th>
                    <th rowspan="2" style="text-align: center">Nama Peserta Didik</th>
                    <th rowspan="2" style="text-align: center">Kelas Peserta Didik</th>
                    <th colspan="3" style="text-align: center">Tanggal Kegiatan</th>
                </tr>
                <tr>
                    @php
                        $previous_date = null;
                    @endphp
                    @foreach($data_tabel as $data)
                        @if($data->waktu !== $previous_date)
                        <th style="text-align: center">{{str_replace('-','/',$data->waktu)}}</th>
                        @endif
                        @php
                        $previous_date = $data->waktu;
                    @endphp
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{-- student --}}
                @php
                    $inserted_student = array();
                @endphp
                @foreach($data_peserta as $data_peserta)
                @php
                    $x++;
                @endphp
                    @if(!in_array($data_peserta->nama_peserta,$inserted_student))
                    <tr>
                    <td style="text-align: center">{{$x}}</td>
                    <td>{{$data_peserta->nama_peserta}}</td>
                    <td>{{$data_peserta->kelas}}</td>
                    @endif
                @php
                    array_push($inserted_student,$data_peserta->nama_peserta);
                @endphp
                

                {{-- time --}}
                        @foreach ($data_tabel as $d)
                            @if($d->nama_peserta == $data_peserta->nama_peserta)
                            <td style="text-align:center">@php
                                switch ($d->status) {
                                    case 1:
                                        echo "Hadir";
                                        break;
                                    case 2:
                                        echo "Sakit";
                                        break;
                                    case 3:
                                        echo "Izin";
                                        break;
                                    case 4:
                                        echo "Alpha";
                                        break;
                                    
                                }
                            @endphp</td>
                            @endif
                        @endforeach
                     </tr>
            @endforeach
            </tbody>
        </table>
        
        @endif
    </div>
    {{-- script --}}
    <script>
        $(document).ready(function () {          
            let currentDate = new Date().toISOString().split('T')[0];
            $('#waktu').val(currentDate);
            let kelas_text = $('#kelas option:selected').text();
            $('#modal_waktu').text(currentDate);
            $('#modal_kelas').text(kelas_text);
            $('#delete_modal_waktu').text(currentDate);
            $('#delete_modal_kelas').text(kelas_text);


             // fungsi tombol di header
            
             $('#logout').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("login")}}';
            });
            $('#home').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("admin.index")}}';
            });


            //Rekap Tabel
            // Datatable
            $('#rekap_tabel').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export',
                        filename: 'Laporan Rekapitulasi Social Sunday | '+currentDate,
                        exportOptions: {
                        }
                    }
                ]
            });

            // Fungsi tombol delete model -> delete
            $('#delete').click(function (e) { 
                // e.preventDefault();
                $('#deleteForm').submit();
                
            });

            // Fungsi tombol unggah modal -> upload
            $('#unggah').click(function (e) { 
                // e.preventDefault();don', '');
                $('#updateForm').submit();
                
            });

            // Fungsi tombol delete
            $('#deletePresensi').click(function (e) { 
                e.preventDefault();
                if(repeat != 0){
                    id_siswa = [];
                    status_siswa = [];
                    id_presensi = [];
                    getData();
                    repeat = 0;
                }else{
                    getData();
                    repeat++
                }
                console.log('id siswa : '+id_siswa);
                console.log('status siswa : '+status_siswa);
                for(let i = 0; i < id_siswa.length; i++){
                $('#deleteForm').append(`
                      <input type="hidden" name="id_siswa[]" value=`+id_siswa[i]+`>
                `);
                }
                for(let i = 0; i < status_siswa.length; i++){
                    $('#deleteForm').append(`
                        <input type="hidden" name="status_siswa[]" value=`+status_siswa[i]+`>
                    `);
                }
                for(let i = 0; i < id_presensi.length; i++){
                    $('#deleteForm').append(`
                        <input type="hidden" name="id_presensi[]" value=`+id_presensi[i]+`>
                    `);
                }
                
                // alert('a')
            });

            // fungsi tombol unggah dapatkan array
            $('#upload').click(function (e) { 
                e.preventDefault();
                // array handling
                if(repeat != 0){
                    id_siswa = [];
                    status_siswa = [];
                    id_presensi = [];
                    getData();
                    repeat = 0;
                }else{
                    getData();
                    repeat++
                }
                console.log('id siswa : '+id_siswa);
                console.log('status siswa : '+status_siswa);
                for(let i = 0; i < id_siswa.length; i++){
                $('#updateForm').append(`
                      <input type="hidden" name="id_siswa[]" value=`+id_siswa[i]+`>
                `);
                }
                for(let i = 0; i < status_siswa.length; i++){
                    $('#updateForm').append(`
                        <input type="hidden" name="status_siswa[]" value=`+status_siswa[i]+`>
                    `);
                }
                for(let i = 0; i < id_presensi.length; i++){
                    $('#updateForm').append(`
                        <input type="hidden" name="id_presensi[]" value=`+id_presensi[i]+`>
                    `);
                }
                // $('#submission').submit();
            });
            

            // fungsi tombol cari
            // $('#find_class').click(function (e) { 
            //     // e.preventDefault();
            //     let kelas = $('#kelas').val();
            //     $('#s_kelas').val(kelas);
            //     $('#s_waktu').val($('#waktu').val());
                
            //     $('#form_cari_kelas').attr('action', '/admin/presensi/'+kelas);
            //     $('#form_cari_kelas').submit();

            //     // Ajax Functions
            //     // // define csrf-token
            //     // var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            //     // // header-ajax
            //     // $.ajaxSetup({
            //     // headers: {
            //     //     'X-CSRF-TOKEN': csrfToken
            //     //     }
            //     // });
            //     // // end-header-ajax

            //     // // ajax-main
            //     //     $.ajax({
            //     //         type: "POST",
            //     //         url: "[isi manual routenya !]",
            //     //         data: {
            //     //             nama:'ajax-request'
            //     //         },
            //     //         success: function (response) {
            //     //             console.log(response.pesan);
            //     //         }
            //     //     });
            //     // // end-ajax-main


            // });
        });
    </script>
</body>
</html>