<?php
$host = 'localhost'; // Ganti dengan host database Anda
$username = 'admin1234';  // Ganti dengan username database Anda
$password = 'X4mNHuvmd@M9YKr';      // Ganti dengan password database Anda
$database = 'toko_online'; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
