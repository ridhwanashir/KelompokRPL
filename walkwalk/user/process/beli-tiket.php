<?php

$metode = $_POST["metode_pembayaran"];
$tiket = new TiketWisata($conn);
$tiket->user_id = $_POST["user_id"];
$tiket->wisata_id = $_POST["wisata_id"];
$tiket->total_tiket = $_POST["total_tiket"];
$tiket->total_harga = $_POST["total_harga"];
$tiket->add();

$pembayaran = new Pembayaran($conn);
$pembayaran->tiket_id = $tiket->id;
$pembayaran->total_harga = $tiket->total_harga;
$pembayaran->metode_pembayaran = $metode;
$pembayaran->add();

jsRedirect("?page=bayar&a1=$tiket->id&a2=$metode&a3=$pembayaran->id");
exit;