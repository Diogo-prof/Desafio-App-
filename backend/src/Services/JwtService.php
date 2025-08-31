<?php
namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    public static function make(array $payload, int $ttlMinutes = 120): string
    {
        $now = time();
        $payload = array_merge($payload, [
            'iat' => $now,
            'exp' => $now + ($ttlMinutes * 60),
            'iss' => 'app-api'
        ]);

        return JWT::encode($payload, getenv('APP_KEY'), 'HS256');
    }

    public static function verify(string $token): array
    {
        return (array) JWT::decode($token, new Key(getenv('APP_KEY'), 'HS256'));
    }
}
