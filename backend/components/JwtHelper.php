<?php

namespace app\components;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    private static $key;

    public static function init()
    {
        self::$key = $_ENV['JWT_SECRET'] ?? false;
        if (self::$key === false) {
            throw new \Exception('JWT_SECRET not found in .env file');
        }
    }

    public static function generateToken($payload): string
    {
        return JWT::encode($payload, self::$key, 'HS256');
    }

    public static function validateToken($token) {
        try{
            return JWT::decode($token, new Key(self::$key, 'HS256'));
        } catch (\Exception $e) {
            return false;
        }
    }
}