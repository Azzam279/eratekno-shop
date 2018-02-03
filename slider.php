<div id="myCarousel" class="carousel slide" data-ride="carousel">
<?php
include_once("koneksi.php");
?>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    
    <?php
    $sql_1 = mysqli_query($conn,"SELECT * FROM slider WHERE nmr_gambar = '1'");
    $no1   = mysqli_fetch_array($sql_1);
    ?>
    <div class="item active">
      <div class="slider-img"><center><img src="image/carousel/1.jpg"></center></div>
    </div><!-- End Item -->
    
    <?php
    $sql_2 = mysqli_query($conn,"SELECT * FROM slider WHERE nmr_gambar = '2'");
    $no2   = mysqli_fetch_array($sql_2);
    ?>
     <div class="item">
      <div class="slider-img"><center><img src="image/carousel/2.jpg"></center></div>
    </div><!-- End Item -->
    
    <?php
    $sql_3 = mysqli_query($conn,"SELECT * FROM slider WHERE nmr_gambar = '3'");
    $no3   = mysqli_fetch_array($sql_3);
    ?>
    <div class="item">
      <div class="slider-img"><center><img src="image/carousel/3.jpg"></center></div>
    </div><!-- End Item -->
    
    <?php
    $sql_4 = mysqli_query($conn,"SELECT * FROM slider WHERE nmr_gambar = '4'");
    $no4   = mysqli_fetch_array($sql_4);
    ?>
    <div class="item">
      <div class="slider-img"><center><img src="image/carousel/4.jpg"></center></div>
    </div><!-- End Item -->
    
    <?php
    $sql_5 = mysqli_query($conn,"SELECT * FROM slider WHERE nmr_gambar = '5'");
    $no5   = mysqli_fetch_array($sql_5);
    ?>
    <div class="item">
      <div class="slider-img"><center><img src="image/carousel/5.jpg"></center></div>
    </div><!-- End Item -->
            
  </div><!-- End Carousel Inner -->


    <ul class="nav nav-pills nav-justified nav1">
      <li data-target="#myCarousel" data-slide-to="0" class="active"><a href="#"><small><?php echo $no1['keterangan']; ?></small></a></li>
      <li data-target="#myCarousel" data-slide-to="1"><a href="#"><small><?php echo $no2['keterangan']; ?></small></a></li>
      <li data-target="#myCarousel" data-slide-to="2"><a href="#"><small><?php echo $no3['keterangan']; ?></small></a></li>
      <li data-target="#myCarousel" data-slide-to="3"><a href="#"><small><?php echo $no4['keterangan']; ?></small></a></li>
      <li data-target="#myCarousel" data-slide-to="4"><a href="#"><small><?php echo $no5['keterangan']; ?></small></a></li>
    </ul>


</div><!-- End Carousel -->


<!-- Iklan -->
<?php
$image1 = rand(1,4);
$image2 = rand(5,8);
$image3 = rand(9,11);
?>
<div style="float:right;width:30%;border-left:dotted 1px grey;">
  <div class="iklan-banner">
    <img src="image/iklan/side-iklan/<?php echo $image1;?>.jpg" style="width:100%;height:160px;border-bottom:dotted 1px grey;">
  </div>
  <div class="iklan-banner">
    <img src="image/iklan/side-iklan/<?php echo $image2;?>.jpg" style="width:100%;height:160px;border-bottom:dotted 1px grey;">
  </div>
  <div class="iklan-banner">
    <img src="image/iklan/side-iklan/<?php echo $image3;?>.jpg" style="width:100%;height:160px;">
  </div>
</div>