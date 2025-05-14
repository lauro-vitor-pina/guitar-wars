<?php

function guitarwars_repository_update(
    mysqli $dbc,
    int $id,
    string $date,
    string $name,
    int $score,
    string $screenshot,
    int $approved
) {
    $query =
        "UPDATE `tb_guitarwars` SET 
            `date`='$date',
            `name`='$name',
            `score`= $score,
            `screenshot`='$screenshot',
            `approved`= $approved 
         WHERE `id`= $id
         LIMIT 1";

    mysqli_query($dbc, $query) or die('Update error');
}
