<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController {
    private $db;

    public function __construct($container) {
        $this->db = $container->get('db');
    }

    public function login(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND password = MD5(?)");
        $stmt->execute([$email, $password]);
        $user = $stmt->fetch();

        if ($user) {
            $payload = ['message' => 'Login efetuado com sucesso', 'user' => $user['name']];
        } else {
            $payload = ['error' => 'Credenciais inválidas'];
        }

        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
