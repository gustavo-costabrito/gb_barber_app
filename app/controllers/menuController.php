<?php

class MenuController extends Controller{

    public function index(){
        $dados = [];

        $this->render('menu', $dados);
    }

    public function logout(): void
    {
        session_unset();
        header('Location: ' . URL . 'login');
        exit;
    }
}