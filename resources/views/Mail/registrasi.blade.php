<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrasi Pengguna Aplikasi Presensi Social Sunday</title>
</head>
<body>
    <h1>Selamat datang {{$user->nama_karyawan}} di aplikasi Presensi Social Sunday</h1>
    <h3>Nama Anda : {{$user->nama_karyawan}}</h3>
    <h3>Password Anda : {{$password}}</h3>
    <h3>Email yang terdaftar : {{$user->email}}</h3>
</body>
</html>