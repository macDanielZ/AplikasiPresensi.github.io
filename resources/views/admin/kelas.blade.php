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
    <title>Data Akun | Admin</title>
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
        let list_id_user = [];
    </script>
</head>
<body style="background-color: #EADBC8">
    {{-- header --}}
    @include('header')



    {{-- content --}}
    <div class="cust_card">
        <p style="font-size:25px;text-align:center"><b>Data Kelas</b></p>
    </div>
    
        {{-- alert --}}
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
        <button data-bs-toggle="modal" data-bs-target="#tambah_user" class="btn btn-success">Tambah Kelas</button>
        {{-- data setiap orang --}}
        @foreach($data_kelas as $data_kelas)
        <div class="cust_card" style="background-color: #EADBC8">
            <div class="d-flex justify-content-between">
                <p style="font-weight: bold;font-size:20px;">{{$data_kelas->kelas}}</p>
            <div style="display: flex;align-items: center">
                <button data-bs-toggle="modal" data-bs-target="#edit_user_{{$data_kelas->id_kelas}}" class="btn btn-warning" style="font-size:0.8em">Edit</button>
                <button data-bs-toggle="modal" data-bs-target="#delete_user_{{$data_kelas->id_kelas}}" class="btn btn-danger" style="font-size:0.8em">Hapus</button>
            </div>
            </div>
        </div>

        {{-- Modal Delete User --}}
        <div class="modal fade" id="delete_user_{{$data_kelas->id_kelas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color : #DAC0A3">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #DAC0A3">             
                <p style="text-align:center;font-weight: bold;font-size:20px;">Apakah anda yakin ingin menghapus kelas dengan nama "{{$data_kelas->kelas}}"</p>
                </div>
                <div class="modal-footer" style="background-color: #DAC0A3">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                <form action="{{route('admin.hapus_kelas',['id'=>$data_kelas->id_kelas])}}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus Kelas</button>           
                </form>
                </div>
            </div>
            </div>
        </div>

        {{-- modal Edit User --}}
        <div class="modal fade" id="edit_user_{{$data_kelas->id_kelas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color : #DAC0A3">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas : "{{$data_kelas->kelas}}"</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #DAC0A3">             
                    <form action="{{route('admin.edit_kelas',['id'=>$data_kelas->id_kelas])}}" method="POST">
                        @method('put')
                        @csrf
                        <table class="table" style="font-weight: bold">
                            <tbody>
                            <tr>
                                <td>Nama Kelas</td>
                                <td><input type="text" name="kelas" value="{{$data_kelas->kelas}}" required></td>
                            </tr>
                        </tbody>
                          </table>
                  
                </div>
                <div class="modal-footer" style="background-color: #DAC0A3">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-warning">Perbarui Kelas</button>           
                </div>
            </form>
            </div>
            </div>
        </div>

        @endforeach
    </div>

    {{-- modal tambah user --}}
    <form action="{{route('admin.tambah_kelas')}}" method="POST">
        @csrf
    <div class="modal fade" id="tambah_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color : #DAC0A3">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #DAC0A3">             
              <table class="table" style="font-weight: bold">
                <tbody>
                <tr>
                    <td>Nama Kelas</td>
                    <td><input type="text" name="kelas" required></td>
                </tr>
                
            </tbody>
              </table>
            </div>
            <div class="modal-footer" style="background-color: #DAC0A3">
              <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
              <button type="submit" class="btn btn-success">Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <script>
         // fungsi tombol di header
            
         $('#logout').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("login")}}';
            });
            $('#home').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("admin.index")}}';
            });
    </script>
</body>
</html>