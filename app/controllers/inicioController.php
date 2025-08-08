<?php

class InicioController extends Controller{
    public function index(){
        $dados = [];

        $this->render('inicio', $dados);
    }
}