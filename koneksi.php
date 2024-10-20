<?php
  $koneksi=mysqli_connect('localhost', 'root', '', 'rental_mobil');

  if(mysqli_connect_errno()) {
    printf("Connect failed: $s\n", mysqli_connect_error());
    exit();
  }
?>