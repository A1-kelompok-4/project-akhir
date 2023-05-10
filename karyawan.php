<?php

require "koneksi.php";
$query ="SELECT * FROM barang";
$result =mysqli_query($conn, $query);
?>

<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="CSS/navbar.css">
<link rel="stylesheet" href="CSS/style.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<style>
    footer div.container {
    width: 25%;
    padding: 10px 10px 5px 5px;
    background-color: rgb(72, 97, 120);
    color: rgb(20, 16, 65);
    border-radius: 16px;
} 
section {
        padding: 20px;
        text-align: center;
        margin-bottom: 80px; /* tambahkan margin-bottom agar tidak menimpa footer */
        }
        
</style>
<body class="mobile">
    <nav>
        <div class="container nav-wrapper">
            <div class="brand">
                <img src="img/logo.png" alt="" style="width: 100px;">
                <span><strong>ALFA COMPUTER</strong></span>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
                    <ul>
                    <a class="nav-link" href="logout.php"><button class="btn">Logout</button></a>
                </li>
            </ul>
        </div>
    </nav>
    </header>
    <section>
        <h1>CRUD ADMIN</h1>
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>no</th>
                <th>id_barang barang</th>
                <th>nama barang</th>
                <th>harga</th>
                <th>stock</th>
                <th>gambar</th>
                <th>edit</th>
            </tr>
          </thead>
          <tbody>
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
                    <a href="tambah.php">tambah</a>

                </td>
            </tr>
            <?php $i++?>
            <?php }?>
            <tbody>
        </table>
        <script src="JS/navbar.js"></script>
        </section>
   </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#example').DataTable({
        paging: false,
        ordering: false,
        info: false,
        searching: false,
    });
});
</script>

<?php
include "footer.php";
?>