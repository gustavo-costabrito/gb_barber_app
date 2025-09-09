<?php

class perguntasController extends Controller{
    public function index(){
        $dados = [];
        $this->render('perguntas', $dados);
    }
}