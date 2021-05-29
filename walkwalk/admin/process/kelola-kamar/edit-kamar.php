<?php
$kamar = new Kamar($conn);
$kamar->getDataByID($_GET["id"]);
$kamar->penginapan_id = $_POST["penginapan_id"];
$kamar->no_kamar = $_POST["no_kamar"];
$kamar->harga = $_POST["harga"];
$kamar->edit();

jsRedirect("?page=kelola-kamar&a1=data-kamar&msg=success-edit");
