<?php

$conn = new mysqli("localhost", "root", "", "walkwalk");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
