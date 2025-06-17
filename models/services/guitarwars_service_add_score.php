<?php

require(__DIR__ . '../../repository/common/dbc_repository.php');
require(__DIR__ . '../../repository/guitarwars/guitarwars_repository_insert.php');
require(__DIR__ . '../../repository/file/file_repository_upload.php');
require(__DIR__ . '../../repository/file/file_repository_delete.php');
require(__DIR__ . '../../validator/captcha_validator.php');

function guitarwars_service_add_score(): array
{
    $view_model = [
        'message' => '',
        'name' =>  '',
        'score' =>  '',
        'screenshot' => null,
        'screenshot_name' =>  '',
        'insert_result' => false
    ];

    if (!isset($_POST['submit'])) {
        return $view_model;
    }

    $dbc = dbc_repository_get_connection();

    $name =  mysqli_real_escape_string($dbc, trim($_POST['name']));
    $score = mysqli_real_escape_string($dbc, trim($_POST['score']));
    $screenshot = isset($_FILES['screenshot']) ? $_FILES['screenshot'] : null;
    $screenshot_name = mysqli_real_escape_string($dbc, trim(date('d-m-Y-H-i-s-') . $_FILES['screenshot']['name']));
    $screenshot_tmp =  trim($_FILES['screenshot']['tmp_name']);
    $screenshot_size = trim($_FILES['screenshot']['size']);
    $screenshot_type =  trim($_FILES['screenshot']['type']);
    $verify = mysqli_real_escape_string($dbc, trim($_POST['verify']));

    try {

        $view_model['name'] = $name;
        $view_model['score'] = $score;
        $view_model['screenshot'] = $screenshot;
        $view_model['screenshot_name'] = $screenshot_name;

        validate_add_score(
            $name,
            $score,
            $screenshot_type,
            $screenshot_size,
            $verify
        );

        file_repository_upload(
            $screenshot_name,
            $screenshot_tmp,
            GW_IMAGE_PATH
        );

        guitarwars_repository_insert(
            $dbc,
            $name,
            $screenshot_name,
            $score
        );

        $view_model['insert_result'] = true;
        
    } catch (Exception $ex) {

        file_repository_delete($screenshot_tmp, GW_IMAGE_PATH);

        $view_model['message'] = $ex->getMessage();

        $view_model['insert_result'] = false;
    } finally {

        dbc_repository_close_connection($dbc);
    }

    return $view_model;
}

function validate_add_score(string $name, string $score, string $screenshot_type, int $screenshot_size, string $verify): void
{

    if (empty($name)) {
        throw new Exception('The field name is mandatory.');
    }

    if (empty($score)) {
        throw new Exception('The field score is mandatory.');
    }

    if (!is_numeric($score)) {
        throw new Exception('Score must be a numeric');
    }

    if ($score <= 0) {
        throw new Exception('Score must be a positive number.');
    }

    if ($screenshot_size <= 0) {
        throw new Exception('The field screenshot is mandatory.');
    }

    if (!validate_type_image($screenshot_type)) {
        throw new Exception('The screen shot must be gif, jpeg or png');
    }

    if ($screenshot_size > GW_MAXFILESIZE) {
        throw new Exception('The screen shot file cant be greater than ' . (GW_MAXFILESIZE / 1024) . 'KB');
    }

    if(!captcha_validator($verify)){
        throw new Exception('Please enter the verification pass-phrase exactly as shown');
    }
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
