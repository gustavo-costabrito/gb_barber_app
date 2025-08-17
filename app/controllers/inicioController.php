<?php

class InicioController extends Controller
{
    public function index()
    {
        $dados = [];

        $ch = curl_init(URL_API . 'listar_servicos');

        curl_setopt_array($ch, [
            CURLOPT_POST => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
            ],
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);

        $erro = curl_error($ch);

        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($erro) {
            die("Erro: $erro");
        }
        
        $dados['servicos'] = json_decode($resposta, true);

        $this->render('inicio', $dados);
    }
}
