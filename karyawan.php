<?php

require "koneksi.php";
$query ="SELECT * FROM barang";
$result =mysqli_query($conn, $query);
?>

<html>
    <body>
    <header>
        <nav>
            <div class="wrapper">
                <div class="logo"><a href="">toko komputer</a></div>
                <div class="menu">
                    <ul>
                        <!-- <li><a href="#home">home</a></li>
                        <li><a href="about.php">about</a></li>
                        <li><a href="barang.php">barang</a></li> -->
                        <!-- <li><a href="partners.html">partners</a></li> -->
                        <li><a href="logout.php"> Log Out </a></li>
                        <li><a href="transaksi.php">Lihat Seluruh Transaksi</a></li>
                    </ul>
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
                <td>
                    <?php if ($row["img_path"]) { ?>
                    <a href="<?php echo $row["img_path"] ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo $row["img_path"] ?>" alt="<?php echo $row["nama_barang"] ?>" width="50">
                    </a>
                    <?php } else { ?>
                    <p>Tidak ada gambar</p>
                    <?php } ?>
                </td>

                <td>
                    <a href="hapus.php?id_barang=<?php echo $row['id_barang'] ?>">hapus</a>
                    <a href="update.php?id_barang=<?php echo $row['id_barang'] ?>">update </a>
                </td>
            </tr>
            <?php $i++?>
            <?php }?>
        </table>
    </body>
</html>