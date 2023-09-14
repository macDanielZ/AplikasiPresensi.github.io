<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
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
    </style>
</head>
<body>
    <div class="d-flex p-2 justify-content-between">
        <div class="d-flex">
            <div id="borderch">
                <img src="/img/person.jpg" style="width:55px; height:55px;border-radius: 30px;object-fit: cover;" alt="">
            </div>
            <div style="font-size:20px; margin-left:10px;">
                <p style="font-weight: bold">Halo, Andy!</p>
                <p style="font-size:15px;">Karyawan Social Sunday</p>
            </div>
        </div>
        <div>
        <img src="/img/logo.png" alt="" style="width:50px;height:50px;">
        <img src="/img/burger-bar.png" alt="" style="width:50px; heght:50px;">
        </div>
    </div>
    <div class="m-2 p-2 rounded-2" style="height:80%;border: 1px solid black;background-color: #0069E3; font-size:17px; ">
        <div class="p-1 rounded-2" style="background-color: white;">
            <p class="tx">Daftar Kelas Social Sunday</p>
        </div>
        {{-- class --}}
        {{-- <div class="p-1 mt-2 d-flex justify-content-between rounded-2 c1">
            <div>
            <p class="tx" style="text-align: left">Mom Class</p>
            <div class="d-flex">
            <img src="/img/user.png" style="widht:25px;height:25px;" alt="">
            <p style="margin-left : 2px;font-weight: bold">7</p>
            </div>
            </div>
            <div class="d-flex align-items-center">
                <img src="/img/burger-bar.png" style="width:40px;">
            </div>
        </div> --}}
        @foreach ($data as $kelas)
        <form id="form_{{$kelas->id_kelas}}" action="{{route('presensi',['id_kelas'=>$kelas->id_kelas])}}" method="GET">
        <div class="p-1 mt-2 d-flex justify-content-between rounded-2 c1" id="kelas_{{$kelas->id_kelas}}">
            <div>
            <p class="tx" style="text-align: left">{{$kelas->kelas}}</p>
            <div class="d-flex">
            <img src="/img/user.png" style="widht:25px;height:25px;" alt="">
            <p style="margin-left : 2px;font-weight: bold">{{$kelas->jumlah_siswa}}</p>
            </div>
            </div>
            <div class="d-flex align-items-center">
                <img src="/img/burger-bar.png" style="width:40px;">
            </div>
        </div>
        </form>
        <script>

            $('#kelas_{{$kelas->id_kelas}}').click(function (e) { 
                e.preventDefault();
                $('#form_{{$kelas->id_kelas}}').submit();
            });

        </script>
        @endforeach

    </div>
    <div class="d-flex justify-content-center m-2" style="border: 0px solid black;">
        <div class="p-2 rounded-1" style="border:0px solid black;background-color: #594ED2">
            <img src="/img/files.png" style="width:40px;" alt="">
        </div>
    </div>
</body>
</html>