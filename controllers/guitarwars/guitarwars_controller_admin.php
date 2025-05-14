<?php

require_once(__DIR__ . '/guitarwars_controller_autorize.php');
require(__DIR__ . '../../../models/services/guitarwars_service_select.php');

function guitarwars_controller_admin()
{
    guitarwars_controller_autorize();

    $view_model_result = guitarwars_service_select(null, false, null, 'date', 'DESC');

    return $view_model_result;
}
