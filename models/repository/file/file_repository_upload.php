<?php

require_once(__DIR__ . '../../file/file_repository_get_absolute_path.php');

function file_repository_upload(string $file_name, string $file_tmp, string $path): void
{
    $target_directory = DIRECTORY_SEPARATOR . get_absolute_path($path);

    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
    }

    $to = $target_directory . DIRECTORY_SEPARATOR . $file_name;

    $move_result = move_uploaded_file($file_tmp, $to);

    if ($move_result == false) {
        throw new Exception('Error to upload file');
    }
}
