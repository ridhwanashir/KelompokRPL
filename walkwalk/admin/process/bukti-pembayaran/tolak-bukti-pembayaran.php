<?php

$pembayaran = new Pembayaran($conn);
$pembayaran->getDataByID($_GET["a1"]);
$pembayaran->status = StatusPembayaran::$pembayaran_ditolak;
$pembayaran->edit();

jsRedirect("?page=bukti-pembayaran&status=success-tolak");
exit;