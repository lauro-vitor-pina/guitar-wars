<?php

function guitarwars_repository_delete_screenshot(string $filename): void
{
    if (file_exists($filename)) {
        unlink($filename);
    }
}
