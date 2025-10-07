<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "gis_apotek"; 
$conn = new mysqli($host, $user, $pass, $db);

if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $sql = "INSERT INTO riwayat_pencarian (nama_apotek) VALUES ('$nama')";
    $conn->query($sql);
}
?>