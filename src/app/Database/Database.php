<?php

namespace App\Database;

use App\Config\Config;
use PDO;


class Database
{

    /**
     * @var PDO
     */
    protected $db;

    /**
     * @var \App\Config\Holds|null
     */
    protected $host;

    /**
     * @var \App\Config\Holds|null
     */
    protected $dbName;

    /**
     * @var \App\Config\Holds|null
     */
    protected $user;

    /**
     * @var \App\Config\Holds|null
     */
    protected $password;

    /**
     * Database constructor.
     * @param Config $config
     * @throws \Exception
     */
    public function __construct(Config $config)
    {
        $config->load(dirname(dirname(__DIR__)) . '/config/database.php');
        $this->host = $config->get('mysql.host');
        $this->dbName = $config->get('mysql.database');
        $this->user = $config->get('mysql.user');
        $this->password= $config->get('mysql.password');
        try {
            $this->db = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->user, $this->password);
        } catch (\PDOException $e) {
            throw new \Exception('There was an error connecting to the database');
        }
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->db;
    }

    /**
     * @param $query
     * @return bool
     */
    public function query($query)
    {
        $result = $this->getConnection()->prepare($query);
        $result->execute();
        return $result->fetchAll();
    }

}