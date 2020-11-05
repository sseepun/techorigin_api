<?php

use \Firebase\JWT\JWT;

function jwtGenerateUserToken($user, $seconds=30*24*60*60){
    $jwtSecretKey = getenv('jwt.secretKey');
    $payload =[
        "id" => $user['id'],
        "role_id" => $user['role_id'],
        "username" => $user['username'],
        "email" => $user['email'],
        "iss" => getenv('app.baseURL'),  // Issuer
        "aud" => getenv('app.baseURL'), // Receiver
        "iat" => time(), // Auth time
        "exp" => time() + $seconds, // Expire
        // "nbf" => time() + $seconds, // Not before
    ];
    return JWT::encode($payload, $jwtSecretKey);
}

function jwtUpdateUserToken($input, $decoded){
    $jwtSecretKey = getenv('jwt.secretKey');
    $payload =[
        "id" => $decoded['id'],
        "role_id" => isset($input['role_id'])? $input['role_id']: $decoded['role_id'],
        "username" => isset($input['username'])? $input['username']: $decoded['username'],
        "email" => isset($input['email'])? $input['email']: $decoded['email'],
        "iss" => $decoded['iss'],
        "aud" => $decoded['aud'],
        "iat" => $decoded['iat'],
        "exp" => $decoded['exp'],
    ];
    return JWT::encode($payload, $jwtSecretKey);
}

function jwtDecodeToken($bearer){
    $jwtSecretKey = getenv('jwt.secretKey');
    list(, $jwt) = explode(' ', $bearer);
    return JWT::decode($jwt, $jwtSecretKey, array('HS256'));
}
