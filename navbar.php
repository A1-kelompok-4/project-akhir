<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navbar.css">
    <style>
    .nav-list {
        padding-left: 3em;
    }
</style>


</head>

<body class="mobile">
    <nav>
        <div class="container nav-wrapper" style="display: flex; align-items: center;">
        <div class="brand" style="display: flex; align-items: center;">
            <img src="img/logo.png" alt="" style="width: 100px;">
            <span><strong>ALFA COMPUTER</strong></span>
        </div>
            <ul class="nav-list">
                <li>
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li><a class="nav-link" href="products.php">Products</a></li>
                <li>
                    <a class="nav-link" href="transaksi.php">Transaksi</a>
                </li>
                <li><a class="nav-link" href="about.php">About Us</a></li>
                <li><a class="nav-link" href="https://wa.wizard.id/627b7a">Contact</a></li>
                
                    </ul>
                    <ul class="nav-list nav-right" style="display: flex; justify-content: flex-end;">
    <li>
        <a class="nav-link" href="setting.php">
            <button class="btn"><?php echo $_SESSION['nama']; ?> profile</button>
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
    <script src="JS/navbar.js"></script>
</body>

</html>
