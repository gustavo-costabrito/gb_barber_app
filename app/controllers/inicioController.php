<?php

class InicioController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $dados = [
            'servicos' => $this->listar_servicos(),
            'dadosLogin' => $this->listar_login()
        ];

        foreach($dados as $campo => $valor){
            if(is_null($valor)){
                echo "erro api $campo";
            }
        }

        $this->render('inicio', $dados);
    }

    public function adicionar_comentario(): void
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            return;
        }

        $mensagem = filter_input(INPUT_POST, 'mensagem_contato', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);

        if(empty(trim($mensagem)) || is_null($mensagem)){
            http_response_code(422);
            echo json_encode([
                'error' => 'Preencha a mensagem que deseja enviar'
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        $apiMensagem = $this->add_comentario($mensagem);

        if(!isset($apiMensagem['sucesso'])){
            http_response_code(400);
            echo json_encode($apiMensagem, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        http_response_code(201);
        echo json_encode($apiMensagem, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }




    // APIs
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

        if($http !== 200){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }

    private function listar_login(): ?array
    {
        $payload = Token::validar($_SESSION['login'] ?? '');

        if(is_null($payload)){
            return null;
        }

        $ch = curl_init(URL_API . "listar_login/" . (int)$payload['id']);

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

        curl_close($ch);

        if($erro){
            return null;
        }

        if($http !== 200){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }

    private function add_comentario(string $mensagem): ?array
    {
        $payload = Token::validar($_SESSION['login'] ?? '');

        if(!$payload){
            return null;
        }

        $ch = curl_init(URL_API . 'add_comentario/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content: application/json',
                'Authorization: Bearer ' . $_SESSION['login'] ?? ''
            ],
            CURLOPT_POSTFIELDS => json_encode([
                'mensagem' => $mensagem
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
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
