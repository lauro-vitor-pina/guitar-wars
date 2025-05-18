<?php

require(__DIR__ . '../../../models/services/guitarwars_service_add_score.php');

function guitarwars_controller_add_score(): array
{
    return guitarwars_service_add_score();
}
