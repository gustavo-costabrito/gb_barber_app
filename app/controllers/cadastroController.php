<?php

class CadastroController extends Controller{
    public function index(){
        $dados = [];

        $this->render('cadastro', $dados);
    }
}