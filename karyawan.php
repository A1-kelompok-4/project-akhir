<?php

require "koneksi.php";
$query ="SELECT * FROM barang";
$result =mysqli_query($conn, $query);
?>

<html>
<title>Karyawan - Alfa Computer</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="CSS/navbar.css">
<link rel="stylesheet" href="CSS/style.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xxxxxx" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css" integrity="sha512-xxxxxx" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.bundle.min.js" integrity="sha512-xxxxxx" crossorigin="anonymous"></script>

<style>
  
    .dataTables_filter {
    text-align: right;
    margin-bottom: 10px;
    }
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
            <ul class="nav-list nav-right" style="display: flex; justify-content: flex-end;">
    <li>
        <a class="nav-link" href="transaksi_karyawan.php">
            <button class="btn">Update Transaksi</button>
        </a>
    </li>
    <li>
        <a class="nav-link" href="logout.php">
            <button class="btn">Logout</button>
        </a>
    </li>
</ul>
        </div>
    </nav>
    </header>
    <section>
        <h1>CRUD ALFA COMPUTER</h1>
    <div class="d-flex justify-content-between align-items-center">
        <h2></h2>
        <a href="tambah.php" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a>
    </div>
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
    <a href="hapus.php?id_barang=<?php echo $row['id_barang'] ?>">
        <span class="badge bg-danger"><i class="bi bi-trash"></i> Hapus</span>
    </a>
    <a href="update.php?id_barang=<?php echo $row['id_barang'] ?>">
        <span class="badge bg-warning text-dark"><i class="bi bi-pencil-square"></i> Update</span>
    </a>
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
        searching: true,
    });
});
</script>

<?php
include "footer.php";
?>