<?php

$user = new User($conn);
$user->email = $_POST["email"];
$user->password = $_POST["password"];
$r = $user->loginWithEmail();

if ($r["status"] == "success")
{
    $_SESSION["id"] = $user->id;
    $_SESSION["role"] = "user";
    header("Location: ?page=home");
    exit;
}

header("Location: ?page=login&status=0");
