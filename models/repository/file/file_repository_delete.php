<?php

require_once(__DIR__ . '../../file/file_repository_get_realpath.php');

function file_repository_delete(?string $file_name, string $path)
{
    if ($file_name == null) {
        return;
    }

    $file = file_repository_get_realpath($file_name, $path);

    if ($file != null) {
        unlink($file); //deletes a file
    }
}
