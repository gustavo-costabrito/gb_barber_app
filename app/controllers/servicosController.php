<?php


class servicosController extends Controller{
    public function index(){
        $dados = [
            'servicos' => $this->listar_servicos()
        ]; 

        foreach($dados as $campo => $valor){
            if(is_null($valor)){
                die('Erro na API de ' . $campo);
            }
        }
        
        $this->render('servicos', $dados);
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

        curl_close($ch);

        if($erro){
            return null;
        }

        $resposta = json_decode($resposta, true);

        return $resposta;
    }
}