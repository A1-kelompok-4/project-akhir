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

<body>
    <h1>tambah data</h1>
    <?php 
        if($error != "") {
            echo "<h3>".$error."</h3>";
        } 
    ?>
    <form method="post" enctype="multipart/form-data">
        Id barang:
        <input type="text" name="id_barang">
        <br>
        Nama barang:
        <input type="text" name="nama_barang">
        <br>
        Harga:
        <input type="text" name="harga">
        <br>
        stok:
        <input type="text" name="stok">
        <br>
        gambar:
        <input type="file" name="gambar">
        <br>
        <button type="submit" name="tambah">tambah</button>
    </form>
</body>

</html>