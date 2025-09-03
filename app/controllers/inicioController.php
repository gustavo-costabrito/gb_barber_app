<?php

class InicioController extends Controller
{
    public function index()
    {
        $dados = [];



        // Servicos
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

        curl_close($ch);

        if ($erro) {
            die("Erro: $erro");
        }
        
        $dados['servicos'] = json_decode($resposta, true);



        // Contato

        $payload = Token::validar($_SESSION['login']);

        if(is_null($payload)){
            echo "Token expirado ou invalido";
            session_unset();
            header('Location: ' . URL . 'login');
            exit;
        }

        $ch = curl_init(URL_API . 'listar_login/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_POST => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['login'],
            ],
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);

        $erro = curl_error($ch);

        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($erro){
            die($erro);
        }

        if($http !== 200){
            echo $resposta;
            return;
        }

        $dados['dadosLogin'] = json_decode($resposta, true);

        $this->render('inicio', $dados);
    }
}
