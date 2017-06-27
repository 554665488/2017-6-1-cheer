<?php
$headers = array(); 
foreach ($_SERVER as $key => $value) { 
    if ('HTTP_' == substr($key, 0, 5)) { 
        $headers[str_replace('_', '-', substr($key, 5))] = $value; 
        // echo "$key: $value\n";
    } 
}
var_dump($headers);