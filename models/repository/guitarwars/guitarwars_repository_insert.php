<?php



function guitarwars_repository_insert(
    mysqli $dbc,
    string $name,
    string $screenshot_name,
    int $score
) {
    $query = "INSERT INTO tb_guitarwars (`date`, `name`, `score`, `screenshot`, `approved`) " .
        "VALUES (NOW(), '$name', $score, '$screenshot_name', 0)";

    mysqli_query($dbc, $query) or die('insert error');
}
