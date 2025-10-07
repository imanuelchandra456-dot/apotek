<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_SESSION['username'] ?? "guest";
    $apotek   = $_POST['apotek'] ?? '';
    $lat      = $_POST['lat'] ?? '';
    $lng      = $_POST['lng'] ?? '';

    if ($apotek !== '') {
        $stmt = $conn->prepare("INSERT INTO log_apotek (username, apotek, lat, lng) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $apotek, $lat, $lng);
        $stmt->execute();
        $stmt->close();
        echo "OK";
    } else {
        echo "ERROR";
    }
}