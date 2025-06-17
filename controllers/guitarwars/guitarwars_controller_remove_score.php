<?php

require_once(__DIR__ . '../../../models/services/guitarwars_service_delete.php');
require_once(__DIR__ . '/guitarwars_controller_autorize.php');

function guitarwars_controller_remove_score()
{
    guitarwars_controller_autorize();
    
    $view_model_result = builder_view_model_result();

    if (isset($_POST['submit'])) {

        if ($view_model_result['confirm'] == 'No') {
            header('Location: admin.php');
            exit;
        }

        $view_model_result['delete_result'] =  guitarwars_service_delete(
            $view_model_result['id'],
            $view_model_result['screenshot']
        );
    }

    return $view_model_result;
}

function builder_view_model_result()
{
    $view_model_result = [
        'id' => 0,
        'name' => '',
        'date' => null,
        'score' => 0,
        'screenshot' => '',
        'delete_result' => false,
        'confirm' => 'No'
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $view_model_result['id'] = $_GET['id'];
        $view_model_result['name'] = $_GET['name'];
        $view_model_result['date'] = $_GET['date'];
        $view_model_result['score'] = $_GET['score'];
        $view_model_result['screenshot'] = $_GET['screenshot'];
    } else {
        $view_model_result['id'] = $_POST['id'];
        $view_model_result['name'] = $_POST['name'];
        $view_model_result['date'] = $_POST['date'];
        $view_model_result['score'] = $_POST['score'];
        $view_model_result['screenshot'] = $_POST['screenshot'];
        $view_model_result['confirm'] = $_POST['confirm'];
    }

    return $view_model_result;
}
