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
<head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Alfa Computer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                  
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-3">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://wa.wizard.id/627b7a">Contact Us</a>
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
</head>

<body>
    <header>
        <nav>
            <div class="wrapper">
                <div class="logo"><a href="index.php">toko komputer</a></div>
                <div class="menu">
                    <ul>
                        <li><a href="">karyawan</a></li>
                        <!-- <li><a href="about.php">about</a></li>
                        <li><a href="barang.html">partners</a></li> -->
                        <li><a href="transaksi.php"> Lihat Transaksi </a></li>
                        <li><a href="buat_akun_karyawan.php">Buat Akun Karyawan</a></li>
                        <li><a href="logout.php"> Log Out </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <section id="home">
            <img src="https://img.freepik.com/free-vector/technical-support-guys-working-repairing-computer-hardware-software-troubleshooting-fixing-problems-problem-checking-concept_335657-1838.jpg?w=900&t=st=1678149825~exp=1678150425~hmac=8237c48e5021e215476811401238629fbfe3f4973e97612ad148ad061535968a" width=30%>
            <h3>Data Transaksi</h3>
            <table border="1" cellpadding="10" cellspacing="0">
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
			</table>
        </section>
    </div>
    <footer>
        <p>&copy; 2023 Alfa Computer</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
<!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->

</html>
<?php
include "footer.php";
?>