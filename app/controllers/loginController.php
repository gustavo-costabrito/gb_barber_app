<?php

class LoginController extends Controller{
    public function index(){
        $dados = [];

        $this->render('login', $dados);
    }
}