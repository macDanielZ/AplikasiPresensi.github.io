<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery.js"></script>
    <title>Presensi</title>
</head>
<body>
    <table>
        <tr>
            <td><h1>Tanggal</h1></td>
            <td><input type="date" name="" id=""></td>
        </tr>
    </table>
    @foreach($data_peserta as $data)
        <div style = "border : 1px solid red;padding:10px;margin-bottom : 10px;">
            <h1>{{$data->nama_peserta}}</h1>
            <span><h1>status kehadiran : </h1></span>
            <label for="hadir_{{$data->id_peserta}}">Hadir</label>
            <input type="radio" name="status_{{$data->id_peserta}}" id="hadir_{{$data->id_peserta}}" value="2">
            <label for="hadir_{{$data->id_peserta}}">Sakit</label>
            <input type="radio" name="status_{{$data->id_peserta}}" id="hadir_{{$data->id_peserta}}" value="3">
            <label for="hadir_{{$data->id_peserta}}">Izin</label>
            <input type="radio" name="status_{{$data->id_peserta}}" id="hadir_{{$data->id_peserta}}" value="4">
            <label for="hadir_{{$data->id_peserta}}">Alpha</label>
            <input type="radio" name="status_{{$data->id_peserta}}" id="hadir_{{$data->id_peserta}}" value="1">
        </div>
    @endforeach
    <form id="submission" action="{{route('presensi_kehadiran')}}" method="POST">
        @csrf
        <input type="hidden" id="date" name="date">
        <button id="submit">Submit</button>
    </form>
    <script>
        $(document).ready(function () {
            let id_siswa = [];
            let status_siswa = [];
            let repeat = 0;
            let st;
            let date = new Date();
            let year = date.getFullYear().toString().padStart(4, '0'); // Get full year
            let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Get month (0-indexed)
            let day = date.getDate().toString().padStart(2, '0'); // Get day
            let formattedDate = `${year}-${month}-${day}`;
            console.log(formattedDate);
            $('#date').val(formattedDate);
            function push_data(){
                @foreach($data_peserta as $data)
                id_siswa.push('{{$data->id_peserta}}');
                st = $('input[name="status_{{$data->id_peserta}}"]:checked').val();
                // console.log(st);
                status_siswa.push(st);
                @endforeach
               
            }
            
            $('#submit').click(function (e) { 
            // e.preventDefault();
            if(repeat != 0){
                id_siswa = [];
                status_siswa = [];
                push_data();
                repeat = 0;
            }else{
                push_data();
                repeat++;
            }
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
            console.log('id siswa : '+id_siswa);
            console.log('status siswa : '+status_siswa);
            $('#submission').submit();
             });
        });

    </script>
</body>
</html>