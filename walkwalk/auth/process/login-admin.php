<?php

$admin = new Admin($conn);
$admin->username = $_POST["username"];
$admin->password = $_POST["password"];
$r = $admin->loginAdmin();

if ($r["status"] == "success")
{
    $_SESSION["id"] = $admin->id;
    $_SESSION["role"] = "admin";
    header("Location: ?page=home");
    exit;
}

header("Location: ?page=login-admin&status=0");