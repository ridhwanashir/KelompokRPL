<?php
$penginapan = new Penginapan($conn);
$penginapan->getDataByID($_GET["id"]);
$penginapan->nama_tempat = $_POST["nama_tempat"];
$penginapan->alamat = $_POST["alamat"];
$penginapan->edit();
jsRedirect("?page=kelola-penginapan&a1=data-penginapan&msg=success-edit");
exit;