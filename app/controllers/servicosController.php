<?php


class servicosController extends Controller{
    public function index(){
        $dados = []; 
        
        $this->render('servicos', $dados);
    }
}