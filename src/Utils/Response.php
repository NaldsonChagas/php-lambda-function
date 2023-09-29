<?php

namespace ReverseGeocode\SaveFile\Utils;

class Response
{
    public static function apiResponse($body, $statusCode = 200): string
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'Content-Type',
            'Access-Control-Allow-Methods' => 'OPTIONS,POST,GET'
        ];

        return json_encode([
            'statusCode' => $statusCode,
            'headers' => $headers,
            'body' => ['message' => $body]
        ]);
    }
}
