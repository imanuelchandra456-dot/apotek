<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemetaan Apotek</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      min-height: 100vh;
      background: linear-gradient(to right, #34B6A2, #4AA0E0);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Header */
    .header {
      width: 100%;
      display: flex;
      align-items: center;
      padding: 14px 18px;
      background: linear-gradient(to right, #4AA0E0, #34B6A2);
      box-sizing: border-box;
    }
    .header h2 {
      margin: 0;
      font-size: 18px;
      color: white;
    }
    .back-btn {
      font-size: 22px;
      text-decoration: none;
      margin-right: 10px;
      margin-left: 5px;
      cursor: pointer;
      transition: transform 0.2s, color 0.3s;
      user-select: none;
    }
    .back-btn:hover {
      color: #ffeb3b; transform: scale(1.2);
    }

    /* Logo bulat */
    .logo {
      margin: 25px auto 15px auto;
      width: 130px;
      height: 130px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    /* Title */
    .title {
      text-align: center;
      margin: 10px 0 30px 0;
    }
    .title h1 {
      margin: 5px 0;
      font-size: 30px;
      font-weight: bold;
      letter-spacing: 1px;
    }
    .title p {
      margin: 5px 0 0 0;
      font-size: 22px;
      font-weight: 600;
      color: #fdfdfd;
      text-shadow: 0px 2px 4px rgba(0,0,0,0.4);
    }

    /* Menu */
    .menu {
      width: 90%;
      max-width: 400px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .menu a i {
      display: inline-block;
      width: 25px;   /* lebar tetap agar ikon sejajar */
      text-align: center;
      font-style: normal;
    }

    .menu a {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 14px 18px;
      background: rgba(255,255,255,0.1);
      border-radius: 10px;
      color: white;
      font-size: 16px;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    .menu a:hover {
      background: rgba(255,255,255,0.2);
      transform: scale(1.03);
    }

    /* Logout button */
    .logout {
      margin-top: 25px;
      margin-bottom: 20px;
      width: 90%;
      max-width: 400px;
    }
    .logout a {
      display: block;
      text-align: center;
      padding: 12px;
      border-radius: 10px;
      background: rgba(255, 50, 50, 0.85);
      color: white;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s;
    }
    .logout a:hover {
      background: rgba(255, 50, 50, 1);
    }

    /* Responsif */
    @media (max-width: 480px) {
      .logo {
        width: 100px;
        height: 100px;
      }
      .title h1 {
        font-size: 24px;
      }
      .title p {
        font-size: 18px;
      }
      .menu a {
        font-size: 14px;
        padding: 10px 15px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="header">
    <span class="back-btn" onclick="history.back()">🡸</span>
    <h2>Pemetaan Apotek</h2>
  </div>

  <!-- Logo -->
  <div class="logo">
    <img src="healzen logo.jpg" alt="HealZen Logo">
  </div>

  <!-- Title -->
  <div class="title">
    <h1>HealZen</h1>
    <p>Pemetaan Apotek</p>
  </div>

  <!-- Menu -->
<div class="menu">
  <a href="peta_lokasi.php"><i>🗺</i> <span>Peta & Lokasi</span></a>
  <a href="daftar_apotek.php"><i>💊</i> <span>Daftar Apotek</span></a>
  <a href="about_us.php"><i>ℹ</i> <span>About Us</span></a>
</div>

  <!-- Logout -->
  <div class="logout">
    <a href="logout.php">⏻ Logout</a>
  </div>
</body>
</html>