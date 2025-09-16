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
                die("Erro ao retornar a API $campo");
            }
        }

        $this->render('inicio', $dados);
    }

    public function add_comentario(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $input = [
                'mensagem' => filter_input(INPUT_POST, 'mensagemContato', FILTER_SANITIZE_SPECIAL_CHARS)
            ];

            if(empty(trim($input['mensagem']))){
                echo "Insira sua pergunta";
                return;
            }

            $payload = Token::validar($_SESSION['login']);

            if(is_null($payload)){
                die("Token expirado");
            }

            $addComentario = $this->adicionar_comentario((int)$payload['id'], $input);

            if(is_null($addComentario)){
                die("Erro ao executar API de adicionar comentario");
            }

            var_dump ($addComentario);
            return;
        }
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
        $payload = Token::validar($_SESSION['login']);

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

    private function adicionar_comentario(int $id, array $input): ?array
    {
        $ch = curl_init(URL_API . 'add_comentario/' . $id);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['login']
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => json_encode($input),
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

        if($http !== 201){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }
}
