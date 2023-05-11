<?php
require "koneksi.php";
session_start();
$target_dir = "img/";
$error = "";


function stripFileName($file)
{
    $name = explode(" ", $file);
    $filename = "";
    foreach ($name as $key => $value) {
        $filename .= $value;
    }
    
    return $filename;
}

if (isset($_POST["tambah"])) {
    $error = "";
    $target_file = $target_dir . stripFileName(basename($_FILES["gambar"]["name"]));
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $error = "Maaf, harap masukkan gambar!";
    } else {
        $id_barang = $_POST["id_barang"];
        $nama_barang = $_POST["nama_barang"];
        $harga = $_POST["harga"];
        $stok = $_POST["stok"];

        $query = "INSERT INTO barang VALUES
            ('$id_barang','$nama_barang','$harga','$stok', '$target_file')";
        mysqli_query($conn, $query);

        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        echo "<script>  
                alert('berhasil menambahkan data');
                document.location.href ='karyawan.php';
              </script>";
    }
}

?>
<html>
  <head>
    
  <title>Karyawan - Alfa Computer</title>
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
        <div class="col-md-6 mx-auto border p-3">
          <h1 class="text-center mb-4">Tambah Data</h1>
          <?php 
            if($error != "") {
              echo "<div class='alert alert-danger'>".$error."</div>";
            } 
          ?>
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="id_barang">Id barang:</label>
              <input type="text" class="form-control" name="id_barang" id="id_barang">
            </div>
            <div class="form-group">
              <label for="nama_barang">Nama barang:</label>
              <input type="text" class="form-control" name="nama_barang" id="nama_barang">
            </div>
            <div class="form-group">
              <label for="harga">Harga:</label>
              <input type="text" class="form-control" name="harga" id="harga">
            </div>
            <div class="form-group">
              <label for="stok">Stok:</label>
              <input type="text" class="form-control" name="stok" id="stok">
            </div>
            <div class="form-group">
              <label for="gambar">Gambar:</label>
              <input type="file" class="form-control-file" name="gambar" id="gambar">
            </div>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
          </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-Hrv0zp3bAV9zjhpV7VPJyGv/wq3pW8BSzoBh7n0JlFvV2HNuj8cMjhssJjsmmjfc"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-q8i/X+965/DZI0uP7vBT8veRVOlw2wlFjL2+1tCFw8cIAhAftLD5+5WXOJ5FdRT0"
      crossorigin="anonymous"></script>
  </body>
</html>

<?php
include "footer.php";
?>