<?php

$metode = new MetodePembayaran($conn);
$metode->nama = $_POST["nama"];
$metode->no_rek = $_POST["no_rek"];
$metode->atas_nama = $_POST["atas_nama"];
$metode->add();

jsRedirect("?page=kelola-metode-pembayaran&a1=tambah-metode&msg=success");
exit;