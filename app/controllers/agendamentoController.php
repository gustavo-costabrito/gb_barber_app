<?php

class AgendamentoController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $dados['datas'] = $this->data_agendamento();
        $dados['servicos'] = $this->listar_servicos();

        foreach($dados as $campo => $valor){
            if(is_null($valor)){
                die("Erro na API de $campo");
            }
        }

        $this->render('agendamento', $dados);
    }

    private function data_agendamento(): ?array
    {
        $ch = curl_init(URL_API . 'listar_datas');

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer' . $_SESSION['login']
            ],
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);

        $erro = curl_error($ch);

        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($erro){
            return null;
        }

        if((int)$http !== 200){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }

    private function listar_servicos(): ?array
    {
        $ch = curl_init(URL_API . 'listar_servicos');

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json'
            ],
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);

        $erro = curl_error($ch);

        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($erro){
            return null;
        }

        if($http != 200){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }
}