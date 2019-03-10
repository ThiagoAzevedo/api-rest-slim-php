<?php

namespace config;
use PDO;
require '../vendor/autoload.php';

class Connect extends ConfigSistema {

    private $host;
    private $user;
    private $pass;
    private $base;

    public function __construct() {

//        var_dump(ConfigSistema::HOST);

        $this->host = ConfigSistema::HOST;
        $this->user = ConfigSistema::USER;
        $this->pass = ConfigSistema::PASS;
        $this->base = ConfigSistema::BASE;
    }

    private function connectBase() {

        try {

            $pdo = new \PDO("mysql:host={$this->host};dbname={$this->base}", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

            return $pdo;
        } catch(PDOException $e) {
            exit('Falha no acesso ao banco de dados ' . $e->getMessage());
        }
    }

    private function getParams($stmt, $params) {
        foreach($params as $key => $value) {
            $this->getParam($stmt, $key, $value);
        }
    }

    private function getParam($stmt, $key, $value) {
        $stmt->bindValue($key, $value);
    }


    public function all($sql, $params = array()) {

        $conn = $this->connectBase();

        $stmt = $conn->prepare($sql);

        $this->getParams($stmt, $params);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
