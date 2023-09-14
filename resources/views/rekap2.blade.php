<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap 2</title>
</head>
<body>
    @php
        $tanggal = null;
    @endphp
    @foreach($data_presensi as $data)
        @php
            $tanggal = $data->waktu;
        @endphp
    @endforeach
    <h1>Waktu Kegiatan : {{$tanggal}}</h1>
        @foreach ($data_peserta as $data)
    <div style="border :1px solid red;padding:10px;margin-bottom:10px;">
         <h2>{{$data->nama_peserta}}</h2> 
         @foreach ($data_presensi as $presensi)
             @if($presensi->id_peserta == $data->id_peserta)
             <span>Status Kehadiran : </span>
             <label for="status">Hadir</label>
             <input type="radio" value="2" name="status_{{$presensi->id}}" id="" @php
                 if($presensi->status == 2){
                    echo "checked";
                 }
             @endphp>  
             <label for="status">Sakit</label>
             <input type="radio" value="3" name="status_{{$presensi->id}}" id="">  
             <label for="status">Izin</label>
             <input type="radio" value="4" name="status_{{$presensi->id}}" id="">  
             <label for="status">Alpha</label>
             <input type="radio" value="1" name="status_{{$presensi->id}}" id=""> 
             @endif
         @endforeach 
    </div>
        @endforeach
    
</body>
</html>