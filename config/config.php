<?php

define('URL', 'https://agenciatipi03.smpsistema.com.br/codexdev/gb_barber_app/public/');

define('URL_API', 'https://localhost/gb_barber/public/api/');

define('URL_UPLOAD', 'https://localhost/gb_barber/public/upload/');

define('METHOD_CRYPTO', 'AES-256-GCM');


spl_autoload_register(function($class){
    $caminhos = [
        "../app/controllers/$class.php",
        "../routes/$class.php",
        "../app/core/$class.php"
    ];

    foreach($caminhos as $valor){
        if(file_exists($valor)){
            require_once($valor);
        }
    }
});

function env(): void
{
    $arquivo = file("../.env", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach($arquivo as $valor){
        if(str_contains($valor, '#') && strpos($valor, '#') === 0){
            continue;
        }

        $env = explode('=', $valor, 2);

        $_ENV[$env[0]] = $env[1];
    }
}

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}