<?php
session_start();
include "../../koneksi.php"; // Pastikan ini adalah jalur yang benar ke file koneksi Anda

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}


// Ambil data dari formulir
$nopol = $_POST['id_transaksi'];
$kondisi_mobil = $_POST['kondisi_mobil'];
$total = $_POST['total'];
$tgl_kembali = date('Y-m-d'); // Mengambil tanggal saat ini

// Ambil id_transaksi berdasarkan nopol
$sql_transaksi = "SELECT * FROM tb_transaksi WHERE id_transaksi = '$nopol'";
$result_transaksi = $koneksi->query($sql_transaksi);

if ($result_transaksi->num_rows > 0) {
    $row_transaksi = $result_transaksi->fetch_assoc();
    $id_transaksi = $row_transaksi['id_transaksi'];

    // Insert data ke tabel tb_kembali
    $sql_insert = "INSERT INTO tb_kembali (id_transaksi, tgl_kembali, kondisi_mobil, denda) VALUES ('$id_transaksi', '$tgl_kembali', '$kondisi_mobil', '$total')";

    if ($koneksi->query($sql_insert) === TRUE) {
        // Update status di tabel tb_transaksi menjadi 'kembali'
        $sql_update = "UPDATE tb_transaksi SET status = 'kembali' WHERE id_transaksi = '$id_transaksi'";
        
        if ($koneksi->query($sql_update) === TRUE) {
            echo "Pengembalian mobil berhasil. Status transaksi telah diperbarui.";
        } else {
            echo "Error saat memperbarui status transaksi: " . $koneksi->error;
        }
    } else {
        echo "Error saat menyimpan data pengembalian: " . $koneksi->error;
    }
} else {
    echo "Tidak ada transaksi yang ditemukan untuk nomor polisi tersebut.";
}

$koneksi->close();
?>