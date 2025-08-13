<?php

class CadastroController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $this->render('cadastro', $dados);
    }

    public function add_cadastro(): void
    {
        header('Accept: application/json');

        $input = file_get_contents('php://input');
        $input = json_decode($input, true);

        $ch = curl_init(URL_API . 'add_cadastro');

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($input, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);

        $erro = curl_error($ch);

        $http = curl_getinfo($ch);

        curl_close($ch);

        if($erro){
            echo json_encode([
                'erro' => 'Erro ao enviar formulario'
            ]);
            return;
        }

        echo $resposta;
    }
}
