<?php

function guitarwars_repository_delete(mysqli $dbc, int $id, ?string $screenshot): void
{
    if (!empty($screenshot)) {

        $filename = __DIR__ . '/../../' . GW_IMAGE_PATH . $screenshot;

        guitarwars_repository_delete_screenshot($filename);
    }

    $query = "DELETE FROM tb_guitarwars WHERE `id` = $id LIMIT 1";

    mysqli_query($dbc, $query) or die('Delete error');
}
