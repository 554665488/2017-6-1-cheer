<?php
function __autoload($class_name) {

    // $path = str_replace('_', DIRECTORY_SEPARATOR, $class_name);

    require_once './plugin/'.$class_name.'.php';

}