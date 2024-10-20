<?php
// Include FPDF library
require('fpdf.php');

// Database connection
include "../../koneksi.php";

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Query to fetch data
$sql = "SELECT p.PeminjamanID, u.UserID, b.Judul, b.Kategori, p.TanggalPinjam, p.TanggalKembali, p.status 
        FROM peminjaman p 
        JOIN buku b ON p.BukuID = b.BukuID 
        JOIN user u ON p.UserID = u.UserID";

// Execute query
$result = $koneksi->query($sql);

// Create PDF
$pdf = new FPDF('L', 'mm', 'A4'); // Ubah menjadi landscape
$pdf->AddPage();
$pdf->SetFont("Arial", "", 12);

// Add report title
$pdf->Cell(0, 10, "Laporan Peminjaman Buku", 0, 1, 'C');

// Add table header
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(30, 10, "ID Peminjaman", 1, 0, 'C');
$pdf->Cell(30, 10, "ID User", 1, 0, 'C');
$pdf->Cell(40, 10, "Judul Buku", 1, 0, 'C');
$pdf->Cell(30, 10, "Kategori", 1, 0, 'C');
$pdf->Cell(30, 10, "Tanggal Pinjam", 1, 0, 'C');
$pdf->Cell(30, 10, "Tanggal Kembali", 1, 0, 'C');
$pdf->Cell(30, 10, "Status", 1, 1, 'C');

// Add table data
$pdf->SetFont("Arial", "", 12);
if ($result && $result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row["PeminjamanID"], 1, 0, 'C');
        $pdf->Cell(30, 10, $row["UserID"], 1, 0, 'C');
        $pdf->Cell(40, 10, $row["Judul"], 1, 0, 'C');
        $pdf->Cell(30, 10, $row["Kategori"], 1, 0, 'C');
        $pdf->Cell(30, 10, $row["TanggalPinjam"], 1, 0, 'C');
        $pdf->Cell(30, 10, $row["TanggalKembali"], 1, 0, 'C');
        $status = $row["status"];
        if ($status == "dipinjam") {
            $pdf->Cell(30, 10, "Dipinjam", 1, 1, 'C');
        } elseif ($status == "telah dikembalikan") {
            $pdf->Cell(30, 10, "Dikembalikan", 1, 1, 'C');
        } else {
            $pdf->Cell(30, 10, "Tidak diketahui", 1, 1, 'C');
        }
    }
} else {
    $pdf->Cell(0, 10, "Tidak ada data", 1, 1, 'C');
}

// Close database connection
$koneksi->close();

// Output PDF
$pdf->Output("laporan_peminjaman_buku.pdf", "D");
?>