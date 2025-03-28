<?php
// Pastikan hanya memulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah session sudah diset sebelum mengaksesnya
$userId = $_SESSION["user_id"] ?? null;
$name = $_SESSION["name"] ?? null;
$role = $_SESSION["role"] ?? null;

$notification = $_SESSION['notification'] ?? null;
if ($notification) {
    unset($_SESSION['notification']);
}

// Perbaikan logika pengecekan login
if (!$userId || !$role) {
    $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Silakan login terlebih dahulu!'
    ];
    header('Location: ./auth/login.php');
    exit();
}
?>
