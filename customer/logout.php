<?php
session_start();
//session_destroy();
unset($_SESSION['email']);
unset($_SESSION['pass']);
unset($_SESSION['nama']);
unset($_SESSION['nomor']);
header("location: ../");
?>