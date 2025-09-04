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
}
