<?php

$penginapan = new Penginapan($conn);
$penginapan->nama_tempat = $_POST["nama_tempat"];
$penginapan->alamat = $_POST["alamat"];
$penginapan->add();

jsRedirect("?page=kelola-penginapan&a1=tambah-penginapan&msg=success");
exit;