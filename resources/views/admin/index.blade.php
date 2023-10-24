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
    @include('header')

    {{-- card for find class --}}
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.presensi')}}">{{__('loc.admin_1')}}</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.siswa')}}">{{__('loc.admin_2')}}</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.user')}}">{{__('loc.admin_3')}}</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.kelas')}}">{{__('loc.admin_4')}}</a></p>
    </div>
    <div class="cust_card" style="font-size: 20px;">
        <p><a href="{{route('admin.rekap')}}">{{__('loc.admin_5')}}</a></p>
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