<?php

class MenuController extends Controller{

    public function index(){
        $dados = [];

        $this->render('menu', $dados);
    }
}