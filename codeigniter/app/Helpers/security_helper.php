<?php

// Security
function ssEncrypt($string){
    $method = 'AES-128-ECB';
    $key = 'ILoveFamily123!';
    return base64_encode(openssl_encrypt($string, $method, $key));
}
function ssDecrypt($string){
    $method = 'AES-128-ECB';
    $key = 'ILoveFamily123!';
    return openssl_decrypt(base64_decode($string), $method, $key, 0, '');
}
