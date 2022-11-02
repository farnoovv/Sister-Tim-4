<?php

use App\Models\ModelAdmin;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($adminheader){
    if(is_null($adminheader)){
        throw new Exception("Authentication Failed!!");
    }
    return explode(' ', $adminheader)[1];
}

function validateJWT($encodedToken){
    $key = getenv("JWT_SECRET_KEY");
    // $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
    $modelAdmin = new ModelAdmin();

    $modelAdmin->getEmail($decodedToken->email);
}

function createJWT($email){
    $requestTime = time();
    $tokenTime = getenv("JWT_TIME_TO_LIVE");
    $expiredTime = $requestTime + $tokenTime;
    $payload = [
        'email' => $email,
        'iat'   =>  $requestTime,
        'exp'   =>  $expiredTime
    ];
    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
    return $jwt;
}