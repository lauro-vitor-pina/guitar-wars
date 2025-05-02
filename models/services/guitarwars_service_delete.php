<?php

require_once(__DIR__ . '../../repository/common/dbc_repository.php');
require_once(__DIR__ . '../../repository/guitarwars/guitarwars_repository_delete.php');

function guitarwars_service_delete(int $id, string $screenshot): bool
{
    $dbc = dbc_repository_get_connection();

    guitarwars_repository_delete($dbc, $id, $screenshot);

    dbc_repository_close_connection($dbc);

    return true;
}
