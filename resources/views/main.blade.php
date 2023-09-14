<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Sunday</title>
    <link rel="stylesheet" href="\css\bootstrap.min.css">
    <script src="https://kit.fontawesome.com/fa23b267c2.js" crossorigin="anonymous"></script>
    <script src="\js\bootstrap.bundle.min.js"></script>
    <script src="\js\jquery.js"></script>
    <style>
        p {
            margin-bottom: 0px;
        }

        .k-header{
            display:flex; 
            justify-content: space-evenly;
            width: 100%;
            border : 1px solid black;
            padding : 10px;
            border-radius: 30px;
            background-color: #7E7E7E;
        }

        .kelas {
            border : 1px solid black;
            border-radius : 10px;
            margin-top: 10px;
            padding :10px;
            background-color: #D9D9D9;
        }
        .presensi-btn{
            background-color: #009AA4;
            border: none;
            border-radius: 10px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }
        #main-time{
            padding: 10px;
            border : 1px solid black;
            margin-top:10px;
            border-radius: 30px;
            background-color: #747474;
            color: white;
            text-align: center;
            font-size:20px;
            font-weight: bolder;
        }
    </style>
</head>
<body>
    <div style="padding:10px;">
      <input type="radio" name="asd" id="" checked>
      <input type="radio" name="asd" id="">
        <div class="k-header">
            <img src="logo.png" style="width:30%" alt="">
            <div style="text-align:center;display:flex;align-items:center;">
                <h1 style="font-weight: bold;color:rgb(255, 255, 255)">Daftar Kelas <br>Social Sunday</h1>
            </div> 
        </div>
        <div id="main-time">
            <p id="livetime">12:00:00 PM</p>
        </div>
       @foreach ($data as $item)
       <div class="kelas">
        <h1 style="font-weight: bold">{{$item->kelas}}</h1>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <i style="font-size:35px;" class="fa-solid fa-circle-user"></i><span style="margin-right:10px;"></span>
                @php
                    $count = 0;
                @endphp
               @foreach($peserta as $pesertas)
                    @if($pesertas->id_kelas == $item->id_kelas)
                    @php
                        $count++;
                    @endphp
                    @endif
            
               
               @endforeach
                    <h1>{{$count}}</h1>
    
            @php
                    $count = 0;
                @endphp
              
            </div>
              <button class="btn btn-success presensi-btn" id="btn_{{$item->id_kelas}}">
                    Presensi
                </button>
        </div>
  </div>

        <script>
            $('#btn_{{$item->id_kelas}}').click(function (e) { 
                console.log("{{$item->kelas}} is pressed");
                
            });
        </script>

       @endforeach
      
        <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Accordion Item #1
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div>

    </div>
    <div class="modal fade" id="offline_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tidak Terkoneksi Internet !</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data presensi yang diisi tidak dapat di unggah ke dalam database ! Namun data masih dapat disimpan kedalam penyimpanan sementara pada peramban, segera hubungkan ke internet untuk sinkronisasi data !
            </div>
            <div class="modal-footer">
              <button onclick="location.reload()" type="button" class="btn btn-warning" style="font-weight: bold">Sinkronisasi</button>
            </div>
          </div>
        </div>
    </div>

    <script>
        onload = function(){
            var ch = 0;
            let a;
            function checkConnection(){
            a = setInterval(() => {
                navigator.onLine ? console.log('Current Connection : Established !\nChecking Every 5 Seconds...') : ch=5;
                if(ch == 5){
                    stopCh();
                }
            }, 5000);
             }
             function stopCh(){
                $('#offline_modal').modal('show')
                clearInterval(a);
                }
            checkConnection();

        }
        setInterval(()=>{
            let time = document.getElementById("livetime");
            let d = new Date();
            time.innerHTML = d.toLocaleTimeString();
        },1000);
    </script>
</body>
</html>