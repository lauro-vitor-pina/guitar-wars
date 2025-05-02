<?php

function guitarwars_repository_delete(mysqli $dbc, int $id): void
{
    $query = "DELETE FROM tb_guitarwars WHERE `id` = $id LIMIT 1";

    mysqli_query($dbc, $query) or die('Delete error');
}
