<?php

$user = new User($conn);
$user->getDataByID($_SESSION["id"]);
$user->name = $_POST["name"];
if ($_POST["password"]) {
    $user->password = $_POST["password"];
}
$user->address = $_POST["address"];
$user->phone = $_POST["phone"];
$user->editUser();

header("Location: ?page=editprofil");