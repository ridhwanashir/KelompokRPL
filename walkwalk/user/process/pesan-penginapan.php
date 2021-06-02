<?php

$metode = $_POST["metode_pembayaran"];

$pesan_penginapan = new PesanPenginapan($conn);
$pesan_penginapan->user_id = $_POST["user_id"];
$pesan_penginapan->kamar_id = $_POST["kamar_id"];
$pesan_penginapan->durasi = $_POST["durasi"];
$pesan_penginapan->total_harga = $_POST["total_harga"];
$pesan_penginapan->add();

$pembayaran = new Pembayaran($conn);
$pembayaran->book_id = $pesan_penginapan->id;
$pembayaran->total_harga = $pesan_penginapan->total_harga;
$pembayaran->metode_pembayaran = $metode;
$pembayaran->add();

jsRedirect("?page=bayar&a1=$pesan_penginapan->id&a2=$metode&a3=$pembayaran->id");
exit;