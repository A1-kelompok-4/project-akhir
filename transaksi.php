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
  <title>Products - Alfa Computer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <style>
	 footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #f5f5f5;
        padding: 10px;
      }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Alfa Computer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="products.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://wa.wizard.id/627b7a">Contact Us</a>
          </ul>
        </div>
      </div>
    </nav>
  </header>
	<div class="wrapper">
		<section id="home">
			<br>
			<h2 style="text-align: center;">Riwayat Transaksi <?php if ($user['hak_akses'] == 'user') echo "User"; ?></h2>
			<br>
			<h3>
				<?php
				if (isset($_SESSION['msg'])) {
					echo $_SESSION['msg'];
					$_SESSION["msg"] = "";
				}
				?>
			</h3>
			<div class="container">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
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
        </thead>
        <tbody>
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
                        echo "<td></td>";
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
                            <?php
                            if ($row["status"] != "Sudah dikirim") {
                            ?>
                                <a href="kirim_barang.php?id_transaksi=<?php echo $row["id_transaksi"] ?>">Kirim Barang</a>
                            <?php
                            }
                            ?>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>

		</section>
	</div>
	<footer class="bg-light py-3">
    <div class="container">
      <p style="text-align: center;">&copy; 2023 Alfa Computer</p>
</div>
  </footer>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
<!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->

</html>