<?php

$r = $db->editUser($_SESSION["id"],$_POST["name"],$_POST["email"],$_POST["password"],$_POST["address"],$_POST["phone"]);
$res = $r->get_result();
header("Location: ?page=editprofil");