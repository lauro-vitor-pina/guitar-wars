<?php

require_once(__DIR__ . '../../models/services/guitarwars_service_delete_oldest_score.php');


//each five minutes
//*/5 * * * *
function guitarwars_cronjob_delete_oldest_score()
{
    guitarwars_service_delete_oldest_score();
}

guitarwars_cronjob_delete_oldest_score();
