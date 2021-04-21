<?php

$r = $db->registerUser($_POST["name"],$_POST["email"],$_POST["password"],$_POST["address"],$_POST["phone"]);
$res = $r->get_result();
$_SESSION["id"] = $r->insert_id;
$_SESSION["role"] = "user";
header("Location: ?page=login");