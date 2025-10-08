<?php

class infoController extends Controller{
    public function index(){
        $dados = [
            'dadosLogin' => $this->listar_login()
        ];

        $this->render('info' , $dados);
    }

    public function atualizar_cadastro(): void
    {
        header('Content-Type: application/json');

        $input = [
            'nome' => filter_input(INPUT_POST, 'nome_atu', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST, 'email_atu', FILTER_SANITIZE_EMAIL),
            'whatsapp' => filter_input(INPUT_POST, 'whatsapp_atu', FILTER_SANITIZE_SPECIAL_CHARS),
            'senha' => $_POST['senha_atu'] ?: null
        ];

        if(is_null($input['senha'])){
            unset($input['senha']);
        }

        foreach($input as $campo => $valor){
            if(empty($valor)){
                echo json_encode([
                    'error' => match($campo){
                        'nome' => 'Seu nome completo não foi preenchido',
                        'email' => 'Seu E-mail não foi preenchido',
                        'whatsapp' => 'Seu numero de Whatsapp não foi preenchido',
                        'senha' => 'Sua senha não foi preenchida'
                    }
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                return;
            }
        }

        $apiAtualizar = $this->atu_cadastro($input);

        if(is_null($apiAtualizar)){
            echo json_encode([
                'error' => 'Erro ao atualizar cadastro'
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode($apiAtualizar, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return;
    }



    // APIs
    private function listar_login(): ?array
    {
        $payload = Token::validar($_SESSION['login'] ?? '');

        if(!$payload){
            return null;
        }

        $ch = curl_init(URL_API . 'listar_login/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Bearer ' . $_SESSION['login'] ?? ''
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

        if(isset($resposta['erro'])){
            return null;
        }

        return $resposta ?: null;
    }

    private function atu_cadastro(array $input): ?array
    {
        foreach($input as $valor){
            if(empty($valor)){
                return null;
            }
        }

        $payload = Token::validar($_SESSION['login']);

        if(!$payload){
            return null;
        }

        $ch = curl_init(URL_API . 'atu_cadastro/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['login']
            ],
            CURLOPT_POSTFIELDS => json_encode($input, true),
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

        return $resposta ?: null;
    }
}