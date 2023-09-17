<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery.js"></script>
    <title>Login Social Sunday</title>

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
        *{
            margin: 0px;
            padding:0px;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }
        #border{
            border: 0px solid black;
            height: 100%;
            padding-top:25%;
            display: flex;
            justify-content: center;
        }
        .container{
            border:0px solid green;
            padding:10px;
            border-radius: 10px;
            box-shadow: 10px 10px 25px black;
            color: #0069E3;
            margin : 0px 20px 0px 20px;
        }
        .inp{
            box-shadow: 2px 2px 10px black;
            margin-bottom: 10px;
        }
        input{
            font-weight: 400;
            width: 100%;
            border: none;
            padding:5px;
            font-size:17px;
        }
        input:focus{
            outline: none;
        }
        a:link{
            text-decoration: none;
        }
        a:visited{
            text-decoration: none;
            color: #0069E3;
        }
        button{
            width:100%;
            padding:10px;
            border-radius: 20px;
            margin : 0px 15px 0px 15px;
            background-color: #0069E3;
            color:white;
            border:none;
            font-size:20px;
        }
        .alert-danger {
            background-color: #ffcccc; /* Lighter red color */
            border-color: #ff9999; /* Lighter border color */
            color: #990000; /* Darker text color */
            font-weight: bold; /* Make text bold */
            /* Add any additional styles as needed */
            margin : 0px 20px 0px 20px;
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
</head>
<body>
    <div id="border" style="margin-bottom: 25%">
        <img src="/img/logo.png" alt="">
    </div>
    @if(session('gagal'))
    <div class="alert alert-danger">
        {{session('gagal')}}
    </div>
    @endif
    <form action="{{route('autentikasi')}}" method="POST">
    @csrf
    <div class="container">
        <p style="font-size:25px;font-weight: bold;">Presensi Social Sunday</p>
        <p style="margin-bottom:20px;color: black;">Masuk Untuk Memulai</p>
        <div>
            <div class="inp">
                <input type="emial" name="email" id="" placeholder="Email">
            </div>
            <div class="inp" style="display:flex;justify-content: center">
                <input style="" name="password" type="password" id="passjs" placeholder="Kata Sandi">
                <div style="display: flex; justify-content: center; align-items: center;margin-right:10px;">
                    <img src="/img/eyec.png" style="width:20px;height:20px;" alt="" id="eyeicon">
                </div>

            </div>
        </div>
        <div style="margin-top: 20px;">
            {{-- <a href="https://facebook.com"><p style="text-align:right;font-weight: bold">Lupa Sandi ?</p></a> --}}
        </div>
    </div>
    
    
    <div style="border : 0px solid red;margin-top:20px;display:flex; justify-content:center;">
        <button>Masuk</button>
    </div>
</form>
    <script>
        let i = 0;
        $('#eyeicon').click(function (e) { 
            switch (i) {
                case 0:
                    $('#eyeicon').attr('src', '/img/eyeo.png');
                    $('#passjs').attr('type', 'text');
                    i = 1;
                    break;
                case 1:
                    $('#eyeicon').attr('src', '/img/eyec.png');
                    $('#passjs').attr('type', 'password');
                    i = 0;
                    break;
            }
        });        
    </script>
</body>
</html>