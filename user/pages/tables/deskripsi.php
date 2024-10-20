<?php
// Koneksi ke database
include "../../koneksi.php";
// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil BukuID dari URL
$BukuID = $_GET["BukuID"];

// Query untuk mendapatkan data buku
$sql = "SELECT * FROM buku WHERE BukuID = '$BukuID'";

$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo $row["img"]; ?>" alt="Gambar Buku" style="width:200px;height:200px;">
                </div>
                <div class="col-md-8">
                    <h1><?php echo $row["Judul"]; ?></h1>
                    <h6>by <?php echo $row["Penulis"]; ?></h6>
                    <p>
                        <strong>Penerbit:</strong> <?php echo $row["Penerbit"]; ?><br>
                        <strong>Kategori:</strong> <?php echo $row["Kategori"]; ?><br>
                        <strong>Tahun Terbit:</strong> <?php echo $row["TahunTerbit"]; ?><br>
                    </p>
                    <p><?php echo $row["deskripsi"]; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Ulasan Buku</h2>
                    <?php
                    // Query untuk mendapatkan ulasan buku
                    $sql_ulasan = "SELECT * FROM ulasanbuku WHERE BukuID = '$BukuID'";
                    $result_ulasan = $koneksi->query($sql_ulasan);
                    if ($result_ulasan->num_rows > 0) {
                        // Output data dari setiap baris
                        while($row_ulasan = $result_ulasan->fetch_assoc()) {
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row_ulasan["Ulasan"]; ?></h5>
                                    <p class="card-text">Rating: 
                                    <?php
                                    $rating = $row_ulasan["Rating"];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '&#9733;';
                                        } else {
                                            echo '&#9734;';
                                        }
                                    }
                                    ?>/5
                                </p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Tidak ada ulasan";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "Tidak ada data";
}
$koneksi->close();
?>