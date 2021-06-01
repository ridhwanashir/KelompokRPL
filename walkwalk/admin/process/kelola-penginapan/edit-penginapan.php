<?php

$penginapan = new Penginapan($conn);
$penginapan->getDataByID($_GET["id"]);
$penginapan->nama_tempat = $_POST["nama_tempat"];
$penginapan->alamat = $_POST["alamat"];
if (is_uploaded_file($_FILES["foto"]["tmp_name"]))
{
    $pathfile = rand(0,9999999).$_FILES["foto"]["name"];
    uploadFile($_FILES["foto"],"admin/img/foto_penginapan/$pathfile");
    $penginapan->foto = $pathfile;
}
$penginapan->edit();
jsRedirect("?page=kelola-penginapan&a1=data-penginapan&msg=success-edit");
exit;