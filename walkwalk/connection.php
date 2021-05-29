<?php
// connection.php berfungsi menyambungkan koneksi ke database
$conn = new mysqli("localhost", "root", "", "walkwalk");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
