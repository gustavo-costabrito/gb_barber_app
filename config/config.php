<?php

define('URL', 'https://localhost/gb_barber_app/public/');

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