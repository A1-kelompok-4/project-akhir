<?php
require "koneksi.php";
session_start();

if (!isset($_SESSION['nama'])) {
	header("Location:login.php");
}

$username = $_SESSION['nama'];
$getUserQuery = "SELECT id_user, hak_akses FROM user WHERE username = '$username'";
$userResult = mysqli_query($conn, $getUserQuery);
if (mysqli_num_rows($userResult) == 1) {
	$data  = mysqli_fetch_assoc($userResult);
	$user = [
		"id" => $data["id_user"],
		"hak_akses" => $data["hak_akses"],
	];
}

$getTransaksiDataQuery = "SELECT *, user.username, barang.nama_barang, barang.img_path FROM transaksi JOIN user ON user.id_user = transaksi.id_user JOIN barang ON barang.id_barang = transaksi.id_barang";

if ($user['hak_akses'] == "user") {
	$getTransaksiDataQuery .= " WHERE transaksi.id_user = '" . $user['id'] . "'";
}

$transaksiResult = mysqli_query($conn, $getTransaksiDataQuery);

// while($row = mysqli_fetch_assoc($transaksiResult)) {
// 	echo $row["id_transaksi"]."\n";
// 	echo $row["id_user"]."\n";
// 	echo $row["id_barang"]."\n";
// 	echo $row["tanggal_transaksi"]."\n";
// 	echo $row["total_bayar"]."\n";
// 	echo $row["status"]."\n";
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="">

</head>

<body>
	<header>
		<nav>
			<div class="wrapper">
				<div class="logo"><a href="index.php">toko komputer</a></div>
				<div class="menu">
					<ul>
						<li><a href="products.php">Products</a></li>
						<!-- <li><a href="about.php">about</a></li>
                        <li><a href="barang.html">partners</a></li> -->
						<li><a href="logout.php"> Log Out </a></li>
						<!-- <li><a href="">Buat Akun Karyawan</a></li> -->
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<div class="wrapper">
		<section id="home">
			<h2>Riwayat Transaksi <?php if ($user['hak_akses'] == 'user') echo "User"; ?></h2>
			<img src="https://img.freepik.com/free-vector/technical-support-guys-working-repairing-computer-hardware-software-troubleshooting-fixing-problems-problem-checking-concept_335657-1838.jpg?w=900&t=st=1678149825~exp=1678150425~hmac=8237c48e5021e215476811401238629fbfe3f4973e97612ad148ad061535968a" width=30%>
			<h3>
				<?php
				if (isset($_SESSION['msg'])) {
					echo $_SESSION['msg'];
					$_SESSION["msg"] = "";
				}
				?>
			</h3>
			<table border="1" cellpadding="10" cellspacing="0">
				<tr>
					<!-- <th>no</th> -->
					<th>ID Transaksi</th>
					<th>User</th>
					<?php
					if ($user['hak_akses'] != "user") {
						echo "<th>ID Barang</th>";
					}
					?>
					<th>Nama Barang</th>
					<th>Gambar Barang</th>
					<th>Jumlah Barang</th>
					<th>Tanggal Transaksi</th>
					<th>Alamat</th>
					<th>Total Bayar</th>
					<th>Status</th>
					<?php
					if ($user['hak_akses'] == "karyawan") {
					?>
						<th>Action</th>
					<?php
					}
					?>
				</tr>
				<?php
				while ($row = mysqli_fetch_assoc($transaksiResult)) { ?>
					<tr>
						<td><?php echo $row["id_transaksi"] ?></td>
						<td><?php echo $row["username"] ?></td>
						<?php
						if ($user['hak_akses'] != "user") {
						?>
							<td><?php echo $row["id_barang"] ?></td>
						<?php
						}
						?>
						<td><?php echo $row["nama_barang"] ?></td>
						<?php
						if ($row["img_path"]) {
							echo "<td><a href=" . $row["img_path"] . " target=" . "_blank" . " rel=" . "noopener noreferrer" . ">Lihat</a></td>";
						} else {
							echo "<td><p>Tidak ada gambar</p></td>";
						}
						?>
						<td><?php echo $row["jumlah_barang"] ?></td>
						<td><?php echo $row["tanggal_transaksi"] ?></td>
						<td><?php echo $row["alamat"] ?></td>
						<td><?php echo $row["total_bayar"] ?></td>
						<td><?php echo $row["status"] ?></td>
						<?php
						if ($user['hak_akses'] == "karyawan") {
						?>
							<td>
								<form action="update_transaksi.php?id_transaksi=<?php echo $row['id_transaksi'] ?>" method="post">
									<button type="submit" <?php if ($row['status'] == "Telah Dikirim") echo "disabled" ?>>Update Kirim</button>
								</form>
							</td>
						<?php
						}
						?>
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