<?php

class AgendamentoController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $this->render('agendamento', $dados);
    }
}