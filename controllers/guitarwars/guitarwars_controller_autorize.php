<?php


function guitarwars_controller_autorize()
{
    if (
        !isset($_SERVER['PHP_AUTH_USER']) ||
        !isset($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] != ADMIN_AUTH_USER ||
        $_SERVER['PHP_AUTH_PW'] != ADMIN_AUTH_PASSWORD
    ) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Guitar Wars"');
        exit('<h2>Gyutar Wars</h2> Sorry, you must enter a valid user name and password.');
    }
}
