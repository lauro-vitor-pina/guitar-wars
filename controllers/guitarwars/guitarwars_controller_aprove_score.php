<?php
require_once(__DIR__ . '/guitarwars_controller_autorize.php');
require_once(__DIR__ . '../../../models/services/guitarwars_service_aprove_score.php');

function guitarwars_controller_aprove_score()
{
    guitarwars_controller_autorize();

    return guitarwars_service_aprove_score();
}
