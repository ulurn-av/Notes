<?php

namespace app\components;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    private static $key = '5z1fSnM/CedkcvMpTM4do7nfwdt1TQBofNUOoYe5ALE=';

    public static function generateToken($payload) {
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