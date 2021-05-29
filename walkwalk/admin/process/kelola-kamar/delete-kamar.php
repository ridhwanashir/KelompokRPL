<?php

$kamar = new Kamar($conn);
$kamar->id = $_GET["id"];
$kamar->delete();

jsRedirect("?page=kelola-kamar&a1=data-kamar&msg=success-delete");
exit;