<?php

require_once(__DIR__ . '../../appvars.php');
require(__DIR__ . '../../models/repository/common/dbc_repository.php');
require(__DIR__ . '../../models/repository/guitarwars/guitarwars_repository_insert.php');

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

    if (empty($view_model['name'])) {
        $view_model['message'] = 'The field name is mandatory.';
        return $view_model;
    }

    if (empty($view_model['score'])) {
        $view_model['message'] = 'The field score is mandatory.';
        return $view_model;
    }

    if (empty($view_model['screenshot'])) {
        $view_model['message'] = 'The field screenshot is mandatory.';
        return $view_model;
    } else {
        echo   $view_model['screenshot'] . '<br/>';
        echo $_FILES['screenshot']['tmp_name'] . '<br/>';
        echo  GW_UPLOAD_PATH . $view_model['screenshot'] . '<br/>';
    }

    $target = GW_UPLOAD_PATH . $view_model['screenshot'];

    $result_move = move_uploaded_file($_FILES['screenshot']['tmp_name'], $target); //move o arquivo da pasta temporária para pasta images

    if (!$result_move) {
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
