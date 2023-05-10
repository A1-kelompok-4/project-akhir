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

if (isset($_POST['profile'])) {
    $conn = mysqli_connect('localhost','root','','komputer');
    $error = "";
    $target_dir = "uploads/";
    $target_file = $target_dir . stripFileName(basename($_FILES["gambar"]["name"]));
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (empty($_POST['nama_lengkap']) && empty($_POST['email']) && empty($_POST['nomor_hp']) && empty($_POST['alamat']) && empty($_FILES["gambar"]["name"])) {
        $error = "Harap isi minimal satu kolom!";
    } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && !empty($_FILES["gambar"]["name"])) {
        $error = "Maaf, harap masukkan gambar dengan format JPG, JPEG, PNG, atau GIF!";
    } else {
        $id_profil = $_POST['id_profil'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $nomor_hp = $_POST['nomor_hp'];
        $alamat = $_POST['alamat'];
        $foto_profil = empty($_FILES["gambar"]["name"]) ? "" : $target_file;

        // query untuk mengecek apakah profil user sudah ada di database
        $query = "SELECT * FROM profil WHERE id_profil = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_profil);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $profil = mysqli_fetch_assoc($result);

        if ($profil) {
            // jika profil user sudah ada, maka lakukan update data profil
            $query = "UPDATE profil SET nama_lengkap = ?, email = ?, nomor_hp = ?, alamat = ?, foto_profil = ? WHERE id_profil = ?";
            $stmt = mysqli_prepare($conn, $query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssi", $nama_lengkap, $email, $nomor_hp, $alamat, $foto_profil, $id_profil);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Data berhasil diupdate";
                    header("Location: dashboard.php");
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // jika profil user belum ada, maka lakukan insert data profil
            $query = "INSERT INTO profil (nama_lengkap, email, nomor_hp, alamat, foto_profil, id_profil) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssi", $nama_lengkap, $email, $nomor_hp, $alamat, $foto_profil, $id_profil);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Data berhasil disimpan";

                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        

        
        // echo "<script>alert('berhasilllll')</script>"
        header("Location: setting.php");
        exit();
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
    <h1>Profile</h1>
    <?php
    if ($error != "") {
        echo "<h3>" . $error . "</h3>";
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        
<input type="hidden" name="id_profil" value="<?php echo isset($profil['id_profil']) ? $profil['id_profil'] : ''; ?>">
<input type="hidden" name="id_profil" value="<?php echo isset($_SESSION['id_profil']) ? $_SESSION['id_profil'] : ''; ?>">
<label for="nama_lengkap">Nama Lengkap:</label><br>
<input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo isset($profil['nama_lengkap']) ? $profil['nama_lengkap'] : ''; ?>"><br><br>
<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value="<?php echo isset($profil['email']) ? $profil['email'] : ''; ?>"><br><br>
<label for="nomor_hp">Nomor HP:</label><br>
<input type="text" id="nomor_hp" name="nomor_hp" value="<?php echo isset($profil['nomor_hp']) ? $profil['nomor_hp'] : ''; ?>"><br><br>
<label for="alamat">Alamat:</label><br>
<textarea id="alamat" name="alamat"><?php echo isset($profil['alamat']) ? $profil['alamat'] : ''; ?></textarea><br><br>
<label for="gambar">Foto Profil:</label><br>
<?php if (isset($profil['foto_profil']) && !empty($profil['foto_profil'])) : ?>
<img src="<?php echo $profil['foto_profil']; ?>" width="100px"><br><br>
<?php endif; ?>
<input type="file" id="gambar" name="gambar"><br><br>
<input type="submit" name="profile" value="Simpan Perubahan">
<p style="color:red"><?php echo isset($error) ? $error : ''; ?></p>

</form>
        
        
</body>
</html>
