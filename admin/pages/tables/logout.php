<?php
session_start();

// Hapus session
unset($_SESSION['userID']);
unset($_SESSION['username']);
unset($_SESSION['role']);
unset($_SESSION['fullname'] );
      

// Redirect ke halaman login
header('Location: ../samples/login.php');
exit;
?>