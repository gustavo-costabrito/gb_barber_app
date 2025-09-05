<?php

class LoginController extends Controller{
    public function index()
    {
        $dados = [];

        $this->render('login', $dados);
    }

    public function logar_senha(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $input = [
                'email' => filter_input(INPUT_POST, 'emailLogin', FILTER_SANITIZE_SPECIAL_CHARS),
                'senha' => filter_input(INPUT_POST, 'senhaLogin', FILTER_SANITIZE_SPECIAL_CHARS)
            ];

            foreach($input as $campo => $valor){
                if(empty(trim($valor))){
                    echo match($campo){
                        'email' => 'Você não preencheu o seu E-mail, tentar novamente com todos os campos preenchidos',
                        'senha' => 'Você não preencheu a sua senha, tentar novamente com todos os campos preenchidos'
                    };
                    return;
                }
            }

            $login = $this->login_senha($input);

            if(is_null($login)){
                die("Erro na API de login");
            }

            if(!isset($login['sucesso'])){
                echo $login['erro'] ?? 'Erro';
                return;
            }

            $_SESSION['login'] = $login['sucesso'];

            echo "Sucesso";
        }
    }


    // APIs

    private function login_senha(array $input): ?array
    {
        $ch = curl_init(URL_API . 'login_senha');

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
        
        if($http !== 200){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }

}