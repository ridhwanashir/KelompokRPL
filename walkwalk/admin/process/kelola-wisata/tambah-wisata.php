<?php
$pathfile = rand(0,9999999).$_FILES["foto"]["name"];

uploadFile($_FILES["foto"],"admin/img/foto_wisata/$pathfile");

$wisata = new TempatWisata($conn);
$wisata->nama_tempat = $_POST["nama_tempat"];
$wisata->alamat = $_POST["alamat"];
$wisata->harga = intval($_POST["harga"]);
$wisata->foto = $pathfile;
$wisata->add();

jsRedirect("?page=kelola-wisata&a1=tambah-wisata&msg=success");
exit;