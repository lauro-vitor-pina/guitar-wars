<?php

function guitarwars_repository_select(mysqli $dbc, ?int $limit, ?string $sort_prop,  ?string $sort_direction)
{
    $query =  'SELECT `id`, `date`, `name`, `score`, `screenshot` 
               FROM tb_guitarwars';

    if ($sort_prop != null && $sort_direction != null) {

        $query = $query . " ORDER BY `$sort_prop` $sort_direction ";
    }

    if ($limit != null) {
        $query = $query . " LIMIT $limit ";
    }

    $result_query = mysqli_query($dbc, $query) or die('query error');

    return $result_query;
}
