<!DOCTYPE html>
<html>
<head>
  <title>Pesan Barang</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6"></script>
  <style>
    .swal2-popup-center {
  align-items: center;
  display: flex;
  justify-content: center;
}

  </style>
</head>
<body>
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
  
    if (mysqli_num_rows($barangResult) == 1) {
      $stok = mysqli_fetch_assoc($barangResult)["stok"];
    } else {
      ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Tidak ada barang dengan id = <?php echo $id_barang ?>',
          confirmButtonText: 'Ok'
        }).then(() => {
          window.location.href = 'products.php';
        });
      </script>
      <?php
      exit;
    }
  
    $stok = $stok - $jumlah;
    if ($stok < 0) {
      ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Stok barang tidak mencukupi!',
          confirmButtonText: 'Ok'
        }).then(() => {
          window.location.href = 'products.php';
        });
      </script>
      <?php
      exit;
    }
  
    $query = "INSERT INTO transaksi (id_user, id_barang, jumlah_barang, alamat, total_bayar) VALUES($id_user, $id_barang, $jumlah, '$alamat', $total_bayar)";
  
    $result = mysqli_query($conn, $query);
    if (!$result) {
      ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Gagal memesan barang',
          confirmButtonText: 'Ok'
        }).then(() => {
          window.location.href = 'products.php';
        });
      </script>
      <?php
      exit;
    }
  
    ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil memesan barang',
        showConfirmButton: false,
        timer: 1500
      }).then(() => {
        window.location.href = 'products.php';
      });
    </script>
    <?php  
    

    $updateBarangQuery = "UPDATE barang set stok = $stok WHERE id_barang = $id_barang";
    $updateBarangResult = mysqli_query($conn, $updateBarangQuery);
    
    if ($updateBarangResult) {
<<<<<<< HEAD
      $_SESSION['msg'] = "Berhasil memesan barang";
      echo '<script>alert("Berhasil memesan barang"); window.history.back();</script>';
=======
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1"></script>
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 2500,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
    
        Toast.fire({
          icon: 'success',
          title: 'Barang berhasil dipesan, <br> lihat pada menu transaksi untuk detailnya!'
        }).then(() => {
          window.location.href = 'products.php';
        });
      </script>
      <?php
      exit;
>>>>>>> 6e5c5b7829783a09a1d2577df30af1bf11b38667
    } else {
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1"></script>
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'center',
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
    
        Toast.fire({
          icon: 'error',
          title: 'Gagal memesan barang'
        }).then(() => {
          window.location.href = 'products.php';
        });
      </script>
      <?php
      exit;
    }    
     } ?>
      </body>
</html>