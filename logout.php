<?php
    session_start(); //inisialisasi session
    if(session_destroy()) {//menghapus session
        header("Location: dashboard.php"); //jika berhasil maka akan diredirect ke file index.php
    }
?>