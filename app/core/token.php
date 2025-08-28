<?php

class Token
{
    public static function validar(string $token): ?array
    {
        $tokenPartes = explode('.', $token, 3);

        list($header, $payload, $signe) = $tokenPartes;

        $key = base64_decode($_ENV['CRYPTO_KEY']);

        $signeNovo = hash_hmac('sha256', "$header.$payload", $key);

        if(!hash_equals($signeNovo, $signe)){
            return null;
        }

        $payloadNormal = self::base64Url_decode($payload);

        if(time() > $payloadNormal['exp']){
            return null;
        }

        return $payloadNormal;
    }

    private static function base64Url_decode(string $base64): array
    {
        $normal = strtr($base64, '-_', '+/');

        $sobra = strlen($base64) % 4;

        match($sobra){
            3 => $normal .= '=',
            2 => $normal .= '==',
            default => null
        };

        $normal = base64_decode($normal);

        return json_decode($normal, true);
    }
}