<?php


function guitarwars_repository_insert($dbc, $name, $score, $screenshot)
{
    $query =
        'INSERT INTO tb_guitarwars (`date`,`name`, `score`, `screenshot`) ' .
        "VALUES (NOW(), '$name', $score, '$screenshot') ";

    mysqli_query($dbc, $query) or die('insert error');
}
