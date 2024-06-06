<?php
const DBHOST = "127.0.0.1";
const DBNAME = 'thuan_an';
const DBUSER = 'root';
const DBPASS = "";
const DBCHARSET = 'utf8';
const BASE_URL = "http://localhost/ThuanAn/";

function route($url)
{
    return BASE_URL . $url;
}
function flash($key, $msg, $router)
{
    $_SESSION[$key] = $msg;
    switch ($key) {
        case 'success':
            unset($_SESSION['errors']);
            break;
        case 'errors':
            unset($_SESSION['success']);
            break;

    }
    header('location:' . BASE_URL . $router . '?msg=' . $key);
    die;
}
?>