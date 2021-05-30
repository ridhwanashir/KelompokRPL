<?php
$metode = new MetodePembayaran($conn);
$metode->getDataByID($_GET["id"]);
$metode->atas_nama = $_POST["atas_nama"];
$metode->no_rek = $_POST["no_rek"];
$metode->nama = $_POST["nama"];
$metode->edit();

jsRedirect("?page=kelola-metode-pembayaran&a1=data-metode&msg=success-edit");
