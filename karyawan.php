<?php

require "koneksi.php";
$query ="SELECT * FROM barang";
$result =mysqli_query($conn, $query);
?>

<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<style>
    footer div.container {
    width: 25%;
    padding: 10px 10px 5px 5px;
    background-color: rgb(72, 97, 120);
    color: rgb(20, 16, 65);
    border-radius: 16px;
}
</style>
    <body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Alfa Computer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                  
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-3">
        <li class="nav-item">
            <a class="nav-link" href="karyawan.php">Home</a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto justify-content-end">
  <li class="nav-item">
    <a class="nav-link" href="transaksi.php">
      <img src="https://cdn1.iconfinder.com/data/icons/business-management-and-growth-21/64/1051-128.png" alt="Logo Riwayat Transaksi" style="height: 30px; width: auto;">
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">
      <img src="https://cdn2.iconfinder.com/data/icons/user-interface-line-38/24/Untitled-5-11-128.png" alt="Logo Logout" style="height: 20px; width: auto;">
    </a>
  </li>
</ul>

</div>
</div>


        </div>
      </div>
    </nav>
    </header>
        <h1>halaman utama</h1>
        <a href="tambah.php">tambah</a>
        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>no</th>
                <th>id_barang barang</th>
                <th>nama barang</th>
                <th>harga</th>
                <th>stock</th>
                <th>gambar</th>
                <th>edit</th>
            </tr>
            <?php
            $i =1;
             while($row =mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row["id_barang"]?></td>
                <td><?php echo $row["nama_barang"]?></td>
                <td><?php echo $row["harga"]?></td>
                <td><?php echo $row["stok"]?></td>
                <?php
                  if ($row["img_path"]) {
                      echo "<td><a href=".$row["img_path"]." target="."_blank"." rel="."noopener noreferrer".">Lihat</a></td>";
                    } else {
                      echo "<td><p>Tidak ada gambar</p></td>";
                  }
                ?>

                <td>
                    <a href="hapus.php?id_barang=<?php echo $row['id_barang'] ?>">hapus</a>
                    <a href="update.php?id_barang=<?php echo $row['id_barang'] ?>">update </a>
                </td>
            </tr>
            <?php $i++?>
            <?php }?>
        </table>
        <footer class="bg-light py-3">
            <div class="container">
            <p style="text-align: center;">&copy; 2023 Alfa Computer</p>
        </footer>
    </body>
</html>