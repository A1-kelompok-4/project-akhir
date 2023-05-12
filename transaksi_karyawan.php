<?php
require "koneksi.php";
//inisialisasi session
session_start();

//mengecek username pada session
if( !isset($_SESSION['nama']) ){
  echo "<script>alert('Anda harus login untuk mengakses halaman ini');window.location.href='login.php';</script>";
  exit;
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
	$getTransaksiDataQuery .= " WHERE transaksi_karyawan.id_user = '" . $user['id'] . "'";
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
  <title>Transaksi - Alfa Computer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xxxxxx" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css" integrity="sha512-xxxxxx" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.bundle.min.js" integrity="sha512-xxxxxx" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="CSS/style.css" />
  <link rel="stylesheet" href="CSS/navbar.css">

  <style>
     .dataTables_filter {
    text-align: right;
    margin-bottom: 10px;
    }
    section {
        padding: 20px;
        text-align: center;
        margin-bottom: 80px; /* tambahkan margin-bottom agar tidak menimpa footer */
        }
        
  </style>

</head>
<body>
  <header>
  <body class="mobile">
    <nav>
        <div class="container nav-wrapper">
            <div class="brand">
                <img src="img/logo.png" alt="" style="width: 100px;">
                <span><strong>ALFA COMPUTER</strong></span>
            </div>
            <ul class="nav-list nav-right" style="display: flex; justify-content: flex-end;">
    <li>
        <a class="nav-link" href="karyawan.php">
            <button class="btn">Home</button>
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
	<div class="wrapper">
		<section id="home">
			<br>
            <h2 class="text-center" style="font-weight: bold; color: #fffff; text-shadow: 2px 2px #CCCCCC;">Riwayat Transaksi <?php if ($user['hak_akses'] == 'user') echo "User"; ?></h2>
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
            <table id="example" class="table table-striped" style="width:100%">
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
                    <td>
                <?php if ($row["img_path"]) { ?>
                  <a href="<?php echo $row["img_path"] ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo $row["img_path"] ?>" alt="<?php echo $row["nama_barang"] ?>" width="50">
                  </a>
                <?php } else { ?>
                  <p>Tidak ada gambar</p>
                <?php } ?>
              </td>
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
                            <a href="update_transaksi.php?id_transaksi=<?php echo $row["id_transaksi"] ?>">
                                <span class="badge bg-warning text-dark"><i class="bi bi-pencil-square"></i> Kirim Barang</span>
                            </a>
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
    <script src="JS/navbar.js"></script>
    <br>
</div>

	
	</div>
	</section>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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