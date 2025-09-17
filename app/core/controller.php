<?php

class Controller
{
    public function render(string $view, array $dados = []): void
    {
        extract($dados);
        
        require_once("../app/views/$view.php");
    }

    public static function tratar_url(string $texto): string
    {
        $textoUrl = trim(strtolower($texto));

        $caracter = [
            'á' => 'a',
            'à' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',

            'Á' => 'a',
            'À' => 'a',
            'Â' => 'a',
            'Ã' => 'a',
            'Ä' => 'a',
            'Å' => 'a',

            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',

            'É' => 'e',
            'È' => 'e',
            'Ê' => 'e',
            'Ë' => 'e',

            'í' => 'i',
            'ì' => 'i',
            'î' => 'i',
            'ï' => 'i',

            'Í' => 'i',
            'Ì' => 'i',
            'Î' => 'i',
            'Ï' => 'i',

            'ó' => 'o',
            'ò' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',

            'Ó' => 'o',
            'Ò' => 'o',
            'Ô' => 'o',
            'Õ' => 'o',
            'Ö' => 'o',

            'ú' => 'u',
            'ù' => 'u',
            'û' => 'u',
            'ü' => 'u',

            'Ú' => 'u',
            'Ù' => 'u',
            'Û' => 'u',
            'Ü' => 'u',

            'ç' => 'c',
            'Ç' => 'c',

            'ñ' => 'n',
            'Ñ' => 'n',
            '+' => ''
        ];

        $textoUrl = str_replace(' ', '-', $textoUrl);

        $textoUrl = strtr($textoUrl, $caracter);

        return $textoUrl;
    }

    public static function verificar_login(): void
    {
        $token = $_SESSION['login'] ?? '';

        $payload = Token::validar($token);

        if(is_null($payload)){
            header('Location: ' . URL . 'login');
            exit;
        }
    }

    public static function descriptografia(string $crypto): string|bool
    {
        $bytes = base64_decode($crypto);

        $iv = substr($bytes, 0, openssl_cipher_iv_length(METHOD_CRYPTO));

        $tag = substr($bytes, strlen($iv), 16);

        $crypto = substr($bytes, (strlen($iv) + strlen($tag)));

        $key = base64_decode($_ENV['CRYPTO_KEY']);

        $normal = openssl_decrypt($crypto, METHOD_CRYPTO, $key, OPENSSL_RAW_DATA, $iv, $tag);

        if(!$normal){
            return false;
        } else{
            return $normal;
        }
    }

}
