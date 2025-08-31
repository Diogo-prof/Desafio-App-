<?php
use Slim\Factory\AppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

// Criar container do PHP-DI
$container = new Container();

// Configuração da Base de Dados
$host = $_ENV['DB_HOST'] ?? 'db';
$db   = $_ENV['DB_DATABASE'] ?? 'app_videos';
$user = $_ENV['DB_USERNAME'] ?? 'root';
$pass = $_ENV['DB_PASSWORD'] ?? 'rootpass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (\PDOException $e) {
    die('Erro ao ligar à base de dados: ' . $e->getMessage());
}

// Guardar o PDO dentro do container
$container->set('db', $pdo);

// Ligar o container ao Slim
AppFactory::setContainer($container);

// Criar app
$app = AppFactory::create();

// Carregar rotas
(require __DIR__ . '/routes.php')($app);

return $app;
