<?php
session_start();
include "../../koneksi.php"; // Pastikan ini adalah jalur yang benar ke file koneksi Anda

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil ID transaksi dari URL
$id_transaksi = $_GET['id'];

// Ambil tanggal ambil saat ini
$tgl_ambil = date('Y-m-d');

// Update status menjadi 'ambil' dan set tanggal ambil
$sql_update = "UPDATE tb_transaksi SET status = 'ambil', tgl_ambil = '$tgl_ambil' WHERE id_transaksi = '$id_transaksi'";

if ($koneksi->query($sql_update) === TRUE) {
    echo "Status transaksi berhasil diubah menjadi 'ambil' dan tanggal ambil telah diperbarui.";
} else {
    echo "Error: " . $koneksi->error;
}

$koneksi->close();
?>