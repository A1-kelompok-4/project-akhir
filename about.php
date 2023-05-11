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
<html>
<head>
  <title>About Us - Alfa Computer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/style.css" />
  <link rel="stylesheet" href="CSS/navbar.css">
</head>
<body>
  <header>
  <body class="mobile">
  <?php
include "navbar.php";
?>
	</header>
	<div class="container my-5"> 
    <br>   
    <h2 class="text-center" style="font-weight: bold; color: #fffff; text-shadow: 2px 2px #e9e3f0;">About Us</h2>
		<p>Toko Komputer is an online store that sells various computer products, such as laptops, PCs, accessories, and more. We have been in the business for 10 years and have gained a reputation for selling quality and reliable computer products.</p>
		<p>Our commitment is to provide the best service to our customers. We have a reliable team that is ready to help you choose the products that meet your needs. In addition, we also offer affordable prices and attractive discounts for our loyal customers.</p>
		<p>Don't hesitate to contact us if you have any questions or need help choosing a product. We are happy to assist you.</p>
        <h2 class="text-center" style="font-weight: bold; color: #fffff; text-shadow: 2px 2px #e9e3f0;">Visi Misi</h2>
		<ul>
			<li>Visi: To become a trusted and the best online store in selling computer products.</li>
			<li>Misi: To provide the best service to customers and sell quality products at affordable prices.</li>
		</ul>
        <h2 class="text-center" style="font-weight: bold; color: #fffff; text-shadow: 2px 2px #e9e3f0;">Alamat Kami</h2>
<p>Berikut adalah alamat lengkap Alfa Komputer:</p>
<p>Jl. Bhayangkara No.26-18</p>
<p>Kalimantan Timur, Samarinda.</p>
<div style="width: 100%; height: 400px;">
<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=Toko Komputer, Jl. Bhayangkara No.26-18, Bugis, Kec. Samarinda Kota, Kota Samarinda, Kalimantan Timur 75242&t=k&z=12&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://2yu.co">2yu</a><br><style>.mapouter{position:relative;text-align:right;height:100%;width:100%;}</style><a href="https://embedgooglemap.2yu.co/">html embed google map</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:100%;width:100%;}</style></div></div>
</div>
<br>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>
	<script src="JS/navbar.js"></script>
</body>
</html>
<?php
include "footer.php";
?>
