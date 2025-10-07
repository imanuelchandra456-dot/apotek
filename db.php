<?php
$host = "localhost";
$user = "root"; // username phpMyAdmin (biasanya root)
$pass = "";     // password MySQL (kosong kalau default di XAMPP)
$db   = "menu_login"; // sesuai database kamu

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>