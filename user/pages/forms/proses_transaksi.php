<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    die("Anda harus login terlebih dahulu.");
}

// Ambil NIK dari session
$nik = $_SESSION['id_user'];

// Ambil data dari form
$nopol = $_POST['nopol']; 
$tgl_ambil = $_POST['tgl_ambil']; 
$downpayment = $_POST['downpayment']; 
$add_ons = $_POST['add_ons']; 
$total = $_POST['total']; 
$kekurangan = $_POST['kekurangan'];
$tgl_booking = date('Y-m-d'); 
$tgl_kembali = date('Y-m-d', strtotime($tgl_ambil . ' + 5 days')); 


$conn = new mysqli("localhost", "root", "", "rental_mobil"); 
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql_insert = "INSERT INTO tb_transaksi (nik, nopol, tgl_booking, tgl_ambil, tgl_kembali, supir, total, downpayment, kekurangan, status) 
VALUES ('$nik', '$nopol', '$tgl_booking', '$tgl_ambil', '$tgl_kembali', '$add_ons', '$total', '$downpayment', '$kekurangan', 'booking')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Transaksi berhasil!";
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

$conn->close();
?>