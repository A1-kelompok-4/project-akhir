<?php
require "koneksi.php";
$error = '';
$validate = '';

if (isset($_POST['submit'])) {
  // menghilangkan backshlases
  $username   = stripslashes($_POST['username']);
  //cara sederhana mengamankan dari sql injection
  $username   = mysqli_real_escape_string($conn, $username);
  // $nama       = stripslashes($_POST['nama']);
  // $nama       = mysqli_real_escape_string($conn, $nama);
  $password   = stripslashes($_POST['password']);
  $password   = mysqli_real_escape_string($conn, $password);
  //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
  // !empty(trim($nama)) && 
  if (!empty(trim($username)) && !empty(trim($password))) {
    //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali

    //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
    if (cek_nama($username, $conn)) {
      //hashing password sebelum disimpan didatabase
      $pass  = password_hash($password, PASSWORD_DEFAULT);
      //insert data ke database
      $query = "INSERT INTO user (username, password, hak_akses) VALUES ('$username','$password', 'karyawan')";
      $result   = mysqli_query($conn, $query);

      if ($result) {
        header('Location: admin.php');

        //jika gagal maka akan menampilkan pesan error
      } else {
        $error =  'Register User Gagal !!';
      }
    } else {
      $error =  'username sudah terdaftar !!';
    }
  } else {
    $error =  'Data tidak boleh kosong !!';
  }
}

function cek_nama($username, $conn)
{
  $nama = mysqli_real_escape_string($conn, $username);
  $query = "SELECT * FROM user WHERE username = '$nama'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_row($result);
  if ($row > 0) return false;
  return true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin - Alfa Computer</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta nama="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="CSS/navbar.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
      background-color: #007bff;
      border: none;
      width: 100%;
      padding: 10px;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #0069d9;
    }

    .form-footer {
      margin-top: 10px;
      font-size: 14px;
    }

    .form-footer a {
      color: #007bff;
      text-decoration: none;
    }

    .form-footer a:hover {
      text-decoration: underline;
    }
  </style>
  <!-- costum css -->
  <link rel="stylesheet" href="CSS/navbar.css">
  <title>Registrasi Karyawan</title>
</head>

<body>
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
    <br><br>
    <h4 class="text-center font-weight-bold"> Buat Akun Karyawan </h4> <br>
  <section class="container-fluid mb-4">
    <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-4">
        <form class="form-container" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
          
          <?php if ($error != '') : ?>
            <div class="alert alert-danger" role="alert"><?= $error; ?>
              <?php if ($validate) : ?>
                <?= $validate; ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <div class="form-group">
            <label for="nama">Username</label>
            <input type="text" class="form-control" id="nama" name="username" placeholder="Masukkan Username">
          </div>
          <div class="form-group">
            <label for="InputPassword">Password</label>
            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="InputPassword">Re-Password</label>
            <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password">
          </div>
          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Buat">
        </form>
      </section>
    </section>
  </section>
  <script src="JS/navbar.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
<?php
include "footer.php";
?>