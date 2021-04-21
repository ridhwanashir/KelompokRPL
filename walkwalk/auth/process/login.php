<?php

$r = $db->loginWithEmail($_POST["email"], $_POST["password"]);
$r = $r->get_result();
if ($r->num_rows > 0) {
    $_SESSION["id"] = $r->fetch_assoc()["id"];
    $_SESSION["role"] = "user";
    header("Location: ?page=home");
} else {
    header("Location: ?page=login&status=0");
}