
<?php
//inisialisasi session
session_start();

//mengecek username pada session
if( !isset($_SESSION['nama']) ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
<link rel="stylesheet" href="indexs.css">

</head>
<body>
<header>
		<h1>Welcome to Alfa Computer!</h1>
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="about.php">About Us</a></li>
				<li><a href="https://wa.wizard.id/627b7a">Contact Us</a></li>
                <li><a href="logout.php">logout</a></li>
			</ul>
		</nav>
	</header>
    <div class="wrapper">
        <section id="home">
            <img src="https://img.freepik.com/free-vector/technical-support-guys-working-repairing-computer-hardware-software-troubleshooting-fixing-problems-problem-checking-concept_335657-1838.jpg?w=900&t=st=1678149825~exp=1678150425~hmac=8237c48e5021e215476811401238629fbfe3f4973e97612ad148ad061535968a"
                width=60%>
            <div class="kolom">
                <p class="deskripsi">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint eaque eveniet veniam corporis sapiente, aut quam voluptate doloremque commodi quasi atque assumenda excepturi ut pariatur sequi ducimus incidunt velit ad.</p>
                <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quasi aliquid tempora ab laboriosam nesciunt eos expedita itaque sapiente tenetur earum ipsa quae, ut voluptate eius odit laudantium fugiat sequi unde?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum reprehenderit labore modi perspiciatis dolorem, eos vitae inventore, autem quos harum alias? Quidem incidunt deleniti earum vel sapiente vero nostrum repellat! </p>
                <p><a href="saran.html" class="">Saran</a></p>
            </div>

        </section>
    </div>
    <footer>
    <p>&copy; 2023 Alfa Computer</p>
    </footer>

</body>
 <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

