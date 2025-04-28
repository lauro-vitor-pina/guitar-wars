<?php

require_once(__DIR__ . '../../../../appvars.php');

function guitarwars_repository_save_screenshot($screenshot)
{
    $screenshot_name = $screenshot['name'];

    $screenshot_tmp = $screenshot['tmp_name'];

    $target = __DIR__  . '../../../../' . GW_IMAGE_PATH . $screenshot_name;

    $result_move = move_uploaded_file($screenshot_tmp, $target); //move o arquivo da pasta temporária para pasta images

    return $result_move;
}
