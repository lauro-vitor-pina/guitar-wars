<?php


function guitarwars_repository_insert($dbc, $name, $score)
{
    $query =
        'INSERT INTO tb_guitarwars (`date`,`name`, `score`) ' .
        "VALUES (NOW(), '$name', $score) ";

    mysqli_query($dbc, $query) or die('insert error');
}
