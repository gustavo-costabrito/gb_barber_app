<?php

class CadastroController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $this->render('cadastro', $dados);
    }

    public function cadastrar(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $input = [
                'nome' => filter_input(INPUT_POST, 'nomeCadastro', FILTER_SANITIZE_SPECIAL_CHARS),
                'email' => filter_input(INPUT_POST, 'emailCadastro', FILTER_SANITIZE_EMAIL),
                'whatsapp' => filter_input(INPUT_POST, 'whatsappCadastro', FILTER_SANITIZE_SPECIAL_CHARS),
                'senha' => filter_input(INPUT_POST, 'senhaCadastro', FILTER_SANITIZE_SPECIAL_CHARS)
            ];

            foreach($input as $campo => $valor){
                if(empty(trim($valor))){
                    echo match($campo){
                        'nome' => 'Seu nome não foi preenchido, tentar novamente com todos os campos preenchidos',
                        'email' => 'Seu E-mail não foi preenchido, tentar novamente com todos os campos preenchidos',
                        'whatsapp' => 'Seu número de Whatsapp não foi preenchido, tentar novamente com todos os campos preenchidos',
                        'senha' => 'Sua senha não foi preenchida, tentar novamente com todos os campos preenchidos'
                    };
                    return;
                }
            }

            $api = $this->add_cadastro($input);

            if(is_null($api)){
                die("Erro ao executar API de cadastro");
            }

            if(!isset($api['sucesso'])){
                foreach($api as $valor){
                    echo $valor . "\n";
                }
                return;
            }

            $_SESSION['login'] = $api['sucesso'];

            echo "Sucesso";
            return;
        }
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
            CURLOPT_POSTFIELDS => json_encode($input, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);

        $erro = curl_error($ch);

        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($erro){
            return null;
        }

        if($http !== 200){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }
}