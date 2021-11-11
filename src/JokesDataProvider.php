<?php

namespace Yuana\JokesBapack2Api;

class JokesDataProvider
{
    private $dataPath;
    private $data = [];

    public function __construct($dataPath)
    {
        $this->dataPath = $dataPath . DIRECTORY_SEPARATOR . 'jokes';
        $this->loadData();
    }

    private function loadData()
    {
        $this->data = json_decode(file_get_contents($this->dataPath . DIRECTORY_SEPARATOR . 'text.v1.json'), true);
    }

    public function getAll()
    {
        return $this->data;
    }

    public function getRandom()
    {
        return $this->data[array_rand($this->data)];
    }
}