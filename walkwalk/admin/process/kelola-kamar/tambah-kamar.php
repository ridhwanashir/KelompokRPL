<?php

$kamar = new Kamar($conn);
$kamar->penginapan_id = $_POST["penginapan_id"];
$kamar->no_kamar = $_POST["no_kamar"];
$kamar->harga = $_POST["harga"];
$kamar->add();

jsRedirect("?page=kelola-kamar&a1=tambah-kamar&msg=success");
exit;