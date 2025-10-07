<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - HealZen</title>
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: #f4f8fb;
      color: #333;
    }

    /* Header bagian atas */
    .header {
      background: linear-gradient(135deg, #4AA0E0, #34B6A2, #4AA0E0);
      text-align: center;
      padding: 60px 20px;
      color: white;
      position: relative;
    }

    /* Tombol kembali */
    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      text-decoration: none;
      color: white;
      font-weight: bold;
      font-size: 18px;
      display: flex;
      cursor: pointer;
      transition: transform 0.2s, color 0.3s;
      align-items: center;
    }

    .back-button:hover {
      color: #ffeb3b; transform: scale(1.2);
    }

    .back-button span {
      font-size: 24px;
      margin-right: 8px;
    }

    .back-button:hover {
      opacity: 0.8;
    }

    /* Judul dengan logo */
    .title-with-logo {
      display: inline-flex;
      align-items: center;
      gap: 15px;
    }

    .title-with-logo img {
      width: 80px;       /* diperbesar */
      height: 80px;      /* diperbesar */
      object-fit: cover;
      border-radius: 50%; /* buat bulat */
      border: 3px solid white; /* opsional, biar lebih rapi di background gradasi */
    }

    .header h1 {
      margin: 0;
      font-size: 36px;
      letter-spacing: 1px;
    }

    .header p {
      font-size: 16px;
      margin-top: 10px;
      opacity: 0.9;
    }

    /* Container utama */
    .container {
      max-width: 1200px;
      margin: 50px auto;
      display: flex;
      justify-content: space-between;
      gap: 20px;
      padding: 0 40px;
    }

    /* Kartu isi */
    .card {
      flex: 1;
      background-color: white;
      border-radius: 10px;
      padding: 30px 25px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .icon {
      font-size: 50px;
      margin-bottom: 15px;
    }

    .card h3 {
      color: #2c3e50;
      margin-bottom: 15px;
    }

    .card p {
      font-size: 15px;
      line-height: 1.6;
      color: #555;
    }

    .card:nth-child(1) .icon { color: #4AA0E0; }
    .card:nth-child(2) .icon { color: #34B6A2; }
    .card:nth-child(3) .icon { color: #4AA0E0; }

    @media (max-width: 900px) {
      .container {
        flex-direction: column;
        gap: 30px;
        padding: 0 20px;
      }
    }
  </style>
</head>
<body>

  <div class="header">
    <a href="pemetaan.php" class="back-button">
      <span>🡸</span> 
    </a>
    <div class="title-with-logo">
      <img src="healzen logo.jpg" alt="Logo Healzen">
      <h1>Tentang Healzen</h1>
    </div>
  </div>

  <div class="container">
    <div class="card">
      <div class="icon">⚙</div>
      <h3>....</h3>
      <p>
        ....
      </p>
    </div>

    <div class="card">
      <div class="icon">📊</div>
      <h3>...</h3>
      <p>
        ....
      </p>
    </div>

    <div class="card">
      <div class="icon">💬</div>
      <h3>...</h3>
      <p>
        ....
      </p>
    </div>
  </div>

</body>
</html>