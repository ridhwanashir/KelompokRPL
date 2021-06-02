<?php

$pathfile = rand(0,9999999).$_FILES["foto_bukti"]["name"];

//move_uploaded_file($_FILES["foto_bukti"]["tmp_name"],"user/img/foto_bukti_pembayaran/$pathfile");
uploadFile($_FILES["foto_bukti"],"user/img/foto_bukti_pembayaran/$pathfile");

$pembayaran = new Pembayaran($conn);
$pembayaran->getDataByID($_POST["id"]);
$pembayaran->foto_bukti = $pathfile;
$pembayaran->status = StatusPembayaran::$menunggu_approval_admin;
$pembayaran->edit();

jsRedirect("?page=kirim-bukti-pembayaran&status=success-kirim");
exit;