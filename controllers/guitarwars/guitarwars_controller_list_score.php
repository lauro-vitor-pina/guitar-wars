<?php

require(__DIR__ . '../../../models/services/guitarwars_service_select.php');

function guitarwars_controller_list_score()
{
    $view_model_result = guitarwars_service_select(null, true, null, 'score', 'DESC');

    return $view_model_result;
}
