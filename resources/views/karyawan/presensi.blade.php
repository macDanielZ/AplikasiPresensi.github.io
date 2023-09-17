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
        .alert-danger {
            background-color: #ffcccc; /* Lighter red color */
            border-color: #ff9999; /* Lighter border color */
            color: #990000; /* Darker text color */
            font-weight: bold; /* Make text bold */
            /* Add any additional styles as needed */
            margin : 0px 10px 0px 10px;
        }
        .alert-success {
            background-color: #d4edda; /* Lighter green color */
            border-color: #c3e6cb; /* Lighter border color */
            color: #155724; /* Darker text color */
            font-weight: bold; /* Make text bold */
            /* Add any additional styles as needed */
            margin : 0px 10px 0px 10px;

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
    {{-- header --}}
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
            <div id="logout" class="logout-container">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button><i  class="fa-solid fa-arrow-right-from-bracket"></i></button>
                    </form>
            </div>
            {{-- <div id="home" class="logout-container">
                <i  class="fa-solid fa-house"></i>
            </div> --}}
            <div style="display: flex;align-items:center;margin-left:10px;">
               <img src="/img/logo.png" alt="" style="width:50px;height:50px;">
            </div>
        {{-- <img src="/img/burger-bar.png" alt="" style="width:50px; heght:50px;"> --}}
        </div>
    </div>

    {{-- card for find class --}}
    <div class="cust_card">
        <table style="width:100%">
            <form id="form_cari_kelas" action="" method="GET">
                <input type="hidden" name="waktu_hidden" id="waktu_hidden">
            </form> 
            <tr>
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
                <td>
                <form id="submission" action="{{route('karyawan.unggah_presensi')}}" method="POST">@csrf
                    @if(isset($data_peserta))
                    <input type="date" name="waktu" id="waktu">
                    @else
                    <input type="date" name="waktu" id="waktu">
                    @endif
                </form>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="float:right;"><button style="margin: 10px 0px 10px 0px" class="btn btn-success" id="find_class" type="submit">Cari</button></td>
            </tr>
        </table>
    </div>

    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @elseif(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    
    <div class="cust_card">
        <table style="width:100%">
            <tr>
                <td>Data Presensi Peserta Didik</td>
                <td style="float:right">@if(isset($data_peserta) && count($data_peserta) != null)
                    <button id="upload" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary" type="submit">Unggah</button>
                    @endif</td>
            </tr>
        </table>
        @if(isset($data_peserta))
            @if(count($data_peserta) == null)
            <p style="color:gray;text-align:center;padding:20px 0px 20px 0px;font-weight:bold">Data Peserta didik pada kelas kosong</p>
            @endif
        @foreach ($data_peserta as $data_peserta)
        <div class="cust_card" style="background-color: #EADBC8;">
            <p style="font-weight: bold;font-size:25">{{$data_peserta->nama_peserta}}</p>
            <label style="font-weight: normal" for="hadir_{{$data_peserta->id_peserta}}">Hadir</label>
            <input type="radio" value="1" name="status_{{$data_peserta->id_peserta}}" id="hadir_{{$data_peserta->id_peserta}}" style="margin-right: 15px;">
            <label style="font-weight: normal" for="sakit_{{$data_peserta->id_peserta}}">Sakit</label>
            <input type="radio" value="2" name="status_{{$data_peserta->id_peserta}}" id="sakit_{{$data_peserta->id_peserta}}" style="margin-right: 15px;">
            <label style="font-weight: normal" for="izin_{{$data_peserta->id_peserta}}">Izin</label>
            <input type="radio" value="3" name="status_{{$data_peserta->id_peserta}}" id="izin_{{$data_peserta->id_peserta}}" style="margin-right: 15px;">
            <label style="font-weight: normal" for="alpha_{{$data_peserta->id_peserta}}">Alpha</label>
            <input type="radio" value="4" name="status_{{$data_peserta->id_peserta}}" id="alpha_{{$data_peserta->id_peserta}}" checked>
        </div>
        @endforeach
        @else
        <p style="color:gray;text-align:center;padding:20px 0px 20px 0px;font-weight:bold">Data Peserta didik kosong</p>
        @endif
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="background-color: #DAC0A3">
            <div class="modal-header" style="background-color: #DAC0A3">
              <h5 class="modal-title" id="exampleModalLabel" >Unggah Data ?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
              <div class="modal-content" style="background-color: #DAC0A3">
                <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
                  <!-- Top Dialog -->
                  <div class="container p-3" style="background-color: #DAC0A3">
                   <p><b>Data Presensi Peserta</b></p>
                   <p>Tanggal Presensi : <span id="modal_waktu"></span></p>
                   <p>Kelas : <span id="modal_kelas"></span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
              <div class="modal-content" style="background-color: #DAC0A3">
                <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
                  <!-- Bottom Dialog -->
                  <div class="container p-3"style="background-color: #DAC0A3">
                    Apakah anda yakin ingin mengunggah data presensi ?
                    <div style="display: flex;justify-content: space-between;margin-top:10px;">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                        <button id="unggah" type="submit" class="btn btn-success">Unggah</button>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    {{-- script --}}
    <script>
        $(document).ready(function () {          
            let currentDate = new Date().toISOString().split('T')[0];
            console.log('Branch');
            $('#waktu').val(currentDate);
            $('#waktu_hidden').val(currentDate);
            
            @if(isset($cc_waktu))
            let selected_date = new Date('{{$cc_waktu}}').toISOString().split('T')[0];
            $('#waktu').val(selected_date);
            $('#waktu_hidden').val(selected_date);
            @endif

            let kelas_text = $('#kelas option:selected').text();
            $('#modal_waktu').text(currentDate);
            $('#modal_kelas').text(kelas_text);


            // tanggal 
            $('#waktu').change(function (e) { 
                let selected = $(this).val();
                $('#waktu_hidden').val(selected);
            });

            $('#logout').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("login")}}';
            });
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
                // let waktu_hidden = $('#waktu').val().toString();
                // $('#waktu_hidden').val(""+waktu_hidden);
                // console.log($('#waktu_hidden').val());
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