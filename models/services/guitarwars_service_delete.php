<?php

require_once(__DIR__ . '../../../appvars.php');
require_once(__DIR__ . '../../repository/common/dbc_repository.php');
require_once(__DIR__ . '../../repository/guitarwars/guitarwars_repository_delete.php');
require_once(__DIR__ . '../../repository/guitarwars/guitarwars_repository_delete_screenshot.php');

function guitarwars_service_delete(int $id, string $screenshot): bool
{
    if (!empty($screenshot)) {

        $filename = __DIR__ . '/../../' . GW_IMAGE_PATH . $screenshot;

        guitarwars_repository_delete_screenshot($filename);
    }

    $dbc = dbc_repository_get_connection();

    guitarwars_repository_delete($dbc, $id);

    dbc_repository_close_connection($dbc);

    return true;
}
