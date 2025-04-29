<?php

require_once(__DIR__ . '../../../../appvars.php');

function guitarwars_repository_save_screenshot($command_view_model)
{
    $target_directory = __DIR__  . '../../../../' . GW_IMAGE_PATH;

    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
    }

    $to = $target_directory . $command_view_model['screenshot'];

    $result_move = move_uploaded_file($command_view_model['screenshot_tmp_name'], $to);

    return $result_move;
}
