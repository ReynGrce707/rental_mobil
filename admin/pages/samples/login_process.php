<?php
session_start();
include '../../koneksi.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user'];
    $password = ($_POST['pass']); // Enkripsi password

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM tb_user WHERE user='$username' AND pass='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Simpan informasi user ke dalam session
        $_SESSION['user'] = $user['user'];
        $_SESSION['lvl'] = $user['lvl'];
        $_SESSION['id_user'] = $user['id_user'];
        
        // Cek apakah pengguna adalah admin, petugas, atau user biasa
        if ($user['lvl'] == 'admin') {
            header('Location: ../../../admin/indexadm.php'); // Arahkan ke dashboard admin
        } elseif ($user['lvl'] == 'petugas') {
            header('Location: ../../../petugas/indexpet.php'); // Arahkan ke dashboard petugas
        } else {
            echo "<script>alert('Role tidak dikenali!');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    } else {
        // Jika username dan password tidak cocok, coba cek di tabel tb_member
        $query = "SELECT * FROM tb_member WHERE user='$username' AND pass='$password'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $user['user'];
            $_SESSION['lvl'] = $user['user'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['id_user'] = $user['nik'];

            header('Location: ../../../user/indexuser.php'); // Arahkan ke dashboard user
        } else {
            echo "<script>alert('Username atau password salah');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }
}

?>