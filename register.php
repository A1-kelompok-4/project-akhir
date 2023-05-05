<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta nama="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- costum css -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    //menyertakan file program koneksi.php pada register
    require('koneksi.php');
    //inisialisasi session
    session_start();

    $error = '';
    $validate = '';
    if (isset($_SESSION['nama'])) header('Location: login.php');

    //mengecek apakah data username yang diinpukan user kosong atau tidak
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
                $query = "INSERT INTO user (username, password ) VALUES ('$username','$password')";
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
    <section class="container-fluid mb-4">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h4 class="text-center font-weight-bold"> Sign-Up </h4>
                    <?php if ($error != '') : ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?>
                            <?php if ($validate) : ?>
                                <?= $validate; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="nama">Username</label>
                        <input type="text" class="form-control" id="nama" name="username" placeholder="Masukkan Nama">
                    </div>
                    <!-- <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" aria-describeby="passwordHelp" placeholder="Masukkan password">
                    </div> -->
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Re-Password</label>
                        <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password">
                    </div>
                    <!-- <div class="form-group">
                        <label for="InputAkses">akses</label>
                        <input type="password" class="form-control" id="InputAkses" name="repassword" placeholder="user">
                    </div> -->
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
                    <div class="form-footer mt-2">
                        <p> Sudah punya account? <a href="login.php">Login</a></p>
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