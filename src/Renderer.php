<?php

namespace Yuana\JokesBapack2Api;

class Renderer
{
    public function renderJson($response)
    {
        header('content-type: application/json');
        // if (array_key_exists('code', $response) && array_key_exists('msg', $response)) {
            // header("HTTP/1.1 {$response['code']} {$response['msg']}"); 
        // }
        echo json_encode($response, JSON_NUMERIC_CHECK);
    }
}