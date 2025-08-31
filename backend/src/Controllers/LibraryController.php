<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LibraryController {
    private $db;

    public function __construct($container) {
        $this->db = $container->get('db');
    }

    public function listar(Request $request, Response $response) {
        $stmt = $this->db->query("SELECT * FROM biblioteca");
        $dados = $stmt->fetchAll();

        $response->getBody()->write(json_encode($dados));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
