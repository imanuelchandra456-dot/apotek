<?php
include "db.php"; // koneksi database

// Jika pengguna melakukan pencarian manual lewat form
if (isset($_POST['search'])) {
  $kata = trim($_POST['search']);
  if (!empty($kata)) {
    $stmt = $conn->prepare("INSERT INTO pencarian_data (kata_kunci) VALUES (?)");
    $stmt->bind_param("s", $kata);
    $stmt->execute();
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta & Lokasi Apotek</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      background: linear-gradient(180deg, #34B6A2, #4AA0E0);
      font-family: Arial, sans-serif;
      color: #fff;
      min-height: 100vh;
    }

    .navbar {
      background: linear-gradient(90deg, #4AA0E0, #34B6A2);
      display: flex;
      align-items: center;
      padding: 14px 18px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .btn-back {
     background: none;
     border: none;
     color: white;
     font-size: 22px;
     margin-right: 12px;
     cursor: pointer;
     transition: transform 0.2s, color 0.3s;
    }
    .btn-back:hover { color: #ffeb3b; transform: scale(1.2); }

    .navbar-title { font-size: 1.2rem; font-weight: bold; }

    .container {
      width: 100%;
      margin: 0 auto;
      padding: 25px 10px;
      text-align: center;
    }

    .search-box {
      display: block;
      width: 80%;
      max-width: 450px;
      margin: 0 auto 25px auto;
      border-radius: 20px;
      border: none;
      padding: 10px 15px;
      font-size: 15px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 15px;
      justify-items: center;
      width: 100%;
    }

    .card-apotek {
      background: #fff;
      color: #333;
      border-radius: 15px;
      overflow: hidden;
      width: 100%;
      max-width: 220px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
    }
    .card-apotek:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    .card-apotek img {
      width: 100%;
      height: 120px;
      object-fit: cover;
    }

    .card-apotek h6 {
      font-size: 15px;
      font-weight: 600;
      margin: 10px 5px 5px 5px;
    }

    .card-apotek p {
      font-size: 13px;
      color: #666;
      margin-bottom: 10px;
    }

    @media (max-width: 1100px) { .grid { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 900px) { .grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 700px) { .grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px) { .grid { grid-template-columns: repeat(1, 1fr); } }
  </style>
</head>
<body>

  <div class="navbar">
    <button class="btn-back" onclick="window.history.back();">🡸</button>
    <span class="navbar-title">Peta & Lokasi Apotek</span>
  </div>

  <div class="container">
    <form method="POST" action="peta_lokasi.php">
      <input type="text" name="search" id="searchInput" class="search-box" placeholder="Cari apotek...">
    </form>

    <div class="grid" id="apotekList">
      <?php
      $apotek = [
        ["Apotek Al-Fatih", "Jl. Sam Ratulangi No. 12", "taman.jpg", "https://maps.google.com/?q=Apotek+Al-Fatih"],
        ["Apotek Berkah Jaya", "Jl. Diponegoro No. 45", "taman.jpg", "https://maps.google.com/?q=Apotek+Berkah+Jaya"],
        ["Apotek Bunda Farma", "Jl. Imam Bonjol No. 8", "taman.jpg", "https://maps.google.com/?q=Apotek+Bunda+Farma"],
        ["Apotek Farsya Farma", "Jl. Srandakan No. 10", "taman.jpg", "https://maps.google.com/?q=Apotek+Farsya+Farma"],
        ["Apotek Bethsaida", "Jl. Cendana No. 15", "taman.jpg", "https://maps.google.com/?q=Apotek+Bethsaida"],
        ["Apotek Davin", "Jl. Merdeka No. 5", "taman.jpg", "https://maps.google.com/?q=Apotek+Davin"],
        ["Apotek Cemerlang", "Jl. Sudirman No. 11", "taman.jpg", "https://maps.google.com/?q=Apotek+Cemerlang"],
        ["Apotek Ekklesia", "Jl. Rajawali No. 21", "taman.jpg", "https://maps.google.com/?q=Apotek+Ekklesia"],
        ["Apotek Farmindah 7", "Jl. Sisingamangaraja No. 19", "taman.jpg", "https://maps.google.com/?q=Apotek+Farmindah+7"],
        ["Apotek Farmindah 8", "Jl. Mandiri No. 18", "taman.jpg", "https://maps.google.com/?q=Apotek+Farmindah+8"],
        ["Apotek Kimia Sehat", "Jl. Veteran No. 20", "taman.jpg", "https://maps.google.com/?q=Apotek+Kimia+Sehat"],
        ["Apotek Mitra Farma", "Jl. Gatot Subroto No. 14", "taman.jpg", "https://maps.google.com/?q=Apotek+Mitra+Farma"],
        ["Apotek Global Medika", "Jl. Mutiara No. 3", "taman.jpg", "https://maps.google.com/?q=Apotek+Global+Medika"],
        ["Apotek Nusantara", "Jl. Hasanuddin No. 7", "taman.jpg", "https://maps.google.com/?q=Apotek+Nusantara"],
        ["Apotek Prima", "Jl. Anggrek No. 23", "taman.jpg", "https://maps.google.com/?q=Apotek+Prima"],
        ["Apotek Keluarga", "Jl. Anoa No. 9", "taman.jpg", "https://maps.google.com/?q=Apotek+Keluarga"],
        ["Apotek Sentosa", "Jl. Basuki Rahmat No. 20", "taman.jpg", "https://maps.google.com/?q=Apotek+Sentosa"],
        ["Apotek Tondo Sehat", "Jl. Tondo Raya No. 5", "taman.jpg", "https://maps.google.com/?q=Apotek+Tondo+Sehat"],
        ["Apotek Sigma Farma", "Jl. Sigma No. 17", "taman.jpg", "https://maps.google.com/?q=Apotek+Sigma+Farma"],
        ["Apotek Kimaja Medika", "Jl. Kimaja No. 10", "taman.jpg", "https://maps.google.com/?q=Apotek+Kimaja+Medika"],
        ["Apotek Imam Bonjol Farma", "Jl. Imam Bonjol No. 6", "taman.jpg", "https://maps.google.com/?q=Apotek+Imam+Bonjol+Farma"],
        ["Apotek SIS Al Jufri", "Jl. SIS Al Jufri No. 11", "taman.jpg", "https://maps.google.com/?q=Apotek+SIS+Al+Jufri"],
        ["Apotek Basuki Farma", "Jl. Basuki Rahmat No. 2", "taman.jpg", "https://maps.google.com/?q=Apotek+Basuki+Farma"],
        ["Apotek Anoa Farma", "Jl. Anoa No. 7", "taman.jpg", "https://maps.google.com/?q=Apotek+Anoa+Farma"],
        ["Apotek Moh Hatta", "Jl. Moh. Hatta No. 4", "taman.jpg", "https://maps.google.com/?q=Apotek+Moh+Hatta"],
        ["Apotek Palu Medika", "Jl. Palu Selatan No. 19", "taman.jpg", "https://maps.google.com/?q=Apotek+Palu+Medika"],
        ["Apotek Sejahtera", "Jl. Lagarutu No. 3", "taman.jpg", "https://maps.google.com/?q=Apotek+Sejahtera"],
        ["Apotek Bumi Farma", "Jl. Tadulako No. 15", "taman.jpg", "https://maps.google.com/?q=Apotek+Bumi+Farma"],
        ["Apotek Mandiri", "Jl. Baliase No. 12", "taman.jpg", "https://maps.google.com/?q=Apotek+Mandiri"],
        ["Apotek Murni Farma", "Jl. Trans Sulawesi No. 1", "taman.jpg", "https://maps.google.com/?q=Apotek+Murni+Farma"]
      ];

      foreach ($apotek as $a) {
        echo '
        <div class="card-apotek" data-nama="'.$a[0].'" data-link="'.$a[3].'">
          <img src="'.$a[2].'" alt="'.$a[0].'">
          <h6>'.$a[0].'</h6>
          <p>'.$a[1].'</p>
        </div>';
      }
      ?>
    </div>
  </div>

  <script>
    // Filter apotek
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
      const filter = this.value.toLowerCase();
      const cards = document.querySelectorAll('#apotekList .card-apotek');
      cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(filter) ? 'block' : 'none';
      });
    });

    // Klik apotek -> simpan ke database -> buka maps
    document.querySelectorAll('.card-apotek').forEach(card => {
      card.addEventListener('click', function() {
        const nama = this.dataset.nama;
        const link = this.dataset.link;

        fetch('simpan_pencarian.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'search=' + encodeURIComponent(nama)
        }).then(() => {
          window.open(link, '_blank');
        });
      });
    });
  </script>

</body>
</html>