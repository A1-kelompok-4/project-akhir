<?php 
  require "koneksi.php";
  session_start();
  $nama = $_SESSION['nama'];
  $id_user;

  $getUserIdQuery = "SELECT id_user FROM user WHERE username = '$nama'";
  $result = mysqli_query($conn, $getUserIdQuery);

  if(mysqli_num_rows($result) == 1) {
    $id_user = mysqli_fetch_assoc($result)["id_user"];
  } else {
    header("location: products.php");
    exit; 
  }

  $result = mysqli_query($conn, $getUserIdQuery);
  
  if (isset($_POST['pesan'])) {
    $id_barang = $_POST["id_barang"];
    $jumlah = $_POST["jumlah_barang"];
    $alamat = $_POST["alamat"];
    $total_bayar = $_POST["total_harga"];

    $getBarangStokQuery = "SELECT stok FROM barang WHERE id_barang = $id_barang";
    $barangResult = mysqli_query($conn, $getBarangStokQuery);
    $stok;
    
    if(mysqli_num_rows($barangResult) == 1) {
      $stok = mysqli_fetch_assoc($barangResult)["stok"];
    } else {
      echo "tidak ada barang denga id = $id_barang ";
      ?>
      <br>
      <br>
      <a href="products.php">Kembali</a>
      <?php
      exit;
    }
    $stok = $stok - $jumlah;
    if ($stok < 0) {
      echo "Stok barang tidak mencukupi!";
      ?>
      <br>
      <br>
      <a href="products.php">Kembali</a>
      <?php
      exit;
    }

    $query = "INSERT INTO transaksi (id_user, id_barang, jumlah_barang, alamat, total_bayar) VALUES($id_user, $id_barang, $jumlah, '$alamat', $total_bayar)";

    $result = mysqli_query($conn, $query);
    if (!$result) echo "Gagal memesan barang";

    $updateBarangQuery = "UPDATE barang set stok = $stok WHERE id_barang = $id_barang";
    $updateBarangResult = mysqli_query($conn, $updateBarangQuery);
    if ($updateBarangResult) {
      $_SESSION['msg'] = "Berhasil memesan barang";
      header("Location:products.php");
    } else {
      echo "Gagal memesan barang";
    }
  }  
?>
