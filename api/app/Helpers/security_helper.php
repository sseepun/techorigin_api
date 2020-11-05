<?php

function ssEncrypt($string, $prefix=''){
    $method = 'AES-128-ECB';
    $key = 'ILoveFamily123!';
    $result = base64_encode(openssl_encrypt($prefix.$string, $method, $key));
    return $result;
}

function ssDecrypt($string, $prefix=''){
    $method = 'AES-128-ECB';
    $key = 'ILoveFamily123!';
    $result = openssl_decrypt(base64_decode($string), $method, $key, 0, '');
    return str_replace($prefix, '', $result);
}

function randomAlphanum($size){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for($i=0; $i<$size; $i++){
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
