<?php

function guitarwars_repository_select($dbc)
{
    $query =  'SELECT `id`, `date`, `name`, `score` FROM tb_guitarwars';

    $result_query = mysqli_query($dbc, $query) or die ('query error');

    return $result_query;
}
