<?php

namespace App\Config;

class Config
{

    /**
     * @var Holds $config data
     */
    protected $config;

    /**
     * @var
     */
    protected  $default;

    /**
     * Loads config from file
     *
     * @param $file
     */
    public function load($file)
    {
        $this->config = require $file;
    }

    /**
     * Takes in params and foreach's through the config array to get the value e.g mysql.host
     *
     * @param $key
     * @param null $default
     * @return array|null
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
