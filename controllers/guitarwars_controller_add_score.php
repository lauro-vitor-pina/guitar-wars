<?php

require(__DIR__ . '../../models/repository/common/dbc_repository.php');
require(__DIR__ . '../../models/repository/guitarwars/guitarwars_repository_insert.php');

function guitarwars_controller_add_score()
{
    $result_view_model = [
        'message' => '',
        'name' => '',
        'score' =>  0,
        'result_insert' => false,
    ];

    if (!isset($_POST['submit'])) {
        return $result_view_model;
    }

    $result_view_model['name'] = trim($_POST['name']);

    $result_view_model['score'] = trim($_POST['score']);

    if (empty($result_view_model['name'])) {
        $result_view_model['message'] = 'The field name is mandatory.';
        return $result_view_model;
    }

    if (empty($result_view_model['score'])) {
        $result_view_model['message'] = 'The field score is mandatory.';
        return $result_view_model;
    }

    $dbc = dbc_repository_get_connection();

    guitarwars_repository_insert($dbc, $result_view_model['name'], $result_view_model['score']);

    dbc_repository_close_connection($dbc);

    $result_view_model['result_insert'] = true;

    return $result_view_model;
}
