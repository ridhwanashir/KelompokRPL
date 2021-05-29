<!DOCTYPE html>
<html>
<!-- Pendahuluan : Walkwalk adalah sebuah website traveling, dengan tujuan utama memesan tiket wisata dan penginapan. rujukan DPPL : https://drive.google.com/drive/folders/13Lcfms3R0jNJ-J0TQPAyIMVvjtffnA6N?usp=sharing

file app.php berisi interface untuk setiap halaman  -->
<!-- menginisiasi head dengan title dan stylesheet -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="res/css/bootstrap.min.css" rel="stylesheet">
    <title>WalkWalk</title>
</head>

<body>
    <?php
    session_start(); // membuat sesi sesuai role

    require "connection.php"; 
    require "classes.php";
    require "functions.php";

    $user = null;
    $admin = null;

    $navbarSwitch = [ // menampilkan navbar sesuai role
        "user"=>"navbar/navbar-user.php",
        "admin"=>"navbar/navbar-admin.php"
    ];

    $homeSwitch = [ // menampilkan homepage sesuai role
        "user"=>"home/page/home-user.php",
        "admin"=>"home/page/home-user.php"
    ];


    // Ambil Role 
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


    // Mengambil Specific Interface Page sesuai request $_GET 
    if (isset($_GET["page"])) {
        switch ($_GET["page"]) {

            case "home":
                // Mengambil Specific Home sesuai Session Role
                if (isLoggedIn()) {
                    require $homeSwitch[$_SESSION["role"]];
                    break;
                }
                require "home/page/home.php";
            break;

            case "login":
                gotoHomeIfLoggedIn(); // mengarahkan ke page home jika sudah login
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
                gotoLoginIfNotLoggedIn(); // mengarahkan ke page login jika belum login
                require "user/page/editprofil.php";
            break;

            case "beli-tiket":
                gotoLoginIfNotLoggedIn();
                require "user/page/beli-tiket.php";
            break;

            case "pesan-penginapan":
                gotoLoginIfNotLoggedIn();
                require "user/page/pesan-penginapan.php";
            break;

            case "kelola-wisata":
                gotoLoginIfNotLoggedIn();
                switch ($_GET["a1"])
                {
                    case "data-wisata":
                        require "admin/page/kelola-wisata/data-wisata.php"; // membutuhkan akses page admin
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
        }
    }

    if (isset($_GET["process"])) { // mengambil data process dari setiap halaman yang akan diakses
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
        }
    }
    ?>

    <script src="res/js/bootstrap.bundle.js"></script>
</body>

</html>