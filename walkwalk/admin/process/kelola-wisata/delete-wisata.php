<?php

$wisata = new TempatWisata($conn);
$wisata->id = $_GET["id"];
$wisata->delete();

jsRedirect("?page=kelola-wisata&a1=data-wisata&msg=success-delete");
exit;