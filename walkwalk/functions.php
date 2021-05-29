<?php
// functions.php menyimpan fungsi-fungsi global yang dibutuhkan
function innerJs($code) // fungsi menjalankan script JS
{
    return "<script>$code</script>";
}

function jsRedirect($url) 
{
    echo innerJs("window.location.href = '$url'");
}

function isLoggedIn() // cek session login
{
    if (isset($_SESSION["id"]) && isset($_SESSION["role"])) return true;
    return false;
}

function gotoHomeIfLoggedIn() // mengarahkan ke home jika sudah login
{
    if (isLoggedIn()) {
        header("location: ?page=home");
        exit;
    }
}

function gotoLoginIfNotLoggedIn() // mengarahkan ke page login jika belum login
{
    if (!isLoggedIn()) {
        header("location: ?page=login");
        exit;
    }
}