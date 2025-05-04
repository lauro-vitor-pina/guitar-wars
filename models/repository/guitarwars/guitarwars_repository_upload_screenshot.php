<?php

require_once(__DIR__ . '../../../../appvars.php');

function guitarwars_repository_upload_screenshot(string $screenshot_name, string $screenshot_tmp)
{
    $target_directory = __DIR__  . '../../../../../' . GW_IMAGE_PATH;

    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
    }

    $to = $target_directory . $screenshot_name;

    $move_result = move_uploaded_file($screenshot_tmp, $to);

    return $move_result;
}
