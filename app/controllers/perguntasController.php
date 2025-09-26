<?php

class perguntasController extends Controller{
    public function index(){
        $dados = [
            'perguntas' => $this->listar_comentarios()
        ];

        foreach($dados as $api => $valor){
            if(is_null($valor)){
                echo 'Erro na api: ' . $api;
            }
        }

        if(isset($dados['perguntas']['erro'])){
            $dados['nenhum'] = true;
        }
        
        $this->render('perguntas', $dados);
    }

    private function listar_comentarios(): ?array
    {
        $payload = Token::validar($_SESSION['login'] ?? null);

        if(is_null($payload)){
            return null;
        }

        $ch = curl_init(URL_API . 'listar_comentarios_cliente/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Bearer ' . $_SESSION['login']
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

        $resposta = json_decode($resposta, true);

        return $resposta;
    }
}