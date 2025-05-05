<?php


if (dbc_repository_is_local_environment()) {
    require_once(__DIR__ . '../../../../config.dev.php');
} else {
    require_once(__DIR__ . '../../../../config.prd.php');
}


function dbc_repository_get_connection()
{
    $dbc = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die('Field to connect Database');

    return $dbc;
}

function dbc_repository_close_connection($dbc)
{
    mysqli_close($dbc);
}


function dbc_repository_is_local_environment()
{
    $host = $_SERVER['SERVER_NAME'] ?? '';

    return in_array($host, ['localhost', '127.0.0.1']);
}
