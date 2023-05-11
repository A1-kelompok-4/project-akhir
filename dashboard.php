<?php
//inisialisasi session
session_start();

//mengecek username pada session
if( !isset($_SESSION['nama']) ){
  echo "<script>alert('Anda harus login untuk mengakses halaman ini');window.location.href='login.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Dashboard - Alfa Computer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="CSS/style.css">
  <style>
    section {
      padding: 20px;
      text-align: center;
      margin-bottom: 80px; /* tambahkan margin-bottom agar tidak menimpa footer */
      }
    /* bulat bulat geser */
    .swiper-container {
      width: 100%;
      height: 410px;
      
    }

    .swiper-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: #fff;
      font-size: 20px;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 10;
    }

    .swiper-button-next {
      right: 10px;
    }

    .swiper-button-prev {
      left: 10px;
    }

    .swiper-pagination {
      position: absolute;
      bottom: 10px;
    }
  </style>
  </head>
<body>
  <header>
  <?php
include "navbar.php";
?>
  </header>

    <br>
    <br>
  <div>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="IMG/sale3.png" alt="Gambar 1"></div>
      <div class="swiper-slide"><img src="IMG/sale1.png" alt="Gambar 2"></div>
      <div class="swiper-slide"><img src="IMG/sale2.png" alt="Gambar 3"></div>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  <section>
    <br><br>
    <h4 class="text-center" style="font-weight: bold; color: #fffff; text-shadow: 2px 2px #CCCCCC;">Alfa Computer</h4>
		<p>Kami menyediakan berbagai macam produk komputer dengan harga terbaik</p>
        <p>Alfa Komputer menghadirkan produk-produk Elektronik Komputer berkualitas dari brand-brand ternama seperti Notebook, Desktop PC, Komponen PC Rakitan, Sparepart, Printer, UPS, Gadget, Smartphone dan ratusan jenis produk aksesoris elektronik komputer. Dengan mengedepankan kualitas produk, kualitas layanan penjualan serta after-sales service. 
        Alfa Komputer senantiasa berusaha untuk terus maksimal melayani kebutuhan anda dalam mendapatkan produk elektronik komputer yang anda butuhkan. Didukung oleh staff-staff profesional yang telah berpengalaman dalam memberikan rekomendasi produk serta spesifikasi yang sesuai dengan kebutuhan dan budget anda.</p>
	</section>
</body>
</html>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper('.swiper-container', {
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
<?php
include "footer.php";
?>