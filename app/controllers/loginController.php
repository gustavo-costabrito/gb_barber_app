<?php

class LoginController extends Controller
{
    public function index(): void
    {
        if(isset($_SESSION['login'])){
            header('Location: ' . URL . 'inicio');
            exit;
        }

        $dados = [];

        $this->render('login', $dados);
    }

    public function verificar_login(): void
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            return;
        }

        $input = [
            'email' => filter_input(INPUT_POST, 'email_login', FILTER_SANITIZE_EMAIL, FILTER_NULL_ON_FAILURE)
        ];

        if(isset($_POST['whatsapp_login'])){
            $input['whatsapp'] = filter_input(INPUT_POST, 'whatsapp_login', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
        } else {
            $input['senha'] = $_POST['senha_login'] ?? null;
        }

        foreach($input as $campo => $valor){
            if(is_null($valor)){
                echo json_encode([
                    'error' => match($campo){
                        'email' => 'E-mail nao identificado',
                        'whatsapp' => 'Whatsapp nao identificado',
                        'senha' => 'Senha nao identificada'
                    }
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                return;
            } else {
                if(empty(trim($valor))){
                    echo json_encode([
                        'error' => match($campo){
                            'email' => 'E-mail nao foi preenchido',
                            'whatsapp' => 'Whatsapp nao foi preenchido',
                            'senha' => 'Senha nao foi preenchida'
                        }
                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                    return;
                }
            }
        }

        $apiLogin = $this->login_cliente($input);

        if(is_null($apiLogin)){
            echo json_encode([
                'error' => 'Nao foi possivel realizar a vericacao no momento'
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        if(isset($apiLogin['error'])){
            echo json_encode($apiLogin, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        $_SESSION['login'] = $apiLogin['sucesso'] ?? '';

        echo json_encode([
            'sucesso' => 'Login realizado com sucesso'
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return;
    }



    // APIs
    private function login_cliente(array $input): ?array
    {
        $ch = curl_init(URL_API . 'login_cliente');

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
