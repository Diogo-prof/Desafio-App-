<?php
use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

return function (App $app) {
    // ✅ Rota de teste
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write("API está a funcionar 🚀");
        return $response;
    });

    // ✅ Login
    $app->post('/login', function (Request $request, Response $response) use ($app) {
        $pdo = $app->getContainer()->get('db');

        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        // Buscar user
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $payload = [
                "sub" => $user['id'],
                "email" => $user['email'],
                "iat" => time(),
                "exp" => time() + (60 * 60) // 1 hora
            ];

            $jwt = JWT::encode($payload, $_ENV['JWT_SECRET'] ?? 'segredo123', 'HS256');

            $response->getBody()->write(json_encode(["token" => $jwt]));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode(["error" => "Credenciais inválidas"]));
        return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
    });

    // ✅ Listar vídeos
    $app->get('/videos', function (Request $request, Response $response) use ($app) {
        $pdo = $app->getContainer()->get('db');

        $stmt = $pdo->query("SELECT id, titulo, url FROM videos");
        $videos = $stmt->fetchAll();

        $response->getBody()->write(json_encode($videos));
        return $response->withHeader('Content-Type', 'application/json');
    });
};
