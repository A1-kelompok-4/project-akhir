<?php
require "koneksi.php";
$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);
session_start();

// if (isset($_POST['pesan'])) {
// 	header("location:index.php");	
// }


?>

<html>

<head>
	<title>Products - Alfa Computer</title>
	<style>
		.pemesanan>form {
			width: 250px;
			display: flex;
			flex-direction: column;
			gap: 4px;
		}
	</style>
</head>

<body>
	<header>
		<h1>Welcome to Alfa Computer!</h1>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="about.php">About Us</a></li>
				<li><a href="https://wa.wizard.id/627b7a">Contact Us</a></li>
				<li><a href="transaksi.php">Riwayat Transaksi</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<h2>Featured Products</h2>
		<input type="text" id="search" placeholder="Search...">
		<button type="submit" id="submit">Search</button>
		<br><br>

		<table border="1" cellpadding="10" cellspacing="0" id="data_table">
			<thead>
				<tr>
					<th>no</th>
					<th>id barang</th>
					<th>nama barang</th>
					<th>Harga <button type="button" id="sortAsc">Termurah</button> <button type="button" id="sortDesc">Termahal</button></th>
					<th>stock</th>
					<th>gambar</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr id="data_table[]">
						<td><?php echo $i ?></td>
						<td><?php echo $row["id_barang"] ?></td>
						<td><?php echo $row["nama_barang"] ?></td>
						<td><?php echo $row["harga"] ?></td>
						<td><?php echo $row["stok"] ?></td>
						<?php
						if ($row["img_path"]) {
							echo "<td><a href=" . $row["img_path"] . " target=" . "_blank" . " rel=" . "noopener noreferrer" . ">Lihat</a></td>";
						} else {
							echo "<td><p>Tidak ada gambar</p></td>";
						}
						?>
					</tr>
					<?php $i++ ?>
				<?php } ?>
			</tbody>
		</table>
		<div class="pemesanan">
			<h2>Pesan Barang : </h2>
			<form action="pesan_product.php" method="POST">
				<label for="id_barang">ID Barang</label>
				<input type="text" name="id_barang" id="id_barang" onchange="getBarangIDFromTable(this.value)">
				<label for="jumlah_barang">Jumlah</label>
				<input type="text" name="jumlah_barang" id="jumlah_barang" onchange="hitungTotalHarga(this.value)">
				<label for="alamat">Alamat</label>
				<input type="text" name="alamat" id="alamat" onchange="toggleSubmitButton()">
				<label for="total_harga">Total Harga</label>
				<input type="text" name="total_harga" id="total_harga" readonly>
				<div>
					<button type="submit" name="pesan" id="pesan" disabled>Pesan</button>
				</div>
			</form>

			<h2>
				<?php
				if (isset($_SESSION['msg'])) {
					echo $_SESSION['msg'];
					$_SESSION["msg"] = "";
				}
				?>
			</h2>
		</div>

	</main>
	<footer>
		<p>&copy; 2023 Alfa Computer</p>
	</footer>

	<script type="text/javascript">
		let data_table = document.getElementById("data_table").tBodies[0].rows;
		let dataBarang = {};

		let id_barangTag = document.getElementById("id_barang");
		let jumlah_barangTag = document.getElementById("jumlah_barang");
		let alamatTag = document.getElementById("alamat");
		let total_harga = document.getElementById("total_harga");
		let button = document.getElementById("pesan");

		function toggleSubmitButton() {
			if (!id_barangTag.value || !jumlah_barangTag.value || !alamatTag.value || !total_harga.value) {
				document.getElementById("pesan").disabled = true;
			} else {
				button.disabled = false;
			}
		}

		function getBarangIDFromTable(idBarangInput) {
			for (let i = 0; i < data_table.length; i++) {
				let id_barang = data_table[i].getElementsByTagName("td")[1].innerHTML;
				if (id_barang == idBarangInput) {
					let hargaBarang = parseFloat(data_table[i].getElementsByTagName("td")[3].innerHTML);
					dataBarang.id_barang = parseInt(idBarangInput);
					dataBarang.harga_barang = hargaBarang;
					toggleSubmitButton()
					hitungTotalHarga(jumlah_barangTag.value)
					return
				}
			}
		}

		function hitungTotalHarga(jumlahBarang) {
			total_harga.value = parseInt(jumlahBarang) * dataBarang.harga_barang;
			toggleSubmitButton()
		}
	</script>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="JS/products.js"></script>