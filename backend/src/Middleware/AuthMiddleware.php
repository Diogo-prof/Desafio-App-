<?php
namespace App\Middleware;
use App\Services\Jwt;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response;


class AuthMiddleware
{
  public function __invoke(Request $req, Handler $handler)
  {
    $auth = $req->getHeaderLine('Authorization');
    if (!preg_match('/Bearer\s+(.*)/', $auth, $m)) {
      $res = new Response(401);
      $res->getBody()->write(json_encode(['error' => 'Missing token']));
      return $res->withHeader('Content-Type', 'application/json');
    }
    try {
      $payload = Jwt::verify($m[1]);
      return $handler->handle($req->withAttribute('auth', $payload));
    } catch (\Throwable $e) {
      $res = new Response(401);
      $res->getBody()->write(json_encode(['error' => 'Invalid token']));
      return $res->withHeader('Content-Type', 'application/json');
    }
  }
}