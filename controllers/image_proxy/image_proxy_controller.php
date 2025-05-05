<?php

require_once(__DIR__ . '../../../appvars.php');
require_once(__DIR__ . '../../../models/repository/file/file_repository_upload.php');

$file_name = $_GET['file_name'] ?? '';

$realpath = '';

try {
    //Returns the canonicalized absolute pathname on success. 
    //The resulting path will have no symbolic link, /./ or /../ components. 
    //Trailing delimiters, such as \ and /, are also removed.

    $realpath = get_absolute_path(GW_IMAGE_PATH) . DIRECTORY_SEPARATOR . $file_name;
} catch (Exception $ex) {

    http_response_code(404);
    echo 'Exception  = ' . $ex->getMessage() . '<br/>';
    exit;
}

//Returns the content type in MIME format, like text/plain or application/octet-stream, or false on failure
$mime = mime_content_type($realpath);


header("Content-Type: $mime", true, 200);

//Clean (erase) the contents of the active output buffer
ob_clean();

//Flushes the system write buffers of PHP and the backend used by PHP (e.g.: CGI, a web server).
//In a command line environment flush() will attempt to flush the contents of the buffers 
//only whereas in a web context headers and the contents of the buffers are flushed.
flush();

//Reads a file and writes it to the output buffer.
readfile($realpath);

exit;


//note:
//For anyone having the problem of your html page being outputted in the downloaded file: 
//call the functions ob_clean() and flush() before readfile()
