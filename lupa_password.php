<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kalau email ditemukan → tampilkan password (sementara, untuk testing)
        $row = $result->fetch_assoc();
        $pesan = "Password Anda: " . $row['password'];
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
</head>
<body>
  <h2>Lupa Password</h2>
  <form method="POST">
    <input type="email" name="email" placeholder="Masukkan email Anda" required>
    <button type="submit">Kirim</button>
  </form>
  <?php 
    if(isset($pesan)) echo "<p style='color:green;'>$pesan</p>";
    if(isset($error)) echo "<p style='color:red;'>$error</p>";
  ?>
</body>
</html>