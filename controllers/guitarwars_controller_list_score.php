<?php

require(__DIR__ . '../../models/repository/common/dbc_repository.php');
require(__DIR__ . '../../models/repository/guitarwars/guitarwars_repository_select.php');

function guitarwars_controller_list_score()
{
    $result_view_model = [
        'result_select' => null
    ];

    $dbc = dbc_repository_get_connection();

    $result_view_model['result_select'] = guitarwars_repository_select($dbc);

    dbc_repository_close_connection($dbc);

    return $result_view_model;
}
