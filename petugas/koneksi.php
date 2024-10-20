<?php
  $koneksi=mysqli_connect('localhost', 'root', '', 'perpustakaanonline');

  if(mysqli_connect_errno()) {
    printf("Connect failed: $s\n", mysqli_connect_error());
    exit();
  }
?>