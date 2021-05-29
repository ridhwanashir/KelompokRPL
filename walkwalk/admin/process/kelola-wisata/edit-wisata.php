<?php
$wisata = new TempatWisata($conn);
$wisata->getDataByID($_GET["id"]);
$wisata->nama_tempat = $_POST["nama_tempat"];
$wisata->alamat = $_POST["alamat"];
$wisata->harga = $_POST["harga"];
$wisata->edit();

jsRedirect("?page=kelola-wisata&a1=data-wisata&msg=success-edit");
