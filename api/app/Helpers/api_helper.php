<?php

function callAPI($method, $url, $data=false){
    $curl = curl_init();
    switch ($method){
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, 1);
            if($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case 'PUT':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            if($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
            break;
        default:
            if($data) $url = sprintf('%s?%s', $url, http_build_query($data));
    }

    // Options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    // Execute
    $result = curl_exec($curl);
    if(!$result) die('API Connection Failure');

    curl_close($curl);
    return json_decode($result, true);
}
