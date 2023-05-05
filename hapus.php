<?php

require "koneksi.php";
$id_barang = $_GET["id_barang"];
if ($id_barang){
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($conn,$query);

    echo "<script>
            alert('berhasil menghapus data');
            document.location.href ='karyawan.php';
          </script>";
}
?>