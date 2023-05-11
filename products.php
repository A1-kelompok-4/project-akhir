<?php
require "koneksi.php";
$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);
session_start();

// if (isset($_POST['pesan'])) {
// 	header("location:index.php");	
// }

//mengecek username pada session
if( !isset($_SESSION['nama']) ){
  echo "<script>alert('Anda harus login untuk mengakses halaman ini');window.location.href='login.php';</script>";
  exit;
}
?>
<html>
<head>
  <title>Products - Alfa Computer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="CSS/style.css" />
  <style>


  </style>
</head>
<body>
  <header>
  <?php
include "navbar.php";
?>
  </header>
  <section>

  <main class="container my-4">
  <h2 class="text-center" style="font-weight: bold; color: #fffff; text-shadow: 2px 2px #CCCCCC;">Featured Products</h2>
    <table class="table table-striped table-hover" id="example" >

      <thead >
        <tr >
          <th>No</th>
          <th>ID Barang</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stock</th>
          <th>Gambar</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $row["id_barang"] ?></td>
              <td><?php echo $row["nama_barang"] ?></td>
              <td><?php echo $row["harga"] ?></td>
              <td><?php echo $row["stok"] ?></td>
              <td>
                <?php if ($row["img_path"]) { ?>
                  <a href="<?php echo $row["img_path"] ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo $row["img_path"] ?>" alt="<?php echo $row["nama_barang"] ?>" width="50">
                  </a>
                <?php } else { ?>
                  <p>Tidak ada gambar</p>
                <?php } ?>
              </td>
            </tr>
            <?php $i++ ?>
        <?php } ?>
      </tbody>
    </table>

    <div class="pemesanan my-4">
      <br>
      <h2 class="text-center" style="font-weight: bold; color: #fffff; text-shadow: 2px 2px #CCCCCC;">Pesan Barang:</h2>
	  <br>
      <form action="pesan_product.php" method="POST">
        <div class="form-group row">
          <label for="id_barang" class="col-sm-2 col-form-label">ID Barang</label>
          <div class="col-sm-10">
            <input type="text" name="id_barang" id="id_barang" onchange="getBarangIDFromTable(this.value)" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="jumlah_barang" class="col-sm-2 col-form-label">Jumlah</label>
          <div class="col-sm-10">
            <input type="text" name="jumlah_barang" id="jumlah_barang" 
onchange="hitungTotalHarga(this.value)" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
            <input type="text" name="alamat" id="alamat" onchange="toggleSubmitButton()" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="total_harga" class="col-sm-2 col-form-label">Total Harga</label>
          <div class="col-sm-10">
            <input type="text" name="total_harga" id="total_harga" readonly class="form-control">
          </div>
</div>
        <div class="form-group row">
          <div class="col-sm-10 offset-sm-2">
			<br>
            <button type="submit" name="pesan" id="pesan" disabled class="btn btn-primary">Pesan</button>
          </div>
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
  <?php
include "footer.php";
?>


  <script type="text/javascript">
		let data_table = document.getElementById("example").tBodies[0].rows;
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
  </section>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<!-- <script src="JS/products.js"></script> -->
<script>
	$(document).ready(function () {
    $('#example').DataTable();
});
</script>