<?php
session_start();
include '../../../koneksi.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = ($_POST['password']); // Enkripsi password

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM user WHERE Username='$username' AND Password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Simpan informasi user ke dalam session
        $_SESSION['username'] = $user['Username'];
        $_SESSION['role'] = $user['Role'];
        $_SESSION['fullname'] = $user['NamaLengkap'];
        $_SESSION['userID'] = $user['UserID'];

        // Cek apakah pengguna adalah admin/petugas atau user biasa
        if (isset($_POST['admin_petugas']) && ($_POST['admin_petugas'] == 'on')) {
            // Jika checkbox dicentang, cek apakah dia admin atau petugas
            if ($user['Role'] == 'admin') {
                header('Location: ../../../admin/indexadm.php'); // Arahkan ke dashboard admin
            } elseif ($user['Role'] == 'petugas') {
                header('Location: ../../../petugas/indexpet.php'); // Arahkan ke dashboard petugas
            } else {
                echo "<script>alert('Anda bukan admin / petugas!');</script>";
                echo "<script>window.location.href='login.php';</script>";
            }
        } else {
            // Jika checkbox tidak dicentang, arahkan ke dashboard user
            if ($user['Role'] == 'user') {
                header('Location: ../../../user/indexuser.php');
            } else {
                echo "<script>alert('Role tidak dikenali!');</script>";
                echo "<script>window.location.href='login.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Username atau password salah');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
}

?>
