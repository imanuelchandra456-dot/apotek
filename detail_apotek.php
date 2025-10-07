<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$apotek_list = [
  "Apotek Nusantara",
  "Apotek Idham Farma",
  "Apotek Medica Farma",
  "Apotek Bunda Farma",
  "Apotek Linda Farma",
  "Apotek Palu Sehat",
  "Apotek Sehat Abadi Farma",
  "Apotek Al-Fatih",
  "Apotek Inna Farma",
  "Apotek Davin",
  "Apotek Pelita Mas",
  "Apotek Elfata",
  "Apotek Betsaida",
  "Apotek Kasih Farma",
  "Apotek Sehat Berkah",
  "Apotek Mitra Abadi",
  "Apotek Farmindah 7",
  "Apotek Utama Farma",
  "Apotek Kasih Farma 2",
  "Apotek Zam",
  "Apotek Berkah Jaya",
  "Apotek PCC (Palu Central Care)",
  "Apotek Farmindah 8",
  "Apotek Farsya Farma",
  "Apotek Tirta Medical Pratama",
  "Apotek Jennica Farma",
  "Apotek Zoya",
  "Apotek Cemerlang",
  "Apotek Pelita",
  "Apotek Surya"
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nama = $apotek_list[$id-1] ?? "Apotek tidak ditemukan";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Apotek</title>
</head>
<body>
  <h2><?php echo $nama; ?></h2>
  <p>Detail informasi apotek akan ditambahkan di sini.</p>
  <a href="daftar_apotek.php">← Kembali ke daftar</a>
</body>
</html>