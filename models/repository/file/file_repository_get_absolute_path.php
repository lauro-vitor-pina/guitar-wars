<?php 

function get_absolute_path($aux_path) {

    $path = __DIR__  . '/../../../../' . $aux_path;

    $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
    $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
    $absolutes = array();
    foreach ($parts as $part) {
        if ('.' == $part) continue;
        if ('..' == $part) {
            array_pop($absolutes);
        } else {
            $absolutes[] = $part;
        }
    }
    return DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $absolutes);
}