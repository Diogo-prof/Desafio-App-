<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DashboardController {
  
    public function index(Request $request, Response $response) {
        $payload = [
            'total_videos' => 12,
            'total_utilizadores' => 5
        ];
        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
