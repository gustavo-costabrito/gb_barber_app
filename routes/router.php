<?php

class Router
{
    public static function routes(): void
    {
        $url = trim($_GET['url']);

        if(empty($url)){
            header('Location: ' . URL . 'inicio');
            exit;
        }

        $url = explode('/', $url);

        foreach($url as $posicao => $valor){
            match($posicao){
                0 => $controller = ucfirst($valor) . 'Controller',
                1 => $method = strtolower($valor),
                default => $param[] = $valor
            };
        }

        if(!isset($method) || empty(trim($method))){
            $method = 'index';
        }

        if(!isset($param)){
            $param[] = '';
        }

        call_user_func_array([new $controller(), $method], $param);
    }
}
