<?php
include "db.php";

if (isset($_POST['search'])) {
  $kata = trim($_POST['search']);
  if (!empty($kata)) {
    $stmt = $conn->prepare("INSERT INTO pencarian_data (kata_kunci) VALUES (?)");
    $stmt->bind_param("s", $kata);
    $stmt->execute();
  }
}
?>