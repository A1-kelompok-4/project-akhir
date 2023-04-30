<?php
require "koneksi.php";
$query ="SELECT * FROM barang";
$result =mysqli_query($conn, $query);
?>

<html>
<head>
	<title>Products - Alfa Computer</title>
    
</head>
<body>
	<header>
		<h1>Welcome to Alfa Computer!</h1>
		<nav>
			<ul>
				<li><a href="user.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<h2>Featured Products</h2>
        <input type="text" id="search" placeholder="Search...">
        <button type="submit" id="submit">Search</button> 
        <br><br>

		<table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>no</th>
                <th>id barang</th>
                <th>nama barang</th>
                <th>Harga <button type="button" id="sortAsc">Termurah</button> <button type="button" id="sortDesc">Termahal</button></th>
                <th>stock</th>

            </tr>
            <?php
            $i =1;
             while($row =mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row["id_barang"]?></td>
                <td><?php echo $row["nama_barang"]?></td>
                <td><?php echo $row["harga"]?></td>
                <td><?php echo $row["stok"]?></td>

            </tr>
            <?php $i++?>
            <?php }?>
        </table>
</main>
<footer>
	<p>&copy; 2023 Alfa Computer</p>
</footer>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="JS/products.js"></script>