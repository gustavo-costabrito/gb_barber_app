<?php

class AgendamentoController extends Controller
{
    public function index(): void
    {
        $dados = [];

        Controller::verificar_login();

        $dados = [
            'datas' => $this->data_agendamento(),
            'servicos' => $this->listar_servicos(),
            'dadosLogin' => $this->listar_login()
        ];

        foreach($dados as $campo => $valor){
            if(is_null($valor)){
                die("Erro na API de $campo");
            }
        }

        $this->render('agendamento', $dados);
    }

    public function adicionar_agendamento(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $input = [
                'servico' => filter_input(INPUT_POST, 'servico', FILTER_SANITIZE_NUMBER_INT),
                'data_horario' => filter_input(INPUT_POST, 'horarioAgendamento', FILTER_SANITIZE_NUMBER_INT)
            ];

            foreach($input as $valor){
                if(empty(trim($valor))){
                    echo "Preencha todos os campos";
                    return;
                }
            }

            $resposta = $this->add_agendamento($input);

            if(is_null($resposta)){
                echo "Erro ao executar API";
                return;
            }

            echo $resposta['erro'] ?? $resposta['sucesso'];
            return;
        }
    }



    // Pagina meus agendamentos
    public function meus_agendamentos(): void
    {
        $payload = Token::validar($_SESSION['login']);

        if(is_null($payload)){
            header('Location: ' . URL . 'login');
            exit;
        }


        $dados = [];

        $this->render('meuAgendamento', $dados);
    }





    // APIs
    private function data_agendamento(): ?array
    {
        $ch = curl_init(URL_API . 'listar_datas');

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer' . $_SESSION['login']
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

        if((int)$http !== 200){
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }

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

        if($http != 200){
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

        $ch = curl_init(URL_API . 'listar_login/' . (int)$payload['id']);

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

        if($erro){
            return null;
        }

        $resposta = json_decode($resposta, true);

        return $resposta;
    }

    private function add_agendamento(array $input): ?array
    {
        $payload = Token::validar($_SESSION['login']);

        if(is_null($payload)){
            return null;
        }

        $ch = curl_init(URL_API . 'add_agendamento/' . (int)$payload['id']);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['login']
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

        return $resposta;
    }

    public function listar_horarios_data(int $id_data): void
    {
        $ch = curl_init(URL_API . 'listar_horarios_data/' . $id_data);

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
            echo "Erro";
            return;
        }

        $resposta = json_decode($resposta, true);

        if($http !== 200){
            echo "Erro";
            return;
        }

        foreach($resposta as $atributos){
            echo "<option value=\"$atributos[id_data_horario]\" id=\"horarioPadrao\">$atributos[hora_inicio]</option>";
        }
        return;
    }
}