<?php

require_once(__DIR__ . '../../file/file_repository_get_absolute_path.php');

function file_repository_delete(?string $file_name, string $path)
{
    if ($file_name == null) {
        return;
    }

    $file = get_absolute_path($path) . DIRECTORY_SEPARATOR . $file_name;

    if ($file != null) {
        unlink($file); //deletes a file
    }
}
