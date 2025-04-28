<?php


function guitarwars_repository_insert($dbc, $command_view_model)
{
    $name = $command_view_model['name'];
    $score = (int)$command_view_model['score'];
    $screenshot = $command_view_model['screenshot'];

    $query = "INSERT INTO tb_guitarwars (`date`, `name`, `score`, `screenshot`) " .
        "VALUES (NOW(), '$name', $score, '$screenshot')";

    mysqli_query($dbc, $query) or die('insert error');
}
