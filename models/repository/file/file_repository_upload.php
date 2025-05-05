<?php

function file_repository_upload(string $file_name, string $file_tmp, string $path)
{
    $target_directory = __DIR__  . '../../../../../' . $path;

    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
    }

    $to = $target_directory . $file_name;

    $move_result = move_uploaded_file($file_tmp, $to);

    return $move_result;
}
