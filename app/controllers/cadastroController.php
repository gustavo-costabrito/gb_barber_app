<?php

class CadastroController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $this->render('cadastro', $dados);
    }

    public function adicionar_cadastro(): void
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            return;
        }

        $input = [
            'nome' => filter_input(INPUT_POST, 'nome_cadastro', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE),
            'email' => filter_input(INPUT_POST, 'email_cadastro', FILTER_SANITIZE_EMAIL, FILTER_NULL_ON_FAILURE),
            'whatsapp' => filter_input(INPUT_POST, 'whatsapp_cadastro', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE),
            'senha' => $_POST['senha_cadastro'] ?? null
        ];

        foreach($input as $valor){
            if(is_null($valor)){
                http_response_code(400);
                echo json_encode([
                    'error' => 'Nao foi possivel realizar o seu cadastro, tentar novamente'
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                return;
            } else {
                if(empty(trim($valor))){
                    http_response_code(422);
                    echo json_encode([
                        'error' => 'Preencha todos os campos'
                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                    return;
                }
            }
        }

        $apiCadastro = $this->add_cadastro($input);

        if(is_null($apiCadastro)){
            http_response_code(500);
            echo json_encode([
                'error' => 'Erro ao realizar cadastro, tentar novamente mais tarde'
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        if(!isset($apiCadastro['sucesso'])){
            http_response_code(400);
            echo json_encode($apiCadastro, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        $_SESSION['login'] = $apiCadastro['sucesso'] ?? null;

        http_response_code(201);
        echo json_encode([
            'sucesso' => 'Cadastro realizado com sucesso'
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return;
    }




    // APIs

    private function add_cadastro(array $input): ?array
    {
        $ch = curl_init(URL_API . 'add_cadastro');

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json'
            ],
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

        $resposta = json_decode($resposta, true);

        return $resposta ?: null;
    }
}