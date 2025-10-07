<?php
session_start();
include "db.php"; // koneksi database

// Simpan pencarian jika form dikirim manual (Enter)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['keyword'])) {
    $keyword = trim($_POST['keyword']);
    if ($keyword != "") {
        $stmt = $conn->prepare("INSERT INTO pencarian (nama_apotek) VALUES (?)");
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
    }
}

// Ambil data apotek dari tabel apotek
$apotek = $conn->query("SELECT * FROM apotek ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Apotek</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #34B6A2, #4AA0E0);
      min-height: 100vh;
    }
    .header {
      width: 100%;
      display: flex;
      align-items: center;
      padding: 15px;
      background: linear-gradient(to right, #4AA0E0, #34B6A2);
      color: white;
    }
    .header h2 {
      margin: 0;
      font-size: 20px;
    }
    .back-btn {
      font-size: 22px;
      margin-right: 15px;
      cursor: pointer;
      transition: transform 0.2s, color 0.3s;
    }
    .back-btn:hover {
      color: #ffeb3b; transform: scale(1.2); 
    }
    .container {
      padding: 20px;
    }

    .search-box {
      text-align: center;
      margin-bottom: 20px;
    }
    .search-box input {
      width: 90%;
      max-width: 400px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 20px;
      font-size: 14px;
    }

    .apotek-list {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .apotek-item {
      background: white;
      padding: 12px 15px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .apotek-item:hover {
      background: #eaf7fa;
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .apotek-item .icon {
      color: #1cb5e0;
      font-size: 18px;
    }
    .apotek-item span {
      font-size: 15px;
      font-weight: 500;
    }

    /* Modal detail apotek */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }
    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 12px;
      max-width: 400px;
      width: 90%;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      text-align: left;
      animation: fadeIn 0.3s ease-in-out;
    }
    .modal-content h3 {
      margin-top: 0;
      color: #4AA0E0;
    }
    .close {
      float: right;
      font-size: 20px;
      cursor: pointer;
      color: #666;
    }
    .close:hover {
      color: red;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>

  <div class="header">
    <span class="back-btn" onclick="history.back()">🡸</span>
    <h2>Daftar Apotek</h2>
  </div>

  <div class="container">
    <!-- Kolom pencarian -->
    <div class="search-box">
      <form method="POST">
        <input type="text" id="search" name="keyword" placeholder="Cari apotek..." onkeyup="filterApotek(event)">
      </form>
    </div>

    <!-- Daftar apotek -->
    <div class="apotek-list" id="apotekList">
      <?php while($row = $apotek->fetch_assoc()): ?>
        <div class="apotek-item"
             data-nama="<?= htmlspecialchars($row['nama']) ?>"
             data-alamat="<?= htmlspecialchars($row['alamat']) ?>"
             data-nohp="<?= htmlspecialchars($row['no_hp']) ?>"
             data-buka="<?= htmlspecialchars($row['jam_buka']) ?>"
             data-tutup="<?= htmlspecialchars($row['jam_tutup']) ?>"
             data-koordinat="<?= htmlspecialchars($row['koordinat']) ?>">
          <div class="icon">🏥</div>
          <span><?= htmlspecialchars($row['nama']) ?></span>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Modal detail apotek -->
  <div class="modal" id="apotekModal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h3 id="modalNama"></h3>
      <p><b>Alamat:</b> <span id="modalAlamat"></span></p>
      <p><b>No. HP:</b> <span id="modalNoHp"></span></p>
      <p><b>Jam Buka:</b> <span id="modalBuka"></span></p>
      <p><b>Jam Tutup:</b> <span id="modalTutup"></span></p>
      <p><b>Koordinat:</b> <span id="modalKoordinat"></span></p>
    </div>
  </div>

  <script>
    // Buka modal saat apotek diklik
    document.querySelectorAll(".apotek-item").forEach(item => {
      item.addEventListener("click", function() {
        document.getElementById("modalNama").innerText = this.dataset.nama;
        document.getElementById("modalAlamat").innerText = this.dataset.alamat;
        document.getElementById("modalNoHp").innerText = this.dataset.nohp;
        document.getElementById("modalBuka").innerText = this.dataset.buka;
        document.getElementById("modalTutup").innerText = this.dataset.tutup;
        document.getElementById("modalKoordinat").innerText = this.dataset.koordinat;
        document.getElementById("apotekModal").style.display = "flex";

        // 🔹 Simpan otomatis ke database saat diklik
        fetch("save_search.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "keyword=" + encodeURIComponent(this.dataset.nama)
        });
      });
    });

    // Tutup modal
    function closeModal() {
      document.getElementById("apotekModal").style.display = "none";
    }

    // Filter apotek saat mengetik
    function filterApotek(e) {
      let filter = e.target.value.toLowerCase();
      document.querySelectorAll(".apotek-item").forEach(item => {
        let text = item.innerText.toLowerCase();
        item.style.display = text.includes(filter) ? "flex" : "none";
      });
      // Simpan juga ke DB jika tekan Enter
      if (e.key === "Enter") {
        e.target.form.submit();
      }
    }
  </script>
</body>
</html>