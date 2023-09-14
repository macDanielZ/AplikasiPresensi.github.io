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
    <title>Presensi</title>
    <style>

        a{
            text-decoration: none;
            color:black;
        }

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
            let st;
            let repeat = 0;
            function getData(){
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
    {{-- header --}}
    <div class="d-flex p-2 justify-content-between" style="border-radius: 0px 0px 15px 15px;border:1px solid black;background-image: linear-gradient(to bottom, #EADBC8, #DAC0A3);">
        <div class="d-flex">
            <div id="borderch">
                <img src="/img/person.jpg" style="width:58px; height:58px;border-radius: 30px;object-fit: cover;" alt="">
            </div>
            <div style="font-size:23px; margin-left:10px;">
                <p style="font-weight: bold">Halo, {{$nama_user}}!</p>
                <div style="border:1px solid black" id="separator"></div>
                <p style="font-size:18px;">{{$jabatan}} KEP</p>
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
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.presensi')}}">Presensi Peserta Didik</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.siswa')}}">Data Peserta Didik</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.user')}}">Data Akun Pengguna</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.kelas')}}">Data Kelas</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.rekap')}}">Rekapitulasi Presensi</a></p>
    </div>

    {{-- script --}}
    <script>
        $(document).ready(function () {          
            let currentDate = new Date().toISOString().split('T')[0];
            $('#waktu').val(currentDate);
            let kelas_text = $('#kelas option:selected').text();
            $('#modal_waktu').text(currentDate);
            $('#modal_kelas').text(kelas_text);

            // fungsi tombol di header
            
            // $('#logout').click(function (e) { 
            //     // e.preventDefault();
            //     window.location.href = '{{route("login")}}';
            // });
            $('#home').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("admin.index")}}';
            });

            // Fungsi tombol unggah modal -> upload
            $('#unggah').click(function (e) { 
                // e.preventDefault();
                $('#submission').submit();
                
            });

            // fungsi tombol unggah dapatkan array
            $('#upload').click(function (e) { 
                e.preventDefault();
                // array handling
                if(repeat != 0){
                    id_siswa = [];
                    status_siswa = [];
                    getData();
                    repeat = 0;
                }else{
                    getData();
                    repeat++
                }
                console.log('id siswa : '+id_siswa);
                console.log('status siswa : '+status_siswa);
                for(let i = 0; i < id_siswa.length; i++){
                $('#submission').append(`
                      <input type="hidden" name="id_siswa[]" value=`+id_siswa[i]+`>
                `);
                }
                for(let i = 0; i < status_siswa.length; i++){
                    $('#submission').append(`
                        <input type="hidden" name="status_siswa[]" value=`+status_siswa[i]+`>
                    `);
                }
                // $('#submission').submit();
            });

            // fungsi tombol cari
            $('#find_class').click(function (e) { 
                // e.preventDefault();
                let kelas = $('#kelas').val();
                
                $('#form_cari_kelas').attr('action', '/presensi/pilih-kelas/'+kelas);
                $('#form_cari_kelas').submit();

                // Ajax Functions
                // // define csrf-token
                // var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                // // header-ajax
                // $.ajaxSetup({
                // headers: {
                //     'X-CSRF-TOKEN': csrfToken
                //     }
                // });
                // // end-header-ajax

                // // ajax-main
                //     $.ajax({
                //         type: "POST",
                //         url: "[isi manual routenya !]",
                //         data: {
                //             nama:'ajax-request'
                //         },
                //         success: function (response) {
                //             console.log(response.pesan);
                //         }
                //     });
                // // end-ajax-main


            });
        });
    </script>
</body>
</html>