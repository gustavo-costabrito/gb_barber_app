<?php

class Controller{
    public function render(string $view, array $dados = []){
        extract($dados);

        require_once("../app/views/$view.php");
    }
}