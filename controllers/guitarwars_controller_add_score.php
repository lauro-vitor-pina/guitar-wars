<?php

require(__DIR__ . '../../models/repository/common/dbc_repository.php');
require(__DIR__ . '../../models/repository/guitarwars/guitarwars_repository_insert.php');
require(__DIR__ . '../../models/repository/guitarwars/guitarwars_repository_save_screenshot.php');

function guitarwars_controller_add_score()
{
    $view_model = [
        'message' => '',
        'name' => '',
        'score' =>  0,
        'screenshot' => '',
        'result_insert' => false,
    ];

    if (!isset($_POST['submit'])) {
        return $view_model;
    }

    $view_model['name'] = trim($_POST['name']);

    $view_model['score'] = trim($_POST['score']);

    $view_model['screenshot'] =  $_FILES['screenshot']['name']; //obtem o nome do arquivo

    $view_model['message'] = guitarwars_controller_validate_form($view_model);

    if ($view_model['message'] != null) {
        return $view_model;
    }

    $result_save_screenshot = guitarwars_repository_save_screenshot($_FILES['screenshot']);

    if (!$result_save_screenshot) {

        $view_model['message'] = 'Can not move the file uploaded!';

        return $view_model;
    }

    $dbc = dbc_repository_get_connection();

    guitarwars_repository_insert(
        $dbc,
        $view_model['name'],
        $view_model['score'],
        $view_model['screenshot']
    );

    dbc_repository_close_connection($dbc);

    $view_model['result_insert'] = true;

    return $view_model;
}

function guitarwars_controller_validate_form($view_model)
{
    if (empty($view_model['name'])) {
        return 'The field name is mandatory.';
    }

    if (empty($view_model['score'])) {
        return 'The field score is mandatory.';
    }

    if (empty($view_model['screenshot'])) {
        return 'The field screenshot is mandatory.';
    }

    return null;
}
