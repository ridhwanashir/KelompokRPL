<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="res/css/bootstrap.min.css" rel="stylesheet">
    <script src="res/js/jquery.min.js"></script>
    <title>WalkWalk</title>
</head>

<body>
    <?php
    session_start();

    require "connection.php";
    require "classes.php";
    require "functions.php";

    $user = null;
    $admin = null;

    $navbarSwitch = [
        "user"=>"navbar/navbar-user.php",
        "admin"=>"navbar/navbar-admin.php"
    ];

    $homeSwitch = [
        "user"=>"home/page/home-user.php",
        "admin"=>"home/page/home-user.php"
    ];


    // Ambil Role User
    if (isLoggedIn())
    {
        switch ($_SESSION["role"])
        {
            case "user":
                $user = new User($conn);
                $user->getDataByID($_SESSION["id"]);
                break;
            case "admin":
                $admin = new Admin($conn);
                $admin->getDataByID($_SESSION["id"]);
                break;
        }

        require $navbarSwitch[$_SESSION["role"]];
    }
    else
    {
        require "navbar/navbar.php";
    }


    // Get Specific Page by $_GET page
    if (isset($_GET["page"])) {
        switch ($_GET["page"]) {

            case "home":
                // Get Specific Home by Session Role
                if (isLoggedIn()) {
                    require $homeSwitch[$_SESSION["role"]];
                    break;
                }
                require "home/page/home.php";
            break;

            case "login":
                gotoHomeIfLoggedIn();
                require "auth/page/login.php";
            break;

            case "login-admin":
                gotoHomeIfLoggedIn();
                require "auth/page/login-admin.php";
            break;

            case "register":
                gotoHomeIfLoggedIn();
                require "auth/page/register.php";
            break;

            case "search":
                require "user/page/search.php";
            break;

            case "editprofil":
                gotoLoginIfNotLoggedIn();
                require "user/page/editprofil.php";
            break;

            case "beli-tiket":
                gotoLoginIfNotLoggedIn();
                gotoHomeIfAdmin();
                require "user/page/beli-tiket.php";
            break;

            case "pesan-penginapan":
                gotoLoginIfNotLoggedIn();
                gotoHomeIfAdmin();
                require "user/page/pesan-penginapan.php";
            break;

            case "kelola-wisata":
                gotoLoginIfNotLoggedIn();
                switch ($_GET["a1"])
                {
                    case "data-wisata":
                        require "admin/page/kelola-wisata/data-wisata.php";
                    break;

                    case "tambah-wisata":
                        require "admin/page/kelola-wisata/tambah-wisata.php";
                    break;

                    case "edit-wisata":
                        require "admin/page/kelola-wisata/edit-wisata.php";
                    break;
                }
                break;

            case "kelola-penginapan":
                gotoLoginIfNotLoggedIn();
                switch ($_GET["a1"])
                {
                    case "data-penginapan":
                        require "admin/page/kelola-penginapan/data-penginapan.php";
                    break;

                    case "tambah-penginapan":
                        require "admin/page/kelola-penginapan/tambah-penginapan.php";
                    break;

                    case "edit-penginapan":
                        require "admin/page/kelola-penginapan/edit-penginapan.php";
                    break;
                }
            break;

            case "kelola-kamar":
                gotoLoginIfNotLoggedIn();
                switch ($_GET["a1"])
                {
                    case "data-kamar":
                        require "admin/page/kelola-kamar/data-kamar.php";
                    break;

                    case "tambah-kamar":
                        require "admin/page/kelola-kamar/tambah-kamar.php";
                    break;

                    case "edit-kamar":
                        require "admin/page/kelola-kamar/edit-kamar.php";
                    break;
                }
            break;

            case "bayar":
                gotoLoginIfNotLoggedIn();
                require "user/page/bayar.php";
            break;

            case "kirim-bukti-pembayaran":
                gotoLoginIfNotLoggedIn();
                require "user/page/kirim-bukti-pembayaran.php";
            break;

            case "kirim-foto-bukti":
                require "user/page/kirim-foto-bukti.php";
            break;

            case "bukti-pembayaran":
                require "admin/page/bukti-pembayaran/data-bukti.php";
            break;

            case "transaksi-user":
                require "user/page/transaksi.php";
            break;

            case "kelola-metode-pembayaran":
                gotoLoginIfNotLoggedIn();
                switch ($_GET["a1"])
                {
                    case "data-metode":
                        require "admin/page/kelola-metode-pembayaran/data-metode.php";
                    break;

                    case "tambah-metode":
                        require "admin/page/kelola-metode-pembayaran/tambah-metode.php";
                    break;

                    case "edit-metode":
                        require "admin/page/kelola-metode-pembayaran/edit-metode.php";
                    break;
                }
            break;

            default:
                require "public/404.php";
            break;
        }
    }

    if (isset($_GET["process"])) {
        switch ($_GET["process"]) {
            case "login":
                require "auth/process/login.php";
            break;

            case "login-admin":
                require "auth/process/login-admin.php";
            break;

            case "register":
                require "auth/process/register.php";
            break;

            case "logout":
                require "auth/process/logout.php";
            break;

            case "editprofil":
                require "user/process/editprofil.php";
            break;

            case "tambah-wisata":
                require "admin/process/kelola-wisata/tambah-wisata.php"; 
            break;

            case "delete-wisata":
                require "admin/process/kelola-wisata/delete-wisata.php"; 
            break;

            case "edit-wisata":
                require "admin/process/kelola-wisata/edit-wisata.php"; 
            break;

            case "tambah-penginapan":
                require "admin/process/kelola-penginapan/tambah-penginapan.php"; 
            break;

            case "delete-penginapan":
                require "admin/process/kelola-penginapan/delete-penginapan.php"; 
            break;

            case "edit-penginapan":
                require "admin/process/kelola-penginapan/edit-penginapan.php"; 
            break;

            case "tambah-kamar":
                require "admin/process/kelola-kamar/tambah-kamar.php"; 
            break;

            case "delete-kamar":
                require "admin/process/kelola-kamar/delete-kamar.php"; 
            break;

            case "edit-kamar":
                require "admin/process/kelola-kamar/edit-kamar.php"; 
            break;

            case "beli-tiket":
                require "user/process/beli-tiket.php"; 
            break;

            case "pesan-penginapan":
                require "user/process/pesan-penginapan.php"; 
            break;

            case "batal-pembayaran":
                require "user/process/batal-pembayaran.php";
            break;

            case "kirim-foto-bukti":
                require "user/process/kirim-foto-bukti.php";
            break;

            case "terima-bukti-pembayaran":
                require "admin/process/bukti-pembayaran/terima-bukti-pembayaran.php";
            break;

            case "tolak-bukti-pembayaran":
                require "admin/process/bukti-pembayaran/tolak-bukti-pembayaran.php";
            break;

            case "delete-metode":
                require "admin/process/kelola-metode-pembayaran/delete-metode.php";
            break;

            case "tambah-metode":
                require "admin/process/kelola-metode-pembayaran/tambah-metode.php";
            break;

            case "edit-metode":
                require "admin/process/kelola-metode-pembayaran/edit-metode.php";
            break;
        }
    }
    ?>
    <script src="res/js/bootstrap.bundle.js"></script>
</body>

</html>