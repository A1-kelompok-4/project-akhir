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
<html>
  <body>
    <h1>Halaman Update</h1>
    <form action="" method="post">
      <input type="hid_barangden" name="id_barang" value="<?php echo $row['id_barang']?>">
      nama_barang:
      <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']?>">
      <br>
      harga:
      <input type="text" name="harga" value="<?php echo $row['harga']?>">
      <br>
      stok:
      <input type="text" name="stok" value="<?php echo $row['stok']?>">
      <br>
      <button type="submit" name="update">Update</button>
    </form>
  </body>
</html>
<?php
include "footer.php";
?>