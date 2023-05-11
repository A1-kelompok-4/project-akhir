<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah sesssion nama tersedia atau tidak jika tersedia maka akan diredirect ke halaman dashboard
if (isset($_SESSION['nama'])) {
  header('Location: dashboard.php');
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
      echo $rows;

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
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['hak_akses'] = "user";
        // alihkan ke halaman dashboard pengurus
        header("location:dashboard.php");
        exit();
      } else {
        // alihkan ke halaman login kembali
        header("location:dashboard.php?pesan=gagal");
      }
    } else {
       header("location:dashboard.php?pesan=gagal");
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
  <link rel="stylesheet" href="CSS/navbar.css">

  <!-- Custom CSS -->
  <style>
    .form-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px #888;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      border-radius: 5px;
      padding: 10px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }

    .btn-primary {
      background-color: #933ded;
      border: none;
      width: 100%;
      padding: 10px;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #999;
    }

    .form-footer {
      margin-top: 10px;
      font-size: 14px;
    }

    .form-footer a {
      color: #933ded;
      text-decoration: none;
    }

    .form-footer a:hover {
      text-decoration: underline;
    }
  </style>
  <!-- costum css -->
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
<section class="conn$conntainer-fluid mb-4">
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-12 col-sm-6 col-md-4">
      <form class="form-container" action="login.php" method="POST">
          <h4 class="text-center font-weight-bold"> Sign-In </h4>
          <?php if ($error != '') { ?>
            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
          <?php } ?>

          <div class="form-group">
            <label for="nama">Username</label>
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
            <p>Belum punya akun? <a href="register.php">Daftar sekarang!</a></p>
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