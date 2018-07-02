<?php

namespace App\Config;

class Config
{

    /**
     * @var Holds $config data
     */
    protected $config;

    protected  $default;
    /**
     * @param $file
     */
    public function load($file)
    {
        $this->config = require $file;
    }


    /**
     * @param $key
     * @param null $dafault
     */
    public function get($key, $default = null)
    {
        $this->default = $default;
        $segments = explode('.', $key);
        $data = $this->config;
        foreach ($segments as $segment) {
            if (isset($data[$segment])) {
                $data = $data[$segment];
            } else {
                $data = $this->default;
            }
        }
        return $data;
    }
}