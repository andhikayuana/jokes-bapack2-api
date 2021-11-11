<?php

namespace Yuana\JokesBapack2Api;

class Controller
{
    public static $msg = [
        200 => 'Success',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error'
    ];

    public function notFound()
    {
        return $this->response(404);
    }

    public function methodNotAllowed()
    {
        return $this->response(405);
    }

    public function response($code = 200, $data = [], $structureDisabled = false)
    {
        return $structureDisabled ? $data : [
            'code' => $code,
            'msg'  => $this->getMsg($code),
            'data' => $data
        ];
        
    }

    public function getMsg($code = 200)
    {
        return self::$msg[$code];
    }

    private $jokesDataProvider;


    public function __construct($jokesDataProvider)
    {
        $this->jokesDataProvider = $jokesDataProvider;
    }

    public function index()
    {
        return $this->response(200, [
            'name' => 'Jokes Bapack2 API',
            'version' => '1.0.0',
            'author' => [
                'name' => 'andhikayuana',
                'email' => 'andhika@yuana.id'
            ],
            'endpoints' => [
                '/v1/text' => 'get all text jokes',
                '/v1/text/random' => 'get text jokes randomly'
            ]
        ], true);
    }

    public function getAll()
    {
        return $this->response(200, $this->jokesDataProvider->getAll());
    }

    public function getRandom()
    {
        return $this->response(200, $this->jokesDataProvider->getRandom());
    }
}