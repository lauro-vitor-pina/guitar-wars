<?php

function guitarwars_repository_select(
    mysqli $dbc,
    ?int $id,
    bool $only_approved,
    ?int $limit,
    ?string $sort_prop,
    ?string $sort_direction
): array {
    $query =  'SELECT `id`, `date`, `name`, `score`, `screenshot`, `approved` 
               FROM tb_guitarwars
               WHERE 1 = 1 ';

    if ($id != null) {
        $query = $query . " AND id = $id ";
    }

    if ($only_approved) {
        $query = $query . " AND approved = 1 ";
    }

    if ($sort_prop != null && $sort_direction != null) {

        $query = $query . " ORDER BY `$sort_prop` $sort_direction ";
    }

    if ($limit != null) {
        $query = $query . " LIMIT $limit ";
    }


    $result_query = mysqli_query($dbc, $query) or die('query error');


    $rows = [];

    while ($row = mysqli_fetch_array($result_query)) {
        $rows[] = $row;
    }

    return $rows;
}
