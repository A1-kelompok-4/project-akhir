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
    global $conn;
    $error = "";
    $target_file = $target_dir . stripFileName(basename($_FILES["gambar"]["name"]));
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (empty($_POST['nama_lengkap']) && empty($_POST['email']) && empty($_POST['nomor_hp']) && empty($_POST['alamat']) && empty($_FILES["gambar"]["name"])) {
        $error = "Harap isi minimal satu kolom!";
    } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && !empty($_FILES["gambar"]["name"])) {
        $error = "Maaf, harap masukkan gambar dengan format JPG, JPEG, PNG, atau GIF!";
    } else {
        $id_profil = $_POST['id_profil'];
        $id_user = $_POST['id_user'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $nomor_hp = $_POST['nomor_hp'];
        $alamat = $_POST['alamat'];
        $foto_profil = empty($_FILES["gambar"]["name"]) ? "" : $target_file;

        // query untuk mengecek apakah profil user sudah ada di database
        $query = "SELECT * FROM profil WHERE id_user = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $profil = mysqli_fetch_assoc($result);

        if ($profil) {
            // jika profil user sudah ada, maka lakukan update data profil
            $query = "UPDATE profil SET nama_lengkap = ?, email = ?, nomor_hp = ?, alamat = ?, foto_profil = ? WHERE id_user = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $nama_lengkap, $email, $nomor_hp, $alamat, $foto_profil, $id_user);
            mysqli_stmt_execute($stmt);
        } else {
            // jika profil user belum ada, maka lakukan insert data profil
            $query = "INSERT INTO profil (nama_lengkap, email, nomor_hp, alamat, foto_profil, id_user) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $nama_lengkap, $email, $nomor_hp, $alamat, $foto_profil, $id_user);
            mysqli_stmt_execute($stmt);
        }

        if (!empty($_FILES["gambar"]["name"])) {
            move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        }

        // redirect ke halaman profil setelah berhasil update
        header("Location: setting.php");
        exit();
    }
} else {
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
    $query = "SELECT * FROM user WHERE id_user = ?";
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
        <input type="hidden" name="id_user" value="<?php echo isset($profil['id_user']) ? $profil['id_user'] : ''; ?>">
        Nama lengkap:
        <input type="text" name="nama_lengkap">
        Email:
        <input type="email" name="email">
        Nomor HP:
        <input type="text" name="nomor_hp">
        Alamat:
        <input type="text" name="alamat">
        Foto profil:
        <?php if (!empty($profil['foto_profil'])) { ?>
        <img src="<?php echo $profil['foto_profil']; ?>" alt="Foto Profil">
        <?php } ?>
        <input type="file" name="gambar">
        <br>
        <br>
        <input type="submit" name="profile" value="Update">
    </form>
        
</body>
</html>
