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
    <title>Presensi | Admin</title>
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
    {{-- header --}}
    @include('header')

    {{-- card for find class --}}
    <div class="cust_card">
        <table style="width:100%">
            {{-- search --}}
            <form id="form_cari_kelas" action="" method="GET">
                <input type="hidden" name="" id="s_kelas">
                <input type="hidden" name="" id="s_waktu">
            </form> 
            <tr>
                <td>{{__('admin_presence.kelas')}}</td>
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
                <td>{{__('admin_presence.tgl')}}</td>
                <td>
                    <input type="date" name="waktu" id="waktu">
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="float:right;"><button style="margin: 10px 0px 10px 0px" class="btn btn-success" id="find_class" type="submit">{{__('admin_presence.cari')}}</button></td>
            </tr>
        </table>
    </div>
    <div class="cust_card">
        <table style="width:100%">
            <tr>
                <td>{{__('admin_presence.list1')}}</td>
                <td style="float:right">@if(isset($data_peserta) && count($data_peserta) != null)
                    @if(count($data_presensi) != null)
                    <button class="btn btn-danger" id="deletePresensi" data-bs-toggle="modal" data-bs-target="#deleteModal"> {{__("admin_presence.mlist7")}}</button>
                    <button id="upload" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary" type="submit">{{__("admin_presence.mlist6")}}</button>
                    @endif @endif</td>
            </tr>
        </table>
        @if(isset($data_peserta))
            @if(count($data_peserta) == null)
            {{-- <p style="color:gray;text-align:center;padding:20px 0px 20px 0px;font-weight:bold">Data Peserta didik pada kelas kosong</p> --}}
            @endif
        @if(count($data_presensi) != null)
        @foreach ($data_presensi as $dapre)
            @foreach($data_peserta as $dapes)
                @if($dapre->id_peserta == $dapes->id_peserta)
                <div class="cust_card" style="background-color: #EADBC8;">
                    <p style="font-weight: bold;font-size:25">{{$dapes->nama_peserta}}</p>
                    <label style="font-weight: normal" for="hadir_{{$dapes->id_peserta}}">{{__('admin_presence.hadir')}}</label>
                    <input type="radio" value="1" name="status_{{$dapes->id_peserta}}" id="hadir_{{$dapes->id_peserta}}" style="margin-right: 15px;" @if($dapre->status == 1)checked @endif>
                    <label style="font-weight: normal" for="sakit_{{$dapes->id_peserta}}">{{(__("admin_presence.sakit"))}}</label>
                    <input type="radio" value="2" name="status_{{$dapes->id_peserta}}" id="sakit_{{$dapes->id_peserta}}" style="margin-right: 15px;" @if($dapre->status == 2)checked @endif>
                    <label style="font-weight: normal" for="izin_{{$dapes->id_peserta}}">{{__("admin_presence.izin")}}</label>
                    <input type="radio" value="3" name="status_{{$dapes->id_peserta}}" id="izin_{{$dapes->id_peserta}}" style="margin-right: 15px;" @if($dapre->status == 3)checked @endif>
                    <label style="font-weight: normal" for="alpha_{{$dapes->id_peserta}}">{{__("admin_presence.alpha")}}</label>
                    <input type="radio" value="4" name="status_{{$dapes->id_peserta}}" id="alpha_{{$dapes->id_peserta}}" @if($dapre->status == 4)checked @endif>
                </div>
                @endif
            @endforeach
        @endforeach
        @else
        <p style="color:gray;text-align:center;padding:20px 0px 20px 0px;font-weight:bold">{{__('admin_presence.list2')}}</p>
        @endif
        @else
        <p style="color:gray;text-align:center;padding:20px 0px 20px 0px;font-weight:bold">{{__('admin_presence.list3')}}</p>
        @endif
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="background-color: #DAC0A3">
            <div class="modal-header" style="background-color: #DAC0A3">
              <h5 class="modal-title" id="exampleModalLabel" >{{__("admin_presence.mlist9")}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
              <div class="modal-content" style="background-color: #DAC0A3">
                <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
                  <!-- Top Dialog -->
                  <div class="container p-3" style="background-color: #DAC0A3">
                   <p><b>{{__("admin_presence.mlist1")}}</b></p>
                   <p>{{__("admin_presence.mlist2")}}<span id="modal_waktu"></span></p>
                   <p>{{__("admin_presence.mlist3")}} : <span id="modal_kelas"></span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
              <div class="modal-content" style="background-color: #DAC0A3">
                <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
                  <!-- Bottom Dialog -->
                  <div class="container p-3"style="background-color: #DAC0A3">
                    {{__("admin_presence.mlist4")}}
                    <div style="display: flex;justify-content: space-between;margin-top:10px;">
                        <button class="btn btn-danger" data-bs-dismiss="modal">{{__("admin_presence.mlist5")}}</button>
                        <button id="unggah" type="submit" class="btn btn-primary">{{__("admin_presence.mlist6")}}</button>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Modal Delete --}}
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="background-color: #DAC0A3">
            <div class="modal-header" style="background-color: #DAC0A3">
              <h5 class="modal-title" id="exampleModalLabel" >Hapus Data ?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
              <div class="modal-content" style="background-color: #DAC0A3">
                <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
                  <!-- Top Dialog -->
                  <div class="container p-3" style="background-color: #DAC0A3">
                   <p><b>Data Presensi Peserta</b></p>
                   <p>Tanggal Presensi : <span id="delete_modal_waktu"></span></p>
                   <p>Kelas : <span id="delete_modal_kelas"></span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
              <div class="modal-content" style="background-color: #DAC0A3">
                <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
                  <!-- Bottom Dialog -->
                  <div class="container p-3"style="background-color: #DAC0A3">
                    Apakah anda yakin ingin Menghapus data presensi?
                    <div style="display: flex;justify-content: space-between;margin-top:10px;">
                        <button class="btn btn-success" data-bs-dismiss="modal">Batalkan</button>
                        <form id="deleteForm" action="{{route('admin.delete_presensi')}}" method="POST">@csrf @method('delete')</form>
                        <button id="delete" type="submit" class="btn btn-danger">Hapus</button>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <form id="updateForm" action="{{route('admin.update')}}" method="post">
        @csrf
       </form>
    {{-- script --}}
    <script>
        $(document).ready(function () {          
            let currentDate = new Date().toISOString().split('T')[0];
            $('#waktu').val(currentDate);
            @if(isset($sel_date))
            $('#waktu').val("{{$sel_date}}");
            console.log("{{$sel_date}}");
            @endif
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

            

            // Fungsi tombol delete model -> delete
            $('#delete').click(function (e) { 
                // e.preventDefault();
                $('#deleteForm').submit();
                
            });

            // Fungsi tombol unggah modal -> upload
            $('#unggah').click(function (e) { 
                // e.preventDefault();
                $('#form_cari_kelas').attr('action', '');
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
            $('#find_class').click(function (e) { 
                // e.preventDefault();
                let kelas = $('#kelas').val();
                $('#s_kelas').val(kelas);
                $('#s_waktu').val($('#waktu').val());
                let tanggal = $('#waktu').val();
                
                $('#form_cari_kelas').attr('action', '/admin/presensi/'+kelas+'/'+tanggal);
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