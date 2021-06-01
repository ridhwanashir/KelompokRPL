<?php
$wisata = new TempatWisata($conn);
$wisata->getDataByID($_GET["id"]);
$wisata->nama_tempat = $_POST["nama_tempat"];
$wisata->alamat = $_POST["alamat"];
$wisata->harga = $_POST["harga"];
if (is_uploaded_file($_FILES["foto"]["tmp_name"]))
{
    $pathfile = rand(0,9999999).$_FILES["foto"]["name"];
    uploadFile($_FILES["foto"],"admin/img/foto_wisata/$pathfile");
    $wisata->foto = $pathfile;
}
$wisata->edit();

jsRedirect("?page=kelola-wisata&a1=data-wisata&msg=success-edit");
