<?php
require "koneksi.php";
session_start();
$target_dir = "img/";
$error = "";

function stripFileName($file)
{
    $name = explode(" ", $file);
    $filename = "";
    foreach ($name as $key => $value) {
        $filename .= $value;
    }

    return $filename;
}

if (isset($_POST['profil'])) {
    // Mendapatkan data yang dikirimkan dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $alamat = $_POST['alamat'];
    // Ambil id_user dari session atau dari form jika menggunakan login
    $id_user = $_SESSION['id_user'] ?? $_POST['id_user'];
    
    // Cek apakah profil user sudah ada atau belum
    $query = "SELECT * FROM profil WHERE id_user = '$id_user'";
    $result = mysqli_query($conn, $query);
    $profil = mysqli_fetch_assoc($result);
    
    if ($profil) {
        // Jika profil user sudah ada, maka lakukan update data profil
        $query = "UPDATE profil SET nama_lengkap = ?, email = ?, nomor_hp = ?, alamat = ? WHERE id_user = ?";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssi", $nama_lengkap, $email, $nomor_hp, $alamat, $id_user);
            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Data berhasil disimpan!"); window.history.back();</script>';
                exit();
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    } else {
        // Jika profil user belum ada, maka lakukan insert data profil
        $query = "INSERT INTO profil (id_user, nama_lengkap, email, nomor_hp, alamat) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isssi", $id_user, $nama_lengkap, $email, $nomor_hp, $alamat);
            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Data berhasil disimpan!"); window.history.back();</script>';
                exit();
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    }


} else {
    $id_user = $_SESSION["id_user"];
    $query = "SELECT * FROM profil WHERE id_user = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $profil = mysqli_fetch_assoc($result);
}







?>
<html>

<body>
    <h1>Profile </h1>
    
    <?php
    if ($error != "") {
        echo "<h3>" . $error . "</h3>";
    }
    ?>
    <form method="post" enctype="multipart/form-data">

        
<input type="hidden" name="id_profil" value="<?php echo isset($profil['id_profil']) ? $profil['id_profil'] : ''; ?>">
<input type="hidden" name="id_user" value="<?php echo isset($_SESSION['id_user']) ? $_SESSION['id_user'] : ''; ?>">
<label for="nama_lengkap">Nama Lengkap:</label><br>
<input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo isset($profil['nama_lengkap']) ? $profil['nama_lengkap'] : ''; ?>"><br><br>
<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value="<?php echo isset($profil['email']) ? $profil['email'] : ''; ?>"><br><br>
<label for="nomor_hp">Nomor HP:</label><br>
<input type="text" id="nomor_hp" name="nomor_hp" value="<?php echo isset($profil['nomor_hp']) ? $profil['nomor_hp'] : ''; ?>"><br><br>
<label for="alamat">Alamat:</label><br>
<textarea id="alamat" name="alamat"><?php echo isset($profil['alamat']) ? $profil['alamat'] : ''; ?></textarea><br><br>
<input type="submit" name="profil" value="profil Perubahan">
<p style="color:red"><?php echo isset($error) ? $error : ''; ?></p>

</form>
        
        
</body>
</html>
