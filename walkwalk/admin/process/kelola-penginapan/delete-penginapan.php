<?php

$penginapan = new Penginapan($conn);
$penginapan->id = $_GET["id"];
$penginapan->delete();

jsRedirect("?page=kelola-penginapan&a1=data-penginapan&msg=success-delete");
exit;