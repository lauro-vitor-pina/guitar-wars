<?php

require_once(__DIR__ . '../../repository/common/dbc_repository.php');
require_once(__DIR__ . '../../repository/guitarwars/guitarwars_repository_select.php');
require_once(__DIR__ . '../../repository/guitarwars/guitarwars_repository_delete.php');
require_once(__DIR__ . '../../repository/guitarwars_log/guitarwars_log_repository_insert.php');
require_once(__DIR__ . '../../repository/file/file_repository_delete.php');
require_once(__DIR__ . '../../../appvars.php');

function guitarwars_service_delete_oldest_score()
{
    $dbc = dbc_repository_get_connection();

    $select_result  = guitarwars_repository_select($dbc, 1, 'date', 'ASC');

    while ($row = mysqli_fetch_array($select_result)) {

        $message = 'This score has been deleted for cron job at ' . date('d/m/Y H:i:s');

        file_repository_delete($row['screenshot'], GW_IMAGE_PATH);

        guitarwars_repository_delete($dbc, $row['id'], $row['screenshot']);

        guitarwars_log_repository_insert($dbc, $row['id'], $row['date'], $row['name'], $row['score'], $row['screenshot'], $message);
    }

    dbc_repository_get_connection($dbc);
}
