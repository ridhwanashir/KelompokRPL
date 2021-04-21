<?php

$r = $db->loginAdmin($_POST["username"], $_POST["password"]);
$r = $r->get_result();
if ($r->num_rows > 0) {
    $_SESSION["id"] = $r->fetch_assoc()["id"];
    $_SESSION["role"] = "admin";
    header("Location: ?page=home");
} else {
    header("Location: ?page=login-admin&status=0");
}