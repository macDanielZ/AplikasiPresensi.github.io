<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <title>Data Akun | Admin</title>
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
        .cust_card{
            padding:10px; border : 1px solid black;margin:10px;
            border-radius: 10px;
            background-color: #DAC0A3;
            font-weight: bold;
            box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)
        }
        .alert-danger {
            background-color: #ffcccc; /* Lighter red color */
            border-color: #ff9999; /* Lighter border color */
            color: #990000; /* Darker text color */
            font-weight: bold; /* Make text bold */
            /* Add any additional styles as needed */
            margin : 0px 10px 0px 10px;
        }
        .alert-success {
            background-color: #d4edda; /* Lighter green color */
            border-color: #c3e6cb; /* Lighter border color */
            color: #155724; /* Darker text color */
            font-weight: bold; /* Make text bold */
            /* Add any additional styles as needed */
            margin : 0px 10px 0px 10px;

        }
        
        .logout-container{
            display: flex;
            font-size: 25px;
            align-items: center;
            justify-content: center;
            margin-left : 10px;
        }
        .logout-container button{
            background-color: transparent;
            border : none;
        }
    </style>
    <script>
        let list_id_user = [];
    </script>
</head>
<body style="background-color: #EADBC8">
    {{-- header --}}
    @include('header')



    {{-- content --}}
    <div class="cust_card">
        <p style="font-size:25px;text-align:center"><b>{{__('admin_user.title')}}</b></p>
    </div>
    
        {{-- alert --}}
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @elseif(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif

    <div class="cust_card">
        <button data-bs-toggle="modal" data-bs-target="#tambah_user" class="btn btn-success">{{__('admin_user.add_user')}}</button>
        {{-- admin --}}
        <div class="cust_card">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading_admin">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accord_admin" aria-expanded="false" aria-controls="collapseTwo">
                  <p style="font-size:20px;font-weight: bold">Admin<span class="accordion-icon"></span></p>
              </button>
              <div id="accord_admin" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                {{-- magic goes here -w- --}}
                {{-- itung jumlah admin --}}
                @php
                    $count_user = $data_user->where('jabatan','Admin');
                @endphp
                {{-- end itung jumlah admin --}}
                @if($count_user->count() > 0)
                @foreach($data_user as $data)
                @if($data->jabatan == 'Admin')
                <div class="cust_card" style="background-color: #EADBC8">
                    <div class="d-flex justify-content-between">
                        <p style="font-weight: bold;font-size:20px;">{{$data->nama_karyawan}}</p>
                    <div style="display: flex;align-items: center">
                        <button data-bs-toggle="modal" data-bs-target="#edit_user_{{$data->id}}" class="btn btn-warning" style="font-size:15px">Edit</button>
                        <button data-bs-toggle="modal" data-bs-target="#delete_user_{{$data->id}}" class="btn btn-danger" style="font-size:15px">Hapus</button>
                        <script>
                            list_id_user.push('{{$data->id}}');
                        </script>
                    </div>
                    </div>
                </div>
        
                {{-- Modal Delete User --}}
                <div class="modal fade" id="delete_user_{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color : #DAC0A3">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: #DAC0A3">             
                        <p style="text-align:center;font-weight: bold;font-size:20px;">Apakah anda yakin ingin menghapus akun dengan nama "{{$data->nama_karyawan}}"</p>
                        </div>
                        <div class="modal-footer" style="background-color: #DAC0A3">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <form action="{{route('admin.hapus_user',['id'=>$data->id])}}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus Akun</button>           
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
        
                {{-- modal Edit User --}}
                <div class="modal fade" id="edit_user_{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color : #DAC0A3">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pengguna : "{{$data->nama_karyawan}}"</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: #DAC0A3">             
                            <form action="{{route('admin.edit_user',['id'=>$data->id])}}" method="POST">
                                @method('put')
                                @csrf
                                <table class="table" style="font-weight: bold">
                                    <tbody>
                                    <tr>
                                        <td>Nama Pengguna</td>
                                        <td><input type="text" name="nama_karyawan" value="{{$data->nama_karyawan}}" required></td>
                                    </tr>
                                    <tr>
                                        <td>Email Pengguna</td>
                                        <td><input type="email" name="email" value="{{$data->email}}" required></td>   
                                    </tr>
                                    <tr>
                                        <td>Password Baru Pengguna</td>
                                        <td><input type="password" name="password" placeholder="Kosongkan jika sama"></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Jabatan Pengguna</td>
                                        <td><select name="role" id="role" required>
                                            <option value="Karyawan" @if($data->jabatan == 'Karyawan') selected @endif>Karyawan</option>
                                            <option value="Manajemen" @if($data->jabatan == 'Manajemen') selected @endif>Manajemen</option>
                                            <option value="Admin" @if($data->jabatan == 'Admin') selected @endif>Admin</option>
                                        </select></td>
                                    </tr>
                                </tbody>
                                  </table>
                          
                        </div>
                        <div class="modal-footer" style="background-color: #DAC0A3">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-warning">Perbarui Akun</button>           
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
                @endif
                @endforeach
                @else
                <div class="accordion-body cust_card" style="background-color: #EADBC8">
                    <div class="d-flex justify-content-between">
                        <p style="font-weight: bold;font-size:20px;">Tidak Ada User dengan jabatan Admin</p>
                    </div>
                </div>
                @endif
            </div>  
              </h2>
        </div>
        </div>
        {{-- Manajer --}}
        <div class="cust_card">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_manajemen">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accord_manajemen" aria-expanded="false" aria-controls="collapseTwo">
                      <p style="font-size:20px;font-weight: bold">Manajer<span class="accordion-icon"></span></p>
                  </button>
                  </h2>
                  <div id="accord_manajemen" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    {{-- magic goes here -w- --}}
                    {{-- itung jumlah admin --}}
                    @php
                        $count_user = $data_user->where('jabatan','Manajer');
                    @endphp
                    {{-- end itung jumlah admin --}}
                    @if($count_user->count() > 0)
                    @foreach($data_user as $data)
                    @if($data->jabatan == 'Manajer')
                    <div class="cust_card" style="background-color: #EADBC8">
                        <div class="d-flex justify-content-between">
                            <p style="font-weight: bold;font-size:20px;">{{$data->nama_karyawan}}</p>
                        <div style="display: flex;align-items: center">
                            <button data-bs-toggle="modal" data-bs-target="#edit_user_{{$data->id}}" class="btn btn-warning" style="font-size:15px">Edit</button>
                            <button data-bs-toggle="modal" data-bs-target="#delete_user_{{$data->id}}" class="btn btn-danger" style="font-size:15px">Hapus</button>
                            <script>
                                list_id_user.push('{{$data->id}}');
                            </script>
                        </div>
                        </div>
                    </div>
            
                    {{-- Modal Delete User --}}
                    <div class="modal fade" id="delete_user_{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color : #DAC0A3">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #DAC0A3">             
                            <p style="text-align:center;font-weight: bold;font-size:20px;">Apakah anda yakin ingin menghapus akun dengan nama "{{$data->nama_karyawan}}"</p>
                            </div>
                            <div class="modal-footer" style="background-color: #DAC0A3">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <form action="{{route('admin.hapus_user',['id'=>$data->id])}}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus Akun</button>           
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
            
                    {{-- modal Edit User --}}
                    <div class="modal fade" id="edit_user_{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color : #DAC0A3">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pengguna : "{{$data->nama_karyawan}}"</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #DAC0A3">             
                                <form action="{{route('admin.edit_user',['id'=>$data->id])}}" method="POST">
                                    @method('put')
                                    @csrf
                                    <table class="table" style="font-weight: bold">
                                        <tbody>
                                        <tr>
                                            <td>Nama Pengguna</td>
                                            <td><input type="text" name="nama_karyawan" value="{{$data->nama_karyawan}}" required></td>
                                        </tr>
                                        <tr>
                                            <td>Email Pengguna</td>
                                            <td><input type="email" name="email" value="{{$data->email}}" required></td>   
                                        </tr>
                                        <tr>
                                            <td>Password Baru Pengguna</td>
                                            <td><input type="password" name="password" placeholder="Kosongkan jika sama"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Jabatan Pengguna</td>
                                            <td><select name="role" id="role" required>
                                                <option value="Karyawan" @if($data->jabatan == 'Karyawan') selected @endif>Karyawan</option>
                                                <option value="Manajemen" @if($data->jabatan == 'Manajemen') selected @endif>Manajemen</option>
                                                <option value="Admin" @if($data->jabatan == 'Admin') selected @endif>Admin</option>
                                            </select></td>
                                        </tr>
                                    </tbody>
                                      </table>
                              
                            </div>
                            <div class="modal-footer" style="background-color: #DAC0A3">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-warning">Perbarui Akun</button>           
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <div class="accordion-body cust_card" style="background-color: #EADBC8">
                        <div class="d-flex justify-content-between">
                            <p style="font-weight: bold;font-size:20px;">Tidak Ada User dengan jabatan Manajer</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            </div>
            {{-- Karyawan --}}
        <div class="cust_card">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_admin">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accord_k" aria-expanded="false" aria-controls="collapseTwo">
                    <p style="font-size:20px;font-weight: bold">Karyawan<span class="accordion-icon"></span></p>
                    </button>
                    </h2>
                    <div id="accord_k" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    {{-- magic goes here -w- --}}
                    {{-- itung jumlah admin --}}
                    @php
                        $count_user = $data_user->where('jabatan','Karyawan');
                    @endphp
                    {{-- end itung jumlah admin --}}
                    @if($count_user->count() > 0)
                    @foreach($data_user as $data)
                    @if($data->jabatan == 'Karyawan')
                    <div class="cust_card" style="background-color: #EADBC8">
                        <div class="d-flex justify-content-between">
                            <p style="font-weight: bold;font-size:20px;">{{$data->nama_karyawan}}</p>
                        <div style="display: flex;align-items: center">
                            <button data-bs-toggle="modal" data-bs-target="#edit_user_{{$data->id}}" class="btn btn-warning" style="font-size:15px">Edit</button>
                            <button data-bs-toggle="modal" data-bs-target="#delete_user_{{$data->id}}" class="btn btn-danger" style="font-size:15px">Hapus</button>
                            <script>
                                list_id_user.push('{{$data->id}}');
                            </script>
                        </div>
                        </div>
                    </div>
            
                    {{-- Modal Delete User --}}
                    <div class="modal fade" id="delete_user_{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color : #DAC0A3">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #DAC0A3">             
                            <p style="text-align:center;font-weight: bold;font-size:20px;">Apakah anda yakin ingin menghapus akun dengan nama "{{$data->nama_karyawan}}"</p>
                            </div>
                            <div class="modal-footer" style="background-color: #DAC0A3">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <form action="{{route('admin.hapus_user',['id'=>$data->id])}}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus Akun</button>           
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
            
                    {{-- modal Edit User --}}
                    <div class="modal fade" id="edit_user_{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color : #DAC0A3">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pengguna : "{{$data->nama_karyawan}}"</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #DAC0A3">             
                                <form action="{{route('admin.edit_user',['id'=>$data->id])}}" method="POST">
                                    @method('put')
                                    @csrf
                                    <table class="table" style="font-weight: bold">
                                        <tbody>
                                        <tr>
                                            <td>Nama Pengguna</td>
                                            <td><input type="text" name="nama_karyawan" value="{{$data->nama_karyawan}}" required></td>
                                        </tr>
                                        <tr>
                                            <td>Email Pengguna</td>
                                            <td><input type="email" name="email" value="{{$data->email}}" required></td>   
                                        </tr>
                                        <tr>
                                            <td>Password Baru Pengguna</td>
                                            <td><input type="password" name="password" placeholder="Kosongkan jika sama"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Jabatan Pengguna</td>
                                            <td><select name="role" id="role" required>
                                                <option value="Karyawan" @if($data->jabatan == 'Karyawan') selected @endif>Karyawan</option>
                                                <option value="Manajemen" @if($data->jabatan == 'Manajemen') selected @endif>Manajemen</option>
                                                <option value="Admin" @if($data->jabatan == 'Admin') selected @endif>Admin</option>
                                            </select></td>
                                        </tr>
                                    </tbody>
                                      </table>
                              
                            </div>
                            <div class="modal-footer" style="background-color: #DAC0A3">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-warning">Perbarui Akun</button>           
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <div class="accordion-body cust_card" style="background-color: #EADBC8">
                        <div class="d-flex justify-content-between">
                            <p style="font-weight: bold;font-size:20px;">Tidak Ada User dengan jabatan Karyawan</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- data setiap orang --}}
        
    </div>

    {{-- modal tambah user --}}
    <form action="{{route('admin.tambah_user')}}" method="POST">
        @csrf
    <div class="modal fade" id="tambah_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color : #DAC0A3">
              <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('admin_user.title_add_user')}}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #DAC0A3">             
              <table class="table" style="font-weight: bold">
                <tbody>
                <tr>
                    <td>{{__('admin_user.new_user_name')}}</td>
                    <td><input type="text" name="nama_karyawan" required></td>
                </tr>
                <tr>
                    <td>{{__('admin_user.new_user_email')}}</td>
                    <td><input type="email" name="email" required></td>   
                </tr>
                <tr>
                    <td>{{__('admin_user.new_user_role')}}</td>
                    <td><select name="role" id="role" required>
                        <option value="Karyawan">{{__('admin_user.employees')}}</option>
                        <option value="Manajemen">{{__('admin_user.management')}}</option>
                        <option value="Admin">{{__('admin_user.admin')}}</option>
                    </select></td>
                </tr>
            </tbody>
              </table>
            </div>
            <div class="modal-footer" style="background-color: #DAC0A3">
              <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
              <button type="submit" class="btn btn-success">Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <script>
         // fungsi tombol di header
            
         $('#logout').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("login")}}';
            });
            $('#home').click(function (e) { 
                // e.preventDefault();
                window.location.href = '{{route("admin.index")}}';
            });
    </script>
</body>
</html>