<?php
/**
 * Created by PhpStorm.
 * User: Thiago Soares
 * Date: 09/03/2019
 * Time: 22:29
 */

namespace app\model;
use config\Connect;
use PDO;

class Cliente {

    private function abreConexao() {
        $conn = new Connect();
        return $conn;
    }

    public function allClientes() {

        $conn = $this->abreConexao();
        $sql = "SELECT * FROM tb_cliente";
        return $conn->all($sql);
    }

    public function clientFind($cliente_id) {

        $conn = $this->abreConexao();
        $sql = "SELECt * FROM tb_cliente WHERE cl_id = :id";

        return $conn->all($sql, array(
            ':id' => $cliente_id
        ));
    }
}