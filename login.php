<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah sesssion nama tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if (isset($_SESSION['nama'])) {
  header('Location: index.php');
}

//mengecek apakah form disubmit atau tidak
if (isset($_POST['submit'])) {
  // menghilangkan backslashes
  $nama = stripslashes($_POST['nama']);
  //cara sederhana mengamankan dari sql injection
  $nama = mysqli_real_escape_string($conn, $nama);
  // menghilangkan backslashes
  $password = stripslashes($_POST['password']);
  //cara sederhana mengamankan dari sql injection
  $password = mysqli_real_escape_string($conn, $password);

  //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
  if (!empty(trim($nama)) && !empty(trim($password))) {
    //select data berdasarkan nama dari database
    $query  = "SELECT * FROM user WHERE username = '$nama'";
    $result = mysqli_query($conn, $query);
    $rows   = mysqli_num_rows($result);

    //jika nama dan password lebih besar dari 0 maka user ditemukan
    if ($rows > 0) {
      $data = mysqli_fetch_assoc($result);

      // cek jika user login sebagai admin
      if ($data['hak_akses'] == "admin") {
        // buat session login dan nama
        $_SESSION['nama'] = $nama;
        $_SESSION['hak_akses']    = "admin";
        // alihkan ke halaman dashboard admin
        header("location:admin.php");
        exit();
        // cek jika user login sebagai karyawan
      } elseif ($data['hak_akses'] == "karyawan") {
        // buat session login dan nama
        $_SESSION['nama'] = $nama;
        $_SESSION['hak_akses']    = "karyawan";
        // alihkan ke halaman dashboard karyawan
        header("location:karyawan.php");
        exit();
        // cek jika user login sebagai pengurus
      } elseif ($data['hak_akses'] == "user") {
        // buat session login dan nama
        $_SESSION['nama'] = $nama;
        $_SESSION['hak_akses'] = "user";
        // alihkan ke halaman dashboard pengurus
        header("location:index.php");
        exit();
      } else {
        // alihkan ke halaman login kembali
        header("location:index.php?pesan=gagal");
      }
    } else {
      header("location:index.php?pesan=gagal");
    }
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- meta tags
<meta charset="utf-8">
<meta name="viewport" conn$conntent="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- costum css -->
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
  <section class="conn$conntainer-fluid mb-4">
    <!-- justify-conn$conntent-center untuk mengatur posisi form agar berada di tengah-tengah -->
    <section class="row justify-conn$conntent-center">
      <section class="col-12 col-sm-6 col-md-4">
        <form class="form-conn$conntainer" action="login.php" method="POST">
          <h4 class="text-center font-weight-bold"> Sign-In </h4>
          <?php if ($error != '') { ?>
            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
          <?php } ?>

          <div class="form-group">
            <label for="nama">nama</label>
            <input type="text" class="form-conn$conntrol" id="nama" name="nama" placeholder="Masukkan nama">
          </div>
          <div class="form-group">
            <label for="InputPassword">Password</label>
            <input type="password" class="form-conn$conntrol" id="InputPassword" name="password" placeholder="Password">
            <?php if ($validate != '') { ?>
              <p class="text-danger"><?= $validate; ?></p>
            <?php } ?>
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-block" value="LOGIN">Sign In</button>
          <div class="form-footer mt-2">
            <p> Belum punya account? <a href="register.php">Register</a></p>
          </div>
        </form>
      </section>
    </section>
  </section>

  <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>