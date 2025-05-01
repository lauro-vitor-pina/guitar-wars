<?php

require(__DIR__ . '../../repository/common/dbc_repository.php');
require(__DIR__ . '../../repository/guitarwars/guitarwars_repository_insert.php');
require(__DIR__ . '../../repository/guitarwars/guitarwars_repository_upload_screenshot.php');

function guitarwars_service_add_score(
    string $name,
    int $score,
    string $screenshot_name,
    string $screenshot_tmp,
    string $screenshot_type,
    string $screenshot_size
): ?string {

    $validation_result = validate_add_score(
        $name,
        $score,
        $screenshot_type,
        $screenshot_size
    );

    if ($validation_result != null) {

        delete_temporary_file($screenshot_tmp);

        return $validation_result;
    }

    $upload_result = guitarwars_repository_upload_screenshot(
        $screenshot_name,
        $screenshot_tmp
    );

    if (!$upload_result) {

        delete_temporary_file($screenshot_tmp);

        return 'Error to upload file';
    }

    $dbc = dbc_repository_get_connection();

    guitarwars_repository_insert(
        $dbc,
        $name,
        $screenshot_name,
        $score
    );

    dbc_repository_close_connection($dbc);

    return null;
}

function validate_add_score(
    string $name,
    int $score,
    string $screenshot_type,
    int $screenshot_size
): ?string {

    if (empty($name)) {
        return 'The field name is mandatory.';
    }

    if (empty($score)) {
        return 'The field score is mandatory.';
    }

    if ($screenshot_size <= 0) {
        return 'The field screenshot is mandatory.';
    }

    if (!validate_type_image($screenshot_type)) {
        return 'The screen shot must be gif, jpeg or png';
    }

    if ($screenshot_size > GW_MAXFILESIZE) {
        return 'The screen shot file cant be greater than ' . (GW_MAXFILESIZE / 1024) . 'KB';
    }

    return null;
}

function validate_type_image(string $screenshot_type): bool
{
    $type_mime_images = [
        'image/gif',
        'image/jpeg',
        'image/pjpeg',
        'image/png'
    ];

    foreach ($type_mime_images as $type_mime_item) {

        if ($screenshot_type == $type_mime_item) {
            return true;
        }
    }

    return false;
}

function delete_temporary_file(string $screenshot_tmp): void
{
    if (file_exists($screenshot_tmp)) {
        unlink($screenshot_tmp);
    }
}
