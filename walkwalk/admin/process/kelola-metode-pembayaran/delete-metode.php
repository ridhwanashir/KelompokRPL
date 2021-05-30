<?php

$metode = new MetodePembayaran($conn);
$metode->id = $_GET["id"];
$metode->delete();

jsRedirect("?page=kelola-metode-pembayaran&a1=data-metode&msg=success-delete");
exit;