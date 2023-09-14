<?php

namespace App\Http\Controllers;

use App\Exports\DataTableExport;
use App\Models\kelas;
use App\Models\peserta;
use App\Models\presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(){
        $user = auth()->user();
        $nama_user = $user->nama_karyawan;
        $jabatan = $user->jabatan;
        return view('admin.index',['nama_user'=>$nama_user,'jabatan'=>$jabatan]);
    }

    public function user_list(){
        $data_user = User::all();
        return view('admin.user',['data_user' => $data_user]);
    }

    public function siswa_list(){
        $data_peserta = peserta::leftJoin('kelas','pesertas.id_kelas','=','kelas.id_kelas')->orderBy('kelas.kelas','asc')->orderBy('pesertas.nama_peserta','asc')->get();
        $data_kelas = kelas::all();
        $data_kelas2 = kelas::all();
        return view('admin.peserta',['data_kelas2'=>$data_kelas2,'data_kelas' => $data_kelas,'data_peserta' => $data_peserta]);
    }

    //class management
    public function list_kelas(){
        $data_kelas = kelas::all();
        return view('admin.kelas',['data_kelas'=>$data_kelas]);
    }
    public function tambah_kelas(Request $request){
        $check_kelas = kelas::where('kelas',$request->kelas)->get();
        if(count($check_kelas) == 0){
            kelas::create([
                'kelas' => $request->kelas
            ]);
            return redirect()->back()->with('success','Kelas Berhasil Ditambahkan');
        }else{
            return redirect()->back()->with('error','Gagal menambahkan Kelas,Nama Kelas Sudah ada!');
        }
    }
    public function edit_kelas($id,Request $request){
    //  dd($id);  
        $select = kelas::find($id);
        $select->kelas = $request->kelas;
        $select->save();
        return redirect()->back()->with('success','Kelas Berhasil Diperbarui');

    }
    public function hapus_kelas($id){
    // dd($id);
        $select = kelas::find($id);
        $select->delete();
        return redirect()->back()->with('success','Kelas Berhasil Dihapus');


        
    }

    // Recap Management
    public function rekap(){
        $data_peserta = peserta::all();
        $data_kelas = kelas::all();
        $data_presensi = presensi::all();
        $user = auth()->user();
        $jabatan = $user->jabatan;
        return view('admin.Rekap',['jabatan'=>$jabatan,'data_peserta'=>$data_peserta,'data_kelas'=>$data_kelas,'data_presensi'=>$data_presensi]);
    }

    public function export_excel(){
        return Excel::download(new DataTableExport, 'data.csv');
    }

    public function rekap_cari_kelas(Request $request){
        // dd($request->all());
        $data_tabel = presensi::leftJoin('pesertas','presensis.id_peserta','=','pesertas.id_peserta')->leftJoin('kelas','pesertas.id_kelas','=','kelas.id_kelas')->whereBetween('waktu',[$request->waktu_start,$request->waktu_end])->where('pesertas.id_kelas',$request->kelas)->orderBy('waktu','asc')->get();
        // dd($data_presensi);
        $data_peserta = peserta::leftJoin('kelas','pesertas.id_kelas','=','kelas.id_kelas')->where('pesertas.id_kelas',$request->kelas)->get();
        $data_kelas = kelas::all();
        $data_presensi = presensi::all();
        // dd($data_peserta);
        // dd($data_tabel);
        $user = auth()->user();
        $jabatan = $user->jabatan;
        return view('admin.Rekap',['jabatan'=>$jabatan,'data_peserta'=>$data_peserta,'data_kelas'=>$data_kelas,'data_presensi'=>$data_presensi,'data_tabel'=>$data_tabel]);
    }

    //student management
    public function tambah_siswa(Request $request){
        // dd($request->all());
        peserta::create([
            'nama_peserta'=>$request->nama_peserta,
            'id_kelas'=>$request->kelas,
        ]);
        return redirect()->back()->with('success','Peserta Baru Berhasil Ditambahkan');
    }
    public function edit_siswa($id,Request $request){
        $select =peserta::find($id);
        $select->nama_peserta = $request->nama_peserta;
        $select->id_kelas = $request->id_kelas;
        $select->save();
        return redirect()->back()->with('success','Peserta Berhasil Diperbarui');

    }
    public function hapus_siswa($id){
        // dd($id);
        $select = peserta::find($id);
        $name = $select->nama_peserta;
        $select->delete();
        return redirect()->back()->with('success','Peserta '.$name.' Berhasil Dihapus');
    }


    // attendance management
    public function presensi(){
        $data_kelas = kelas::all();
        return view('admin.presensi',['data_kelas'=>$data_kelas]);
    }

    public function delete(Request $request){
        // dd($request->id_presensi);
        for($i = 0; $i < count($request->id_presensi); $i++){
            $select = presensi::find($request->id_presensi[$i]);
            $select->delete();
        }
        return redirect()->route('admin.presensi');
    }
    public function update(Request $request){
        // dd($request->all());
        for($i = 0; $i < count($request->id_siswa); $i++){
            $select = presensi::find($request->id_presensi[$i]);
            $select->update([
                'status' => $request->status_siswa[$i],
            ]);
        }
        return redirect()->route('admin.presensi');
    }

    public function cari_presensi(Request $request,$id_kelas){
        // dd($request->s_waktu);
        // $data_presensi = presensi::leftJoin('pesertas','presensis.id_peserta','=','pesertas.id_peserta')->where('pesertas.id_kelas',$request->id_kelas)->where('presensis.waktu',$request->s_waktu)->get();
        $data_presensi = presensi::leftJoin('pesertas','presensis.id_peserta','=','pesertas.id_peserta')->where('pesertas.id_kelas',$request->id_kelas)->where('presensis.waktu',$request->s_waktu)->get();
        // dd($data_presensi);
        $data_peserta = peserta::where('id_kelas',$id_kelas)->get();
        $data_kelas = kelas::all();
        $debug_arr = array();
        foreach($data_peserta as $x){
            array_push($debug_arr,$x->nama_peserta);
        }
        // dd($debug_arr);
        return view('admin.presensi',['data_presensi'=>$data_presensi,'data_kelas'=>$data_kelas,'id_kelas'=>$id_kelas,'data_peserta'=>$data_peserta]);
    }

    // User Management
    public function tambah_user(Request $request){
        // dd($request->nama_karyawan);
        $check_email = User::where('email',$request->email)->get();
        if(count($check_email) == 0){
            User::create([
                'nama_karyawan'=>$request->nama_karyawan,
                'jabatan'=>$request->role,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            return redirect()->back()->with('success','Akun berhasil terdaftar !');
        }else{
            return redirect()->back()->with('error','Email yang digunakan sudah terdaftar !');
        }
    }

    public function hapus_user($id){
        $select = User::find($id);
        $name = $select->nama_karyawan;
        $select->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Akun : '.$name);
    }

    public function edit_user($id, Request $request){
        $getCurrentUser = User::find($id);
        $check_email = User::where('email',$request->email)->get();
        if($request->email == $getCurrentUser->email){
            // tidak ganti email
            if($request->password != null){

                // ganti password
               
                    $data= User::find($request->id);
                    $data->nama_karyawan = $request->nama_karyawan;
                    $data->password = bcrypt($request->password);
                    $data->save();

                    return redirect()->back()->with('success', 'Berhasil Ubah Data !');
                    
            }else{
                // password sama
                // dd('password sama');
               
                    $data= User::find($request->id);
                    $data->nama_karyawan = $request->nama_karyawan;
                    $data->save();

                    return redirect()->back()->with('success', 'Berhasil Ubah Data !');
                    
            }
        }else{
            // ganti email
            // dd('ganti email');
            // dd(count($check_email));
                if(count($check_email) != 0){
                    // dd('email : '.$request->email.' sama dengan '.$getCurrentUser->email);
                    return redirect()->back()->with('error','Email yang digunakan sudah terdaftar !');
                }else{
                    if($request->password != null){

                        // ganti password
                       
                            $data= User::find($request->id);
                            $data->nama_karyawan = $request->nama_karyawan;
                            $data->email = $request->email;
                            $data->password = bcrypt($request->password);
                            $data->save();

                            return redirect()->back()->with('success', 'Berhasil Ubah Data !');
                            
                    }else{
                        // password sama
                        // dd('password sama');
                       
                            $data= User::find($request->id);
                            $data->nama_karyawan = $request->nama_karyawan;
                            $data->email = $request->email;
                            $data->save();
                            return redirect()->back()->with('success', 'Berhasil Ubah Data !');
                            
                    } 
                }

        }
    }
}
