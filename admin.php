<?php
//inisialisasi session
session_start();
require "koneksi.php";
$getTransaksiDataQuery = "SELECT *, user.username, barang.nama_barang FROM transaksi JOIN user ON user.id_user = transaksi.id_user JOIN barang ON barang.id_barang = transaksi.id_barang";
$result = mysqli_query($conn, $getTransaksiDataQuery);

// //mengecek username pada session
if (!isset($_SESSION['hak_akses']) || (isset($_SESSION['hak_akses']) && $_SESSION['hak_akses'] != "admin")) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="CSS/navbar.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<head>
</head>

<body>
    <header>
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
            <ul class="nav-list nav-center">
                <li class="active">
                    <a class="nav-link" href="admin.php">Home</a>
                </li>
                <li><a class="nav-link" href="buat_akun_karyawan.php">Registrasi Karyawan</a></li>
                <li>
                    </ul>
                    <ul>
                      
                  <a class="nav-link" href="logout.php"><button class="btn">Logout</button></a>
                </li>
            </ul>
        </div>
    </nav>
    </header>
    <div class="wrapper">
        <section id="home">
            <h3>Data Transaksi</h3>
            <table id="example" class="table table-striped" style="width:100%">
            <thead>
            <tr>
					<!-- <th>no</th> -->
					<th>ID Transaksi</th>
					<th>User</th>
					<th>ID Barang</th>
					<th>Nama Barang</th>
					<th>Tanggal Transaksi</th>
					<th>Alamat</th>
					<th>Total Bayar</th>
					<th>Status</th>
				</tr>
        </thead>
        <tbody>
				<?php
				while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row["id_transaksi"] ?></td>
						<td><?php echo $row["username"] ?></td>
						<td><?php echo $row["id_barang"] ?></td>
						<td><?php echo $row["nama_barang"] ?></td>
						<td><?php echo $row["tanggal_transaksi"] ?></td>
						<td><?php echo $row["alamat"] ?></td>
						<td><?php echo $row["total_bayar"] ?></td>
						<td><?php echo $row["status"] ?></td>
					</tr>
				<?php } ?>
        <tbody>
			</table>
      <script src="JS/navbar.js"></script>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
<!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->

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