<?php 
require "koneksi.php";
$id_barang = $_GET["id_barang"];
$query = "SELECT * FROM barang WHERE id_barang ='$id_barang'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
} else {
  header("location: index.php");
  exit; 
}

function ubah($data) {
  global $conn;
  $id_barang = $_POST["id_barang"];
  $nama_barang = $_POST["nama_barang"];
  $harga = $_POST["harga"];
  $stok = $_POST["stok"];

  $query = "UPDATE barang SET nama_barang = '$nama_barang', harga  = '$harga', stok = '$stok' WHERE id_barang = '$id_barang'";
  mysqli_query($conn,$query);
  return mysqli_affected_rows($conn);
}

if(isset($_POST["update"])) {
  if(ubah($_POST) > 0) {
    echo "<script>alert('berhasil mengubah data'); document.location.href = 'karyawan.php';</script>";
  } else {
    // echo "<script>alert('gagal mengubah data'); document.location.href = 'index.php';</script>";
  }
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Halaman Update</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/navbar.css">
</head>
<body>
<header>
  <nav>
        <div class="container nav-wrapper">
            <div class="brand">
                <img src="img/logo.png" alt="" style="width: 100px;">
                <span><strong>ALFA COMPUTER</strong></span>
            </div>
            <ul class="nav-list nav-right" style="display: flex; justify-content: flex-end;">
 
        <a class="nav-link" href="karyawan.php">
            <button class="btn">Home</button>
        </a>
    </li>

        <a class="nav-link" href="logout.php">
            <button class="btn">Logout</button>
        </a>
    </li>
</ul>
        </div>
    </nav>
    <header>
        <br><br>
  <div class="container">
    <div class="row">
    <div class="col-md-6 mx-auto border p-4">
  <h1 class="text-center mb-4">Halaman Update</h1>
  <form method="post" enctype="multipart/form-data">
  <div class="form-group">
  <label for="id_barang">Id barang:</label>
    <input type="hid_barangden" class="form-control" name="id_barang" id="id_barang" value="<?php echo $row['id_barang']?>">
</div>
    <div class="form-group">
      <label for="nama_barang">Nama barang:</label>
      <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?php echo $row['nama_barang']?>">
    </div>
    <div class="form-group">
      <label for="harga">Harga:</label>
      <input type="text" class="form-control" name="harga" id="harga" value="<?php echo $row['harga']?>">
    </div>
    <div class="form-group">
      <label for="stok">Stok:</label>
      <input type="text" class="form-control" name="stok" id="stok" value="<?php echo $row['stok']?>">
    </div>
    <button type="submit" class="btn btn-primary" name="update">Update</button>
  </form>
</div>

    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-Hrv0zp3bAV9zjhpV7VPJyGv/wq3pW8BSzoBh7n0JlFvV2HNuj8cMjhssJ  eSRYU6Y" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
    integrity="sha384-5P5sf5dT5w5G5q3a3l/xpWPpfY+w9zVFsIKeNVjAxMhAXE1+1HOwVpBebj+
    XyJGQ" crossorigin="anonymous"></script>
</body>
</html>
<?php
include "footer.php";
?>