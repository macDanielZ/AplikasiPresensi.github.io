<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>
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
        .class_header{
            border:0px solid red;
            background-color: #0069E3;
            border-radius: 10px;
            padding:10px;
            margin : 5% 7% 0px 7%;
            text-align: center;
            color: white;
        }
        .class_header h1{
            font-weight: bold;
        }
        .profile{
            position: relative;
            border:3px solid black;
            margin : 5% 7% 0px 7%;
            height: 300px;
            overflow: hidden;
        }
        .profile_name{
            text-align: center;
            margin-top: 2%
        }
        .profile_name h1{
            font-weight: bold;
        }
        .profile_id{
            border:0px solid red;
            background-color: #0069E3;
            border-radius: 10px;
            width: 50px;
            height: 50px;
            position: absolute;
            top: 10px;
            left: 3%;
            text-align: center
        }
        .profile_id_search{
            background-color: #0069E3;
            border-radius: 10px;
            width:40px;
            height:40px;
            text-align: center;
        }
        .profile_status{
            border:0px solid red;
            background-color: #0069E3;
            border-radius: 10px;
            width: 50px;
            height: 50px;
            position: absolute;
            top: 10px;
            left: 83%;
            text-align: center
        }
        .prs-btn-1{
            display: flex;
            justify-content: center;
            margin-top: 10%;
        }
        .prs-btn-2{
            display: flex;
            justify-content: center;
            margin-top: 5%;
        }
        .prs-btn-1 button{
            padding: 5px 20px 5px 20px;
            color: black;
            font-weight: bold;
            border: 2px solid #0069E3;
            border-radius: 5px;
            font-size:20px;
        }
        .prs-btn-2 button{
            padding: 5px 10px 5px 10px;
            color: white;
            font-weight: bold;
            border: 2px solid #0069E3;
            border-radius: 5px;
            font-size:20px;
        }
        .footer_page{
            border-top : 2px solid rgb(100, 100, 100);
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 5px;
            padding-top : 10px;
            background-color: #ffeded;
            display: flex;
            justify-content: space-between;
        }
        .prev{
            flex-wrap: wrap;
            display: flex;
            justify-content: center;
            align-content: center;
            width: 50px;
            background-color: #00CC52;
            height: 50px;
            border:0px solid red;
            text-align: center;
        }
        .ft-btn button{
            background-color: #ffffff;
            border : 2px solid royalblue;
            border-radius: 13px;
            padding: 5px;
        }
        .ft-btn button img{
            width: 50px;
            height: 50px;
        }
    </style>
    <script>
        var data_presensi = [];
        var data_siswa = [];
        var siswa = {};
        var init_presensi = {};
        @php
            $nomor_absen = 1;
        @endphp
        @foreach($peserta as $peserta)
            siswa = {

                no : {{$nomor_absen}},
                nama : "{{$peserta->nama_peserta}}",
                id_peserta : {{$peserta->id_peserta}}

            };
            data_siswa.push(siswa);
            init_presensi = {

                id_peserta : {{$peserta->id_peserta}},
                status : 4

            }
            data_presensi.push(init_presensi);
            @php
            $nomor_absen++;
            @endphp
        @endforeach
        console.log(data_siswa);
    </script>
</head>
<body>
    {{-- footer --}}
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


    {{-- main --}}
    <input type="hidden" id="id_peserta" name="id_peserta" value=0>
    <div class="class_header">
        @foreach ($kelas as $kelas)
            <h1>{{$kelas->kelas}}</h1>
        @endforeach
    </div>
    <div style="text-align: center">
        <h2 style="margin-top:2%" id="current_date"></h2>
    </div>
    <div class="profile">
        <div class="profile_id">
            <h2 id="no_peserta" style="margin-top:10px;color:white">2</h2>
        </div>
        <div class="profile_status">
            <h2 id="status_id_m" style="margin-top:10px;color:white">2</h2>
        </div>
        <img src="/img/person.jpg" style="margin-top:-15%;width: 100%; height: auto" alt="">
    </div>
    <div class="profile_name">
        <h1 id="nama_peserta">Budi Setiawan</h1>
    </div>
    <div class="prs-btn-1">
        <button id="hadir" style="background-color: #00CC52">Hadir</button>
        <button id="izin" style="margin : 0px 10% 0px 10%;background-color: #E3E800">Izin</button>
        <button id="sakit" style="background-color: #9F9F9F">Sakit</button>
    </div>
    <div class="prs-btn-2">
        <button id="absen" style="background-color: black;">Absen</button>
    </div>
    <div class="footer_page">
        {{-- left --}}
        <div id="prev" class="prev">
            <img src="/img/left-arrow.png" style="width: 50%;height:50%" alt="">
        </div>
        {{-- button --}}
        <div class="ft-btn">
            <button><img src="/img/list.png" alt=""></button>
            <button id="btn_list" type="button" onclick="$('#myModal').modal('show');"><img src="/img/upload.png" alt=""></button>
        </div>
        {{-- right --}}
        <div id="next" class="prev">
            <img src="/img/right-arrow.png" style="width: 50%;height:50%" alt="">
        </div>
    </div>

    {{-- modal section --}}
    <div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body" id="modal_body">
              <div style="text-align: center">
                <h1 style="font-weight: bold">Adult Class</h1>
                <h5 id="current_date2"></h5>
              </div>
              <div style="margin: 0px 20px 0px 20px;display:flex;justify-content: center">
                <img src="/img/magnifier.png" alt="" style="width:20px;height:20px;">
                <input type="text" placeholder="Cari siswa. . ." name="cari" style="width: 100%;height:20px;margin-left:10px;padding:10px 0px 10px 0px">
            </div>
            {{-- <div style="display: flex;justify-content: center;margin-top:15px;">
                <div class="profile_id_search">
                    <h2 id="no_peserta_search" style="line-height:1.5;color:white">2</h2>
                </div>
                <div style="background-color: #0069E3;border-radius : 5px;margin:0px 10px 0px 10px;width:100%;padding:0px 0px 0px 10px">
                    <h2 style="color:white">Abbas Satria Anargya</h2>
                </div>
                <div class="profile_id_search">
                    <h2 id="no_peserta_search" style="line-height:1.5;color:white">H</h2>
                </div>
            </div> --}}
            </div>
          </div>
        </div>
      </div>


    {{-- script section --}}
    <script>
        onload = function(){

            // modal load function
            // refresh

            // init
            for(let d = 0; d < data_siswa.length; d++) {
                
                $('#modal_body').append(`
            <div style="display: flex;justify-content: center;margin-top:15px;">
                <div class="profile_id_search">
                    <h2 id="no_peserta_search" style="line-height:1.5;color:white">`+data_siswa[d].no+`</h2>
                </div>
                <div style="background-color: #0069E3;border-radius : 5px;margin:0px 10px 0px 10px;width:100%;padding:0px 0px 0px 10px">
                    <h4 style="padding-top:10px;color:white">`+data_siswa[d].nama+`</h4>
                </div>
                <div class="profile_id_search">
                    <h2 id="status_id_`+data_siswa[d].id_peserta+`" style="line-height:1.5;color:white">A</h2>
                </div>
            </div>
            
            `);
            }
            

            let current_no = 0;
            let limit = data_siswa.length;
            let date = new Date();
            let dmy = { year: 'numeric', month: 'long', day: 'numeric' };
            date = date.toLocaleDateString('id-ID', dmy);
            let dt = $('#current_date').html(date);
            let dt2 = $('#current_date2').html(date);
            console.log(data_siswa[current_no].nama)
            
            // click function
            $('#btn_list').click(function (e) { 
                refresh();
                
            });
            $('#status_id_m').html('A');
            $('#id_peserta').val(data_siswa[current_no].id_peserta);
            let id_peserta_temp = $('#id_peserta').val();
            $('#nama_peserta').html(data_siswa[current_no].nama);
            $('#no_peserta').html(data_siswa[current_no].no);

            // func
            function refresh(){
                let letter;
                for(let a = 0; a < data_siswa.length; a ++){
                    for(let b = 0; b < data_presensi.length; b++){
                        if(data_siswa[a].id_peserta == data_presensi[b].id_peserta){
                            console.log("id_siswa : "+data_presensi[b].id_peserta+" | status : "+data_presensi[b].status);
                            switch(data_presensi[b].status){
                            case 1 : letter = 'H';break;
                            case 2 : letter = 'I';break;
                            case 3 : letter = 'S';break;
                            case 4 : letter = 'A';break;
                        }
                            $('#status_id_'+data_siswa[a].id_peserta).html(letter);
                        }
                    }   
                }
            }
            function check(){
                    let update = false;
                    let update_sel;
                    for(let x = 0; x < data_presensi.length; x++){
                        if(data_presensi[x].id_peserta == id_peserta_temp){
                            console.log('data ditemukan');
                            update_sel = x;
                            update = true;
                            break;
                        }
                    }
                    if(update){
                        console.log('data ditemukan update tampilan status')
                        let letter;
                        let temp_status = data_presensi[update_sel].status;
                        switch(temp_status){
                            case 1 : letter = 'H';break;
                            case 2 : letter = 'I';break;
                            case 3 : letter = 'S';break;
                            case 4 : letter = 'A';break;

                        }
                        $('#status_id_m').html(letter);
                    }else{
                        console.log('data tidak ditemukan');
                        $('#status_id_m').html('?');
                        
                    }
            }

            // next - prev
            $("#next").click(function (e) { 
              if(current_no < limit-1 ){
                current_no++;
                $('#id_peserta').val(data_siswa[current_no].id_peserta);
                id_peserta_temp = $('#id_peserta').val();
                $('#nama_peserta').html(data_siswa[current_no].nama);
                $('#no_peserta').html(data_siswa[current_no].no);
                              }
                check();
            });
            $("#prev").click(function (e) { 
              if(current_no >= 1){
                current_no--;
                $('#id_peserta').val(data_siswa[current_no].id_peserta);
                id_peserta_temp = $('#id_peserta').val();
                $('#nama_peserta').html(data_siswa[current_no].nama);
                $('#no_peserta').html(data_siswa[current_no].no);              }
                check();
            });

            // btn_presensi
            let temp_presensi = [];
            $('#hadir').click(function (e) { 
                e.preventDefault();
                temp_presensi = {
                    id_peserta : id_peserta_temp,
                    status : 1
                }
                if(data_presensi.length == 0){
                    data_presensi.push(temp_presensi);
                    console.log('tambah data pertama');
            $('#status_id_m').html('H');

                }else{
                    let update = false;
                    let update_sel;
                    for(let x = 0; x < data_presensi.length; x++){
                        if(data_presensi[x].id_peserta == id_peserta_temp){
                            console.log('data ditemukan');
                            update_sel = x;
                            update = true;
                            break;
                        }
                    }
                    if(update){
                        console.log('update data');
                        data_presensi[update_sel].status = 1;
                        $('#status_id_m').html('H');
                        console.log(data_presensi);
                    }else{
                        console.log('tambah data');
                        $('#status_id_m').html('H');
                        data_presensi.push(temp_presensi);
                    }
                }
                
            });
            $('#izin').click(function (e) { 
                e.preventDefault();
                temp_presensi = {
                    id_peserta : id_peserta_temp,
                    status : 2
                }
                if(data_presensi.length == 0){
                    data_presensi.push(temp_presensi);
                    console.log('tambah data pertama');
                    $('#status_id_m').html('I');
                }else{
                    let update = false;
                    let update_sel;
                    for(let x = 0; x < data_presensi.length; x++){
                        if(data_presensi[x].id_peserta == id_peserta_temp){
                            console.log('data ditemukan');
                            update_sel = x;
                            update = true;
                            break;
                        }
                    }
                    if(update){
                        console.log('update data');
                        $('#status_id_m').html('I');
                        data_presensi[update_sel].status = 2;
                        console.log(data_presensi);
                    }else{
                        console.log('tambah data');
                        $('#status_id_m').html('I');
                        data_presensi.push(temp_presensi);
                    }
                }
                
            });
            $('#sakit').click(function (e) { 
                e.preventDefault();
                temp_presensi = {
                    id_peserta : id_peserta_temp,
                    status : 3
                }
                if(data_presensi.length == 0){
                    data_presensi.push(temp_presensi);
                    console.log('tambah data pertama');
                    $('#status_id_m').html('S');
                }else{
                    let update = false;
                    let update_sel;
                    for(let x = 0; x < data_presensi.length; x++){
                        if(data_presensi[x].id_peserta == id_peserta_temp){
                            console.log('data ditemukan');
                            update_sel = x;
                            update = true;
                            break;
                        }
                    }
                    if(update){
                        console.log('update data');
                        data_presensi[update_sel].status = 3;
                        $('#status_id_m').html('S');
                        console.log(data_presensi);
                    }else{
                        console.log('tambah data');
                        data_presensi.push(temp_presensi);
                        $('#status_id_m').html('S');
                    }
                }
                
            });
            $('#absen').click(function (e) { 
                e.preventDefault();
                temp_presensi = {
                    id_peserta : id_peserta_temp,
                    status : 4
                }
                if(data_presensi.length == 0){
                    data_presensi.push(temp_presensi);
                    console.log('tambah data pertama');
                    $('#status_id_m').html('A');
                }else{
                    let update = false;
                    let update_sel;
                    for(let x = 0; x < data_presensi.length; x++){
                        if(data_presensi[x].id_peserta == id_peserta_temp){
                            console.log('data ditemukan');
                            update_sel = x;
                            update = true;
                            break;
                        }
                    }
                    if(update){
                        console.log('update data');
                        data_presensi[update_sel].status = 4;
                        $('#status_id_m').html('A');
                        console.log(data_presensi);
                    }else{
                        console.log('tambah data');
                        data_presensi.push(temp_presensi);
                        $('#status_id_m').html('A');
                    }
                }
                
            });
        }
    </script>
</body>
</html>