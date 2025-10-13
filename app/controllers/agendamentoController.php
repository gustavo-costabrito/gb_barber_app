<?php

class AgendamentoController extends Controller
{
    public function index(): void
    {
        $dados = [];

        $dados = [
            'datas' => $this->data_agendamento(),
            'servicos' => $this->listar_servicos(),
            'dadosLogin' => $this->listar_login()
        ];

        $this->render('agendamento', $dados);
    }

    public function adicionar_agendamento(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            header('Content-Type: application/json');

            $input = [
                'data_horario' => $_POST['horarioAgendamento'] ?? null,
                'servico' => $_POST['servico'] ?? null
            ];

            foreach ($input as $campo => $valor) {
                if (is_null($valor) || empty(trim($valor)) || (int)$valor < 1) {
                    echo json_encode([
                        'error' => 'Preencher todos os campos'
                    ], JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE);
                    return;
                }
            }

            $validado['data_horario'] = (int)$input['data_horario'];

            $validado['servico'] = (int)$input['servico'];

            $payload = Token::validar($_SESSION['login'] ?? '');

            if (is_null($payload)) {
                echo json_encode([
                    'error' => 'Token expirado'
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                return;
            }

            $cliente = (int)$payload['id'];

            $apiAgendamento = $this->add_agendamento($validado, $cliente);

            if (is_null($apiAgendamento)) {
                echo json_encode([
                    'error' => 'Erro ao adicionar agendamento'
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                return;
            }

            if (!isset($apiAgendamento['sucesso'])) {
                echo json_encode(
                    $apiAgendamento,
                    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                );
                return;
            }

            echo json_encode([
                'sucesso' => $apiAgendamento['sucesso']
            ]);
            return;
        }
    }



    // Pagina meus agendamentos
    public function meus_agendamentos(): void
    {
        $payload = Token::validar($_SESSION['login']);

        if (is_null($payload)) {
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

        if ($erro) {
            return null;
        }

        if ((int)$http !== 200) {
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

        if ($erro) {
            return null;
        }

        if ($http != 200) {
            return json_decode($resposta, true);
        }

        return json_decode($resposta, true);
    }

    private function listar_login(): ?array
    {
        $payload = Token::validar($_SESSION['login']);

        if (is_null($payload)) {
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

        if ($erro) {
            return null;
        }

        $resposta = json_decode($resposta, true);

        return $resposta;
    }

    private function add_agendamento(array $input, int $cliente): ?array
    {
        foreach ($input as $valor) {
            if (empty(trim($valor)) || is_null($valor) || !$valor) {
                return null;
            }
        }

        $ch = curl_init(URL_API . 'add_agendamento/' . $cliente);

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

        if ($erro) {
            return null;
        }

        $resposta = json_decode($resposta, true);

        return $resposta ?: null;
    }

    public function listar_horarios_data(int $id_data): void
    {
        header('Content-Type: application/json; charset=utf-8');

        if ($id_data <= 0) {
            echo json_encode(['erro' => 'Data indisponível']);
            return;
        }

        $url = URL_API . 'listar_horarios_data/' . $id_data;

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 10
        ]);

        $resposta = curl_exec($ch);
        $erro = curl_error($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($erro || !$resposta || $http !== 200) {
            echo json_encode(['erro' => 'Data indisponível']);
            return;
        }

        echo $resposta; // já é JSON vindo da API
    }
}
