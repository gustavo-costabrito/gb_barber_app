<?php

class infoController extends Controller{
    public function index(){
        $dados = [];

        $this->render('info' , $dados);
    }
}