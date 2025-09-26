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

    public function logar(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = filter_input(INPUT_POST, 'emailLogin', FILTER_SANITIZE_EMAIL);

            if(isset($_POST['senhaLogin'])){
                $senha = filter_input(INPUT_POST, 'senhaLogin', FILTER_SANITIZE_SPECIAL_CHARS);
            } else {
                $whatsapp = filter_input(INPUT_POST, 'whatsappLogin', FILTER_SANITIZE_SPECIAL_CHARS);
            }

            if(empty(trim($email))){
                echo "Seu E-mail nao foi preenchido, tentar novamente com todos os campos preenchidos";
                return;
            }

            if(isset($senha)){
                if(empty(trim($senha))){
                    echo 'Sua senha nao foi preenchida, tentar novamente com todos os campos preenchidos';
                    return;
                }
            } 

            if(isset($whatsapp)){
                if(empty(trim($whatsapp))){
                    echo 'Seu numero de Whatsapp nao foi preenchido, tentar novamente com todos os campos preenchidos';
                    return;
                }
            }


            $input = [
                'email' => $email,
                'senha' => $senha ?? null,
                'whatsapp' => $whatsapp ?? null
            ];


            if(is_null($input['senha'])){
                unset($input['senha']);

                $resposta = $this->login_whatsapp($input);

                if(is_null($resposta)){
                    die('Erro na API de login de senha');
                }

            } else{
                unset($input['whatsapp']);

                $resposta = $this->login_senha($input);

                if(is_null($resposta)){
                    die('Erro na API de login de whatsapp');
                }
            }

            if(!isset($resposta['sucesso'])){
                foreach($resposta as $valor){
                    echo $valor;
                }

                return;
            }

            echo 'Sucesso';

            $_SESSION['login'] = $resposta['sucesso'];
            return;
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
            CURLOPT_POSTFIELDS => json_encode($input, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
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

        if($http !== 200){
            return $resposta;
        }

        return $resposta;
    }

    private function login_whatsapp(array $input): ?array
    {
        $ch = curl_init(URL_API . 'login_whatsapp');

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

        curl_close($ch);

        if($erro){
            return null;
        }

        $resposta = json_decode($resposta, true);

        if($http !== 200){
            return $resposta;
        }

        return $resposta;
    }
}
