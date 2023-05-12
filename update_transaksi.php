<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js'></script>
</head>
<body>
  
</body>
</html>
<?php
session_start();
  require "koneksi.php";
  $id_transaksi = $_GET["id_transaksi"];
  
  $updateTransaksiQuery = "UPDATE transaksi SET status='Telah Dikirim' WHERE id_transaksi=$id_transaksi";
  $result = mysqli_query($conn, $updateTransaksiQuery);
  $affectedRows = mysqli_affected_rows($conn);
  
  if ($affectedRows > 0) {
    // $_SESSION["msg"] = "Berhasil mengupdate data transaksi!";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js'></script>";
    echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Update',
        text: 'Berhasil mengupdate data transaksi!',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'transaksi_karyawan.php';
        }
      })
    </script>";
  } else {
  
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js'></script>";
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal mengupdate data transaksi!',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'transaksi_karyawan.php';
        }
      })
    </script>";
  }
  