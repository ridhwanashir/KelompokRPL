<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="res/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();

    require "connection.php";
    require "classes.php";

    $db = new DB($conn);

    $user = null;
    $admin = null;

    // Get Specific Navar by Session Role
    if (isset($_SESSION["id"])) {
        switch ($_SESSION["role"]) {
            case "user";
                $user = $db->getUserByID($_SESSION["id"]);
                require "navbar/navbar-user.php";
                break;
            case "admin";
                $user = $db->getAdminByID($_SESSION["id"]);
                require "navbar/navbar-admin.php";
                break;
        }
    }else{
        require "navbar/navbar.php";
    }

    // Get Specific Page by $_GET page
    if (isset($_GET["page"])) {
        switch ($_GET["page"]) {

            case "home":
                // Get Specific Home by Session Role
                if (isset($_SESSION["id"])) {
                    switch ($_SESSION["role"]) {
                        case "user";
                            require "home/page/home-user.php";
                            break;
                        case "admin";
                            require "home/page/home-user.php";
                            break;
                    }
                    break;
                }
                require "home/page/home.php";
                break;

            case "login":
                if (isset($_SESSION["id"])) {
                    header("location: ?page=home");
                }
                require "auth/page/login.php";
                break;

            case "login-admin":
                if (isset($_SESSION["id"])) {
                    header("location: ?page=home");
                }
                require "auth/page/login-admin.php";
                break;

            case "register":
                if (isset($_SESSION["id"])) {
                    header("location: ?page=home");
                }
                require "auth/page/register.php";
                break;

            case "editprofil":
                require "user/page/editprofil.php";
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
        }
    }
    ?>

    <script src="res/js/bootstrap.bundle.js"></script>
</body>

</html>