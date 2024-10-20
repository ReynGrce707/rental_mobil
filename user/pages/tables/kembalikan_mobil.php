<?php
// Koneksi ke database
include "../../koneksi.php";
// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Ambil ID peminjaman dari URL
$id = $_GET['id'];
// Update status peminjaman menjadi "telah dikembalikan"
$sql = "UPDATE peminjaman SET status = 'telah dikembalikan', TanggalKembali = CURDATE() WHERE PeminjamanID = $id";
if ($koneksi->query($sql) === TRUE) {
    echo "<script>alert('Buku telah dikembalikan!');</script>";
    echo "<script>window.location.href='rating.php?id=" . $id . "';</script>";
} else {
    echo "<script>alert('Gagal mengembalikan buku!');</script>";
    echo "<script>window.location.href='index.php';</script>";
}

$koneksi->close();
?>