<?php

$pembayaran = new Pembayaran($conn);
$pembayaran->getDataByID($_GET["a1"]);

if ($pembayaran->tiket_id)
{
    $tiket = new TiketWisata($conn);
    $tiket->getDataByID($pembayaran->tiket_id);
    $tiket->delete();
    $pembayaran->delete();

    jsRedirect("?page=kirim-bukti-pembayaran");
    exit;
}

$pp = new PesanPenginapan($conn);
$pp->getDataByID($pembayaran->book_id);
$pp->delete();
$pembayaran->delete();
jsRedirect("?page=kirim-bukti-pembayaran");