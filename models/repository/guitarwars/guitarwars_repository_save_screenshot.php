<?php

require_once(__DIR__ . '../../../../appvars.php');

function guitarwars_repository_save_screenshot($command_view_model)
{
    $target = __DIR__  . '../../../../' . GW_IMAGE_PATH .$command_view_model['screenshot'];

    $result_move = move_uploaded_file($command_view_model['screenshot_tmp_name'], $target);

    return $result_move;
}
