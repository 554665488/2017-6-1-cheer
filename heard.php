<?php
$headers = array(); 
foreach ($_SERVER as $key => $value) { 
    if ('HTTP_' == substr($key, 0, 5)) { 
        $headers[str_replace('_', '-', substr($key, 5))] = $value; 
        // echo "$key: $value\n";
    } 
}

 // 获取AUTHORIZATION header
        if (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $header['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST'];
            $value = $_SERVER['PHP_AUTH_DIGEST'];
            echo "AUTHORIZATION: $value\n";
        } elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            $header['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
            $value = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
            echo "AUTHORIZATION: $value\n";
        }
        // 获取CONTENT-LENGTH header
        if (isset($_SERVER['CONTENT_LENGTH'])) {
            $header['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH'];
            $value = $_SERVER['CONTENT_LENGTH'];
            echo "CONTENT-LENGTH: $value\n";
        }
        // 获取CONTENT-TYPE header
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $header['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE'];
            $value = $_SERVER['CONTENT_TYPE'];
            echo "CONTENT-TYPE: $value\n";
        }


var_dump($headers);