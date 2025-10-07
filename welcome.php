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
  <title>Welcome HealZen</title>
  <!-- Font Awesome untuk icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
    }
    .top-left {
      position: absolute;
      top: 15px;
      left: 15px;
      width: 35px;
      height: 35px;
      background: #4AA0E0;
      border-radius: 50%;
    }
    .oval {
      width: 100%;
      height: 60vh;
      background: linear-gradient(to right, #4AA0E0, #34B6A2);
      border-bottom-left-radius: 50% 40%;
      border-bottom-right-radius: 50% 40%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
      padding: 20px;
    }
    .oval h1 {
      font-size: 24px;
      margin: 5px 0;
    }
    .oval a {
      text-decoration: none;
      font-size: 30px;
      font-weight: bold;
      color: #fff;
      transition: transform 0.3s, color 0.3s, text-shadow 0.3s;
    }
    .oval a:hover {
  background: linear-gradient(135deg, #3471b6ff, #4a60e0ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;

  /* Animasi menonjol */
  transform: scale(1.15);
  text-shadow: 0px 4px 10px rgba(0,0,0,0.25);
}
    .icons {
      margin-top: 20px;
      display: flex;
      gap: 20px;
      font-size: 28px;
    }
    .icons i {
      transition: transform 0.3s;
    }
    .icons i:hover {
      transform: scale(1.2);
    }
    .subtitle {
      margin-top: 15px;
      font-size: 14px;
      color: #f1f1f1;
      max-width: 300px;
    }

    /* Responsif untuk HP */
    @media (max-width: 480px) {
      .oval h1 {
        font-size: 20px;
      }
      .oval a {
        font-size: 24px;
      }
      .icons {
        font-size: 22px;
        gap: 15px;
      }
      .subtitle {
        font-size: 13px;
      }
    }
  </style>
</head>
<body>
  <div class="top-left"></div>
  <div class="oval">
    <h1>Selamat Datang</h1>
    <a href="pemetaan.php">HealZen</a>
    <div class="icons">
      <i class="fas fa-heartbeat"></i>
      <i class="fas fa-user-md"></i>
      <i class="fas fa-pills"></i>
    </div>
    <div class="subtitle">Solusi cerdas untuk mencari apotek terdekat dan layanan kesehatan terbaik.</div>
  </div>
</body>
</html>