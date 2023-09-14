<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekapitulasi Presensi</title>
</head>
<body>
    <table border = 1>
        <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th colspan="{{count($data_presensi)}}">Tanggal Kegiatan</th>
        </tr>
        <tr>
            @php
                $previous_date = null;
            @endphp
            @foreach($data_presensi as $data)
                @if($data->waktu !== $previous_date)
                <th>{{$data->waktu}}</th>
                @endif
                @php
                $previous_date = $data->waktu;
            @endphp
            @endforeach
        </tr>
        @php
            $x = 0;
            // $previous_student = null;
            $status_view = null;
        @endphp
        @foreach ($data_peserta as $peserta)
            <tr>
                @php
                    
                    $x++;
                @endphp
                <td>{{$x}}</td>
                <td>{{$peserta->nama_peserta}}</td>
                @foreach($data_presensi as $presensi)
                    @if($presensi->status == null)
                        <td>Alpha</td>
                    @endif
                    @if($presensi->id_peserta == $peserta->id_peserta)
                        @php
                            switch($presensi->status){
                                case 1 : 
                                    $status_view = "Absen";
                                    break;
                                case 2 :
                                    $status_view = "Hadir";
                                    break;
                                case 3 : 
                                    $status_view = "Izin";
                                    break;
                                case 4 : 
                                    $status_view = "Alpha";
                                    break;
                            }
                        @endphp
                            <td>{{$status_view}}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        
    </table>
</body>
</html>