<?php

class CadastroController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $this->render('cadastro', $dados);
    }

    public function adicionar(): void
    {
        $input = file_get_contents('php://input');
        $input = json_decode($input, true);

        header('Content-Type: application/json');

        foreach($input as $campo => $valor){
            if(empty(trim($valor))){
                echo json_encode([
                    'erro' => match($campo){
                        'nome' => 'Seu nome completo nao foi preenchido, tentar novamente com todos os campos preenchidos',
                        'email' => 'Seu E-mail nao foi preenchido, tentar novamento com todos os campos preenchidos',
                        'whatsapp' => 'Seu numero de whatsapp nao foi preenchido, tentar novamente com todos os campos preenchidos',
                        'senha' => 'Sua senha nao foi preenchida, tentar novamente com todos os campos preenchidos'
                    }
                ]);
                return;
            }
        }

        $ch = curl_init(URL_API . 'add_cadastro');

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

        if($http !== 201){
            echo $resposta;
            return;
        }

        $resposta = json_decode($resposta, true);

        $_SESSION['login'] = $resposta['sucesso'];

        echo json_encode([
            'sucesso' => 'Cadastro realizado com sucesso'
        ]);
        return;
    }
}
