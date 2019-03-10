<?php
/**
 * Created by PhpStorm.
 * User: Thiago Soares
 * Date: 09/03/2019
 * Time: 22:23
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\model\Cliente;

$app->group('/api/v1', function() {

    // Lista todos os clientes
    $this->get('/clientes', function(Request $request, Response $response) {

        $cliente = new Cliente();
        $result = $cliente->allClientes();

        return $response->withJson($result);
    });

    // Seleciona apenas 1 cliente pelo seu ID
    $this->get('/clientes/{id}', function(Request $request, Response $response, array $args) {
        $cliente_id = $args['id'];

        $cliente = new Cliente();
        $result = $cliente->clientFind($cliente_id);

        return $response->withJson($result);

    });

});

