<?php

require(__DIR__ . '../../../models/services/guitarwars_service_add_score.php');

function guitarwars_controller_add_score(): array
{
    $name =  isset($_POST['name']) ? trim($_POST['name']) : '';
    $score =   isset($_POST['score']) ? trim($_POST['score']) : 0;
    $screenshot = isset($_FILES['screenshot']) ? $_FILES['screenshot'] : null;
    $screenshot_name = isset($_FILES['screenshot']['name']) ? date('d-m-Y-H-i-s-') . $_FILES['screenshot']['name'] : '';
    $screenshot_tmp =  isset($_FILES['screenshot']['tmp_name']) ?  $_FILES['screenshot']['tmp_name'] : '';
    $screenshot_size = isset($_FILES['screenshot']['size']) ?  $_FILES['screenshot']['size'] : 0;
    $screenshot_type = isset($_FILES['screenshot']['type']) ? $_FILES['screenshot']['type'] : '';

    $view_model = [
        'message' => '',
        'name' =>  $name,
        'score' =>  $score,
        'screenshot' => $screenshot,
        'screenshot_name' =>  $screenshot_name,
        'insert_result' => false
    ];

    if (!isset($_POST['submit'])) {
        return $view_model;
    }

    $add_score_result = guitarwars_service_add_score(
        $name,
        $score,
        $screenshot_name,
        $screenshot_tmp,
        $screenshot_type,
        $screenshot_size
    );

    $view_model['message'] = $add_score_result;

    $view_model['insert_result'] = is_null($add_score_result);

    return $view_model;
}
