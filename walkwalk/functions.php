<?php

function innerJs($code)
{
    return "<script>$code</script>";
}

function jsRedirect($url)
{
    echo innerJs("window.location.replace('$url')");
}

function isLoggedIn()
{
    if (isset($_SESSION["id"]) && isset($_SESSION["role"])) return true;
    return false;
}

function gotoHomeIfLoggedIn()
{
    if (isLoggedIn()) {
        header("location: ?page=home");
        exit;
    }
}

function gotoLoginIfNotLoggedIn()
{
    if (!isLoggedIn()) {
        header("location: ?page=login");
        exit;
    }
}

function gotoHomeIfAdmin()
{
    if (isLoggedIn())
    {
        if ($_SESSION["role"] == "admin")
        {
            header("location: ?page=home");
            exit;
        }
    }
}

function goBackWith($key,$val)
{
    $_SESSION[$key] = $val;
    header("Location: ".$_SERVER['HTTP_REFERER']);
    return;
}

function alertError($class)
{
    
    if (isset($_SESSION["error"])) {
        ?>
        <div class="alert alert-danger <?php echo $class; ?>" role="alert">
            <?php echo $_SESSION["error"]; ?>
        </div>
        <?php
        unset($_SESSION["error"]);
    }
}

function uploadFile($file,$pathfile)
{
    move_uploaded_file($file["tmp_name"],$pathfile);
}