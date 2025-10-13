<?php

class notificacoesController extends Controller{
    public function index()
    {
        $dados = [
            'notificacaoNaoLidas' => $this->listar_notificacao_nao_lida(),
            'notificacaoLidas' => $this->listar_notificacao_lida()
        ];

        $this->render('notificacoes', $dados);
    }



    public function marcar_lida(int $id_notificacao): void
    {
        if(empty($id_notificacao)){
            echo json_encode([
                'error' => 'Notificacao nao informada para atualizar'
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        $token = $_SESSION['login'] ?? '';

        $payload = Token::validar($token);

        if(!$payload){
            echo json_encode([
                'error' => 'Token expirado'
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        $ch = curl_init(URL_API . 'atu_notificacao/' . $id_notificacao . '/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ],
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);

        $erro = curl_error($ch);

        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($erro){
            echo json_encode([
                'error' => 'Nao foi possivel marcar como lida a notificacao'
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        echo $resposta;
        return;
    }

    private function listar_notificacao_nao_lida(): ?array
    {
        $token = $_SESSION['login'] ?? '';

        $payload = Token::validar($token);

        if(!$payload){
            return null;
        }

        $ch = curl_init(URL_API . 'listar_notificacao_nao_lida/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Bearer ' . $token
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

        return $resposta ?: null;
    }

    private function listar_notificacao_lida(): ?array
    {
        $token = $_SESSION['login'] ?? '';

        $payload = Token::validar($token);

        if(!$payload){
            return null;
        }

        $ch = curl_init(URL_API . 'listar_notificacao_lida/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Bearer ' . $token
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