<?php

//returns the real path of an image
function file_repository_get_realpath(string $file_name, string $path): ?string
{
    $virtual_path = __DIR__ . '../../../../../' . $path . $file_name;

    $realpath = realpath($virtual_path);

    if (empty($realpath)) {
        return null;
    }

    return $realpath;
}
