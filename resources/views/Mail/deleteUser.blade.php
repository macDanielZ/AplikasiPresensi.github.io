<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notifikasi Penghapusan Pengguna</title>
</head>
<body>
    <h1>Halo {{$user->nama_karyawan}}, Mohon maaf atas ketidaknyamanannya !</h1>
    <h3>Akun anda dengan nama {{$user->nama_karyawan}} dan email {{$user->email}} dihapus dari sistem aplikasi Presensi Social Sunday</h3>
    <h3>Dengan adanya penghapusan akun ini anda tidak dapat mengakses aplikasi Presnesi Social Sunday Lagi</h3>
    <h3>Terimakasih atas waktunya !</h3>
</body>
</html>