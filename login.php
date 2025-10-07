<?php
session_start();
include "db.php"; // koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login HealZen</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fff;
    }

    /* Bagian header melengkung biru */
    .header-shape {
      width: 100%;
      height: 220px;
      background: linear-gradient(to right, #34B6A2, #4AA0E0);
      border-bottom-left-radius: 50% 100px;
      border-bottom-right-radius: 50% 100px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 50px;
      font-weight: bold;
    }

    /* Kotak form login */
    .form-box {
      margin-top: -20px;
      padding: 30px 20px;
      text-align: center;
    }

    /* Input umum */
    .form-box input {
      width: 90%;
      max-width: 350px;
      padding: 12px;
      margin: 10px 0;
      border-radius: 12px;
      border: 1px solid #ccc;
      font-size: 14px;
      box-sizing: border-box;
    }

    /* Container password (supaya ada mata di dalamnya) */
    .password-container {
      position: relative;
      display: inline-block;
      width: 90%;
      max-width: 350px;
    }
    .password-container input {
      width: 100%;
      padding-right: 40px; /* ruang buat tombol mata */
    }

    /* Tombol mata */
    .show-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      font-size: 16px;
    }

    /* Tombol login */
    .btn-login {
      width: 95%;
      max-width: 360px;
      padding: 12px;
      border: none;
      border-radius: 12px;
      background: #2ac9d6;
      color: white;
      font-size: 16px;
      margin-top: 15px;
      cursor: pointer;
      transition: transform 0.2s ease, background 0.3s;
    }
    .btn-login:hover {
      background: #4AA0E0;
      transform: scale(1.05);
    }

    /* Lupa password */
    .forgot {
      font-size: 12px;
      color: #666;
      text-align: left;
      max-width: 350px;
      margin: auto;
      margin-top: 5px;
    }
    .forgot a {
      color: #2ac9d6;
      text-decoration: none;
    }
    .forgot a:hover {
      text-decoration: underline;
    }

    /* Pesan error */
    .error {
      color: red;
      margin-top: 10px;
      font-size: 14px;
    }

    /* 📱 Responsif HP */
    @media (max-width: 480px) {
      .header-shape {
        height: 180px;
        font-size: 22px;
      }
      .form-box input,
      .password-container,
      .btn-login {
        width: 100%;
        max-width: none;
      }
      .forgot {
        font-size: 11px;
      }
    }
  </style>
</head>
<body>
  <!-- Header melengkung -->
  <div class="header-shape">HealZen</div>

  <!-- Form login -->
  <div class="form-box">
    <form method="POST">
      <!-- Username tetap di atas -->
      <input type="text" name="username" placeholder="USERNAME" required><br>

      <!-- Password di bawah dengan mata -->
      <div class="password-container">
        <input id="password" type="password" name="password" placeholder="PASSWORD" required>
        <button type="button" id="togglePassword" class="show-password">👁</button>
      </div>

      <div class="forgot"><a href="forgot.php">Lupa Password?</a></div>
      <button type="submit" class="btn-login">LOGIN</button>
    </form>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
  </div>

  <!-- Script toggle password -->
  <script>
    const pw = document.getElementById('password');
    const btn = document.getElementById('togglePassword');

    btn.addEventListener('click', () => {
      if (pw.type === 'password') {
        pw.type = 'text';
        btn.textContent = '👁'; // ganti icon saat terbuka
      } else {
        pw.type = 'password';
        btn.textContent = '⌣'; // kembali ke icon mata
      }
    });
  </script>
</body>
</html>