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
        // tambahkan validasi tanggal
        $check = presensi::where('id_peserta',$request->id_siswa[0])->where('waktu',$request->waktu)->get();
        if(count($check) == null){
            for($i = 0; $i < count($request->input('id_siswa')); $i++){
                presensi::create([
                    'id_karyawan' => 11,
                    'waktu' => $request->waktu,
                    'id_peserta' => $request->id_siswa[$i],
                    'status' => $request->status_siswa[$i],
                ]);
            }
            return redirect()->route('k_presensi')->with('success','Berhasil Menggunggah Presensi !');
        }else{
            return redirect()->back()->with('error','kelas sudah ada');
            
        }
        
    }
    public function k_presensi(){
        $data_kelas = kelas::all();
        return view('karyawan.presensi',['data_kelas'=>$data_kelas]);
    }
    public function PilihKelas($id_kelas,Request $request){
        // dd($request->all());
        $cc_waktu = $request->waktu_hidden;
        $data_peserta = peserta::where('id_kelas',$id_kelas)->get();
        $data_kelas = kelas::all();
        // dd($cc_waktu);
        return view('karyawan.presensi',['cc_waktu'=>$cc_waktu,'data_peserta'=>$data_peserta,'data_kelas'=>$data_kelas,'id_kelas'=>$id_kelas]);
    }
    // Fungsi Cadangan
    public function ajaxPilihKelas(Request $request){
        $data = array(
            'pesan'=>$request->nama." Telah diterima"
        );
        return response()->json($data);
    }
}
