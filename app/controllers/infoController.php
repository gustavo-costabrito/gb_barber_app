<?php

class infoController extends Controller{
    public function index(){
        $dados = [
            'dadosLogin' => $this->listar_login()
        ];

        $this->render('info' , $dados);
    }

    public function atu_cadastro(): void
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            http_response_code(400);
            return;
        }

        $input = [
            'nome' => filter_input(INPUT_POST, 'nome_atu', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST, 'email_atu', FILTER_SANITIZE_EMAIL),
            'whatsapp' => filter_input(INPUT_POST, 'whatsapp_atu', FILTER_SANITIZE_SPECIAL_CHARS),
            'senha' => $_POST['senha_atu'] ?: null
        ];

        echo json_encode([
            'error' => $input
        ]);
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
}