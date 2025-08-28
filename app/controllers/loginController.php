<?php

class LoginController extends Controller{
    public function index()
    {
        $dados = [];

        $this->render('login', $dados);
    }

    public function verificar(): void
    {
        $input = file_get_contents('php://input');
        $input = json_decode($input, true);

        foreach($input as $campo => $valor){
            if(empty(trim($valor))){
                echo match($campo){
                    'email' => 'O seu E-mail nao foi preenchido, tentar novamente com todos os campos preenchidos',
                    'senha' => 'Sua senha nao foi preenchida, tentar novamente com todos os campos prenchidos'
                };
                return;
            }
        }

        $ch = curl_init(URL_API . 'login_senha');

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
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
            die($erro);
        }

        if($http !== 200){
            echo $resposta;
            return;
        }

        $resposta = json_decode($resposta, true);

        $_SESSION['login'] = $resposta;

        echo json_encode([
            'sucesso' => 'Login feito com sucesso'
        ]);
        return;
    }

}