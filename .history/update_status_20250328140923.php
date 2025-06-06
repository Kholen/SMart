<?php
session_start();
include 'config.php';

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

// Periksa apakah data dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pemesanan_id = $_POST['pemesanan_id'];
    $status_pemesanan = $_POST['status_pemesanan'];

    // Update status pemesanan
    $query = "UPDATE pemesanan SET status_pemesanan = ? WHERE pemesanan_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status_pemesanan, $pemesanan_id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = [
            "type" => "success",
            "message" => "Status pemesanan berhasil diperbarui."
        ];
    } else {
        $_SESSION['flash_message'] = [
            "type" => "error",
            "message" => "Gagal memperbarui status pemesanan."
        ];
    }

    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman admin_pemesanan.php
    header("Location: admin_pemesanan.php");
    exit();
}
?>
