<?php
include "db.php"; // koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // cek apakah email ada di database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pesan = "Password Anda adalah: <b>" . $row['password'] . "</b>";
        $warna = "green";
    } else {
        $pesan = "Email tidak ditemukan!";
        $warna = "red";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password - HealZen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #34B6A2, #4AA0E0);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .container {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      padding: 30px 25px;
      width: 90%;
      max-width: 400px;
      text-align: center;
      animation: fadeIn 0.6s ease;
    }

    .container h2 {
      margin: 0 0 20px 0;
      font-size: 22px;
      color: #333;
    }

    .container input {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .btn-submit {
      background: linear-gradient(to right, #4AA0E0, #34B6A2);
      color: white;
      font-weight: bold;
    }
    .btn-submit:hover {
      transform: scale(1.05);
    }

    .btn-back {
      background: #eee;
      color: #333;
      margin-top: 12px;
    }
    .btn-back:hover {
      background: #ddd;
      transform: scale(1.03);
    }

    .pesan {
      margin-top: 15px;
      font-size: 14px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
      .container {
        padding: 20px 15px;
      }
      .container h2 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Lupa Password</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Masukkan Email Anda" required>
      <button type="submit" class="btn btn-submit">Kirim</button>
    </form>
    <form action="login.php" method="get">
      <button type="submit" class="btn btn-back">Kembali ke Login</button>
    </form>

    <?php if(isset($pesan)) echo "<p class='pesan' style='color:$warna'>$pesan</p>"; ?>
  </div>
</body>
</html>