<?php

require(__DIR__ . '../../repository/common/dbc_repository.php');
require(__DIR__ . '../../repository/guitarwars/guitarwars_repository_select.php');

function guitarwars_service_select()
{
    $result_view_model = [
        'select_result' => null
    ];

    $dbc = dbc_repository_get_connection();

    $result_view_model['select_result'] = guitarwars_repository_select($dbc);

    dbc_repository_close_connection($dbc);

    return $result_view_model;
}
