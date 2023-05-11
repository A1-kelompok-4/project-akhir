<?php
session_start();
  require "koneksi.php";
  $id_transaksi = $_GET["id_transaksi"];
  
  $updateTransaksiQuery = "UPDATE transaksi SET status='Telah Dikirim' WHERE id_transaksi=$id_transaksi";
  $result = mysqli_query($conn, $updateTransaksiQuery);
  echo mysqli_affected_rows($conn);

  if (mysqli_affected_rows($conn) > 0) {
    $_SESSION["msg"] = "Berhasil mengupdate data transaksi!";
  } else {
    $_SESSION["msg"] = "Gagal mengupdate data transaksi!";
  }

  header("Location:transaksi_karyawan.php");
?>
