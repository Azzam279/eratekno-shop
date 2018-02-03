<?php
   $host = "http://".$_SERVER['HTTP_HOST'];
   if ($_FILES['upload_foto']['type'] != "image/jpeg") {
      echo "<script>alert('Format gambar harus JPG/JGEP'); window.location = '$host';</script>";
   }else if ($_FILES['upload_foto']['size'] > 200000){
      echo "<script>alert('Size gambar terlalu besar!'); window.location = '$host';</script>";
   }else{
      //nama gambar/file
      $gb_name = $_FILES['upload_foto']["name"];

      //Simpan gambar dalam ukuran sebenarnya
      move_uploaded_file($_FILES['upload_foto']["tmp_name"], "photo/".$_POST['nmr_foto'].".jpg");
      $foto = $_POST['nmr_foto'].".jpg";

      //update nama photo di table customer
      include_once("../koneksi.php");
      mysqli_query($conn, "UPDATE customer SET photo = '$foto' WHERE nmr_customer = '".$_POST['nmr_foto']."'");

      //arahkan ke direktori customer
      header("location: http://".$_SERVER['HTTP_HOST']."/customer/");
   }
?>