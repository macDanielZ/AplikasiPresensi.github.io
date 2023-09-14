<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\peserta;
use App\Models\presensi;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function debug(){
        return view('debug.debug');
    }
    public function presensi_kehadiran(Request $request){
        // dd($request->id_siswa);
        for($i = 0; $i < count($request->input('id_siswa')); $i++){
            // echo $i;
            presensi::create([
                'waktu' => $request->date,
                'id_peserta' => $request->id_siswa[$i],
                'status' => $request->status_siswa[$i],
            ]);
        }
    }
    public function log(){
        $data_peserta = peserta::all();
        return view('presensi2',['data_peserta' => $data_peserta]);
    }
    public function rekap($debug = null){
        // dd($debug);
        
        $data_presensi = presensi::orderBy('waktu','asc')->leftJoin('pesertas','presensis.id_peserta','=','pesertas.id_peserta')->get();
        $data_peserta = peserta::all();
        // dd($data_presensi);
        if($debug != null){
            $data_presensi = presensi::where('waktu','2023-09-10')->get();
            // dd($data_presensi);
            // dd($data_peserta);
            return view('rekap2',['data_peserta'=>$data_peserta,'data_presensi'=>$data_presensi]);
        }
        return view('rekap',['data_presensi' => $data_presensi,'data_peserta' => $data_peserta]);
    }
    public function login(){
        return view('login');
    }
    public function presensi($id_kelas){
        $peserta = Peserta::where('id_kelas',$id_kelas)->get();
        $kelas = kelas::where('id_kelas',$id_kelas)->get();
        // dd($kelas);
        return view('presensi',['peserta'=>$peserta,'kelas'=>$kelas]);
    }
    public function index($debug = null){
        $peserta = peserta::all();
        $kelas = kelas::all();
        $data = $kelas;
        // $jml_peserta = Count(peserta::where('id_kelas','1')->get());
        if($debug==null){
            //dd('Debug is null');
            return view('main2',['data' => $kelas,'peserta' => $peserta]);
        }
        //dd('not null result :'.$debug);
        return view('main',['data' => $data,'peserta' => $peserta]);

    }
    public function files(){
        return view('files');
    }
}
