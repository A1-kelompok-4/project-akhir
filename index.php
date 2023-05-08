<?php
//inisialisasi session
session_start();

//mengecek username pada session
if( !isset($_SESSION['nama']) ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Products - Alfa Computer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="CSS/style.css" />
  <style>
	footer {
    position: relative;
    background-color: #f5f5f5;
    padding: 10px;
}

      section {
        padding: 20px;
        text-align: center;
        margin-bottom: 80px; /* tambahkan margin-bottom agar tidak menimpa footer */
        }
         /* Style CSS khusus */
    .swiper-container {
      width: 100%;
      height: 400px;
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Alfa Computer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                  
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-3">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://wa.wizard.id/627b7a">Contact Us</a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto justify-content-end">
  <li class="nav-item">
    <a class="nav-link" href="transaksi.php">
      <img src="https://cdn1.iconfinder.com/data/icons/business-management-and-growth-21/64/1051-128.png" alt="Logo Riwayat Transaksi" style="height: 30px; width: auto;">
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">
      <img src="https://cdn2.iconfinder.com/data/icons/user-interface-line-38/24/Untitled-5-11-128.png" alt="Logo Logout" style="height: 20px; width: auto;">
    </a>
  </li>
</ul>

</div>
</div>


        </div>
      </div>
    </nav>
  </header>
  
  <div class="awal">
    <br>
    <h2 style="padding-left: 2.2em;">Selamat datang di alfa komputer</h2>
    <br>
  <div>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="img/sale3.png" alt="Gambar 1"></div>
      <div class="swiper-slide"><img src="img/sale1.png" alt="Gambar 2"></div>
      <div class="swiper-slide"><img src="img/sale2.png" alt="Gambar 3"></div>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  <div class="awal">
  <section>
    <br>
    <h4>Alfa Komputer</h4>
		<p>Kami menyediakan berbagai macam produk komputer dengan harga terbaik</p>
        <p>Alfa Komputer menghadirkan produk-produk Elektronik Komputer berkualitas dari brand-brand ternama seperti Notebook, Desktop PC, Komponen PC Rakitan, Sparepart, Printer, UPS, Gadget, Smartphone dan ratusan jenis produk aksesoris elektronik komputer. Dengan mengedepankan kualitas produk, kualitas layanan penjualan serta after-sales service. 
        Alfa Komputer senantiasa berusaha untuk terus maksimal melayani kebutuhan anda dalam mendapatkan produk elektronik komputer yang anda butuhkan. Didukung oleh staff-staff profesional yang telah berpengalaman dalam memberikan rekomendasi produk serta spesifikasi yang sesuai dengan kebutuhan dan budget anda.</p>
	</section>
  </div>
  
    <footer class="bg-light py-3">
    <div class="container">
      <p style="text-align: center;">&copy; 2023 Alfa Computer</p>
  </footer>

 <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
 <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
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

