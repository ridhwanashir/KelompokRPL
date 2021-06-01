<?php
$pathfile = rand(0,9999999).$_FILES["foto"]["name"];

uploadFile($_FILES["foto"],"admin/img/foto_penginapan/$pathfile");

$penginapan = new Penginapan($conn);
$penginapan->nama_tempat = $_POST["nama_tempat"];
$penginapan->alamat = $_POST["alamat"];
$penginapan->foto = $pathfile;
$penginapan->add();

jsRedirect("?page=kelola-penginapan&a1=tambah-penginapan&msg=success");
exit;