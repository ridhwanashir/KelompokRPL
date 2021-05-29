<?php

$wisata = new TempatWisata($conn);
$wisata->nama_tempat = $_POST["nama_tempat"];
$wisata->alamat = $_POST["alamat"];
$wisata->harga = intval($_POST["harga"]);
$wisata->add();

jsRedirect("?page=kelola-wisata&a1=tambah-wisata&msg=success");
exit;