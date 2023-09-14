<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\peserta;
use App\Models\presensi;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // Fungsi Utama
    public function unggah_presensi(Request $request){
        for($i = 0; $i < count($request->input('id_siswa')); $i++){
            presensi::create([
                'id_karyawan' => 7,
                'waktu' => $request->waktu,
                'id_peserta' => $request->id_siswa[$i],
                'status' => $request->status_siswa[$i],
            ]);
        }
        return redirect()->route('k_presensi');
    }
    public function k_presensi(){
        $data_kelas = kelas::all();
        return view('karyawan.presensi',['data_kelas'=>$data_kelas]);
    }
    public function PilihKelas($id_kelas){
        // dd($id_kelas);
        $data_peserta = peserta::where('id_kelas',$id_kelas)->get();
        $data_kelas = kelas::all();
        return view('karyawan.presensi',['data_peserta'=>$data_peserta,'data_kelas'=>$data_kelas,'id_kelas'=>$id_kelas]);
    }
    // Fungsi Cadangan
    public function ajaxPilihKelas(Request $request){
        $data = array(
            'pesan'=>$request->nama." Telah diterima"
        );
        return response()->json($data);
    }
}
