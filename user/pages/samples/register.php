<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<style>
  .hidden{
  display: none;
}
</style>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <strong>
              <h2>Registrasi </h2>
              <h6 class="fw-light">Untuk Masuk ke Web</h6>
            </strong>
              <form class="pt-3" method="POST">
              <div class="form-group">
                  <input type="number" class="form-control form-control-lg"  name="nik" placeholder="NIK">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg"  name="usn" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="pw" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="nama" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                  <select name="jk" class="form-control form-control-lg" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="number" class="form-control form-control-lg" name="telp" placeholder="telp">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="alamat" placeholder="Alamat">
                </div>
              
                <div class="mt-3">
                  <input type="submit"  name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >
                </div>
               
                <div class="mb-2">
                  
                </div>
           
              </form>

              <?php
              if(isset($_POST['submit'])){
                  $nik = $_POST['nik'];
                  $usn = $_POST['usn'];
                  $pw = $_POST['pw'];
                  $jk = $_POST['jk'];
                  $telp = $_POST['telp'];
                  $nama = $_POST['nama'];
                  $alamat = $_POST['alamat'];
                  include "../../../koneksi.php";
                  $sql= "INSERT INTO tb_member VALUES ('$nik','$nama','$jk','$telp','$alamat', '$usn', '$pw')";
                  $insert = mysqli_query($koneksi, $sql)
                  or die(mysqli_error($koneksi));
                  if($insert) {
                  echo "<script>alert('Sukses menambahkan.');
                  location.href='../../../admin/pages/samples/login.php';</script>";
                  } else {
                  echo "<script>alert('Gagal menambahkan.');
                  location.href='register.php';</script>";
                  }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/template.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
  <!-- endinject -->


</body>

</html>