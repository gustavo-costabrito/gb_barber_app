<!DOCTYPE html>
<html lang="en">
<?php require_once(__DIR__ . "/includes/head.php") ?>

<body>
    <?php require_once(__DIR__ . "/includes/header.php") ?>
    <section class="info">
        <div class="site">
            <div class="tituloTela">
                <div>
                    <img src="<?= URL ?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
                    <h2>Informacoes do <span>cadastro:</span></h2>
                </div>
            </div>
            <form class="container-info" action="" method="post" id="form_atu">
                <div class="box-info">
                    <label for="">Nome:</label>
                    <div class="linha-input">
                        <input type="text" placeholder="example_nome" name="nome_atu" value="<?= $dadosLogin['nome'] ?>">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <div class="box-info">
                    <label for="">E-mail:</label>
                    <div class="linha-input">
                        <input type="text" placeholder="email@example.com" name="email_atu" value="<?= $dadosLogin['email'] ?>">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <div class="box-info">
                    <label for="">Whatsapp:</label>
                    <div class="linha-input">
                        <input id="telefone" placeholder="(11)99999-9999" type="text" name="whatsapp_atu" value="<?= $dadosLogin['whatsapp'] ?>">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <div class="box-info">
                    <label for="">Senha:</label>
                    <div class="linha-input">
                        <input type="text" placeholder="<?= isset($dadosLogin['senha']) ? 'Alterar senha' : 'Adicionar senha' ?>" name="senha_atu">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <button class="button-info" type="submit">Salvar</button>
            </form>
        </div>
    </section>


    <?php require_once(__DIR__ . "/includes/footer.php") ?>


    <script>
        function mostrarAlerta(texto, tipo = 'success') {
            const config = {
                success: {
                    titulo: 'Sucesso!',
                    mensagem: texto
                },
                error: {
                    titulo: 'Erro!',
                    mensagem: texto
                }
            };

            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${tipo}`;
            alertDiv.innerHTML = `
                <div class="alert-icon"></div>
                <div class="alert-content">
                    <div class="alert-title">${config[tipo].titulo}</div>
                    <div class="alert-message">${config[tipo].mensagem}</div>
                </div>
                <button class="alert-close" onclick="fecharAlerta(this)">×</button>
                <div class="alert-progress"></div>
            `;

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.classList.add('show');
            }, 10);

            setTimeout(() => {
                fecharAlerta(alertDiv);
            }, 5000);
        }

        function fecharAlerta(elemento) {
            const alert = elemento.classList ? elemento : elemento.parentElement;
            alert.classList.remove('show');
            alert.classList.add('hide');

            setTimeout(() => {
                alert.remove();
            }, 400);
        }
        // Função para formatar o telefone no padrão (XX) XXXXX-XXXX
        function formatarTelefone(input) {
            // Remove tudo que não é dígito
            let value = input.value.replace(/\D/g, '');

            // Limita a 11 dígitos (máximo para celular brasileiro)
            if (value.length > 11) {
                value = value.substring(0, 11);
            }

            // Aplica a formatação conforme o tamanho do número
            if (value.length <= 10) {
                // Formato para telefone fixo: (XX) XXXX-XXXX
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            } else {
                // Formato para celular: (XX) XXXXX-XXXX
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }

            // Atualiza o valor do campo
            input.value = value;
        }

        // Adiciona os eventos quando a página carregar
        document.addEventListener('DOMContentLoaded', function() {
            // Obtém os campos de telefone pelos IDs
            const telefoneAluno = document.getElementById('telefone');

            // Adiciona o evento de input para formatação automática
            if (telefoneAluno) {
                telefoneAluno.addEventListener('input', function() {
                    formatarTelefone(this);
                });
            }

            // Formata os valores iniciais se existirem
            if (telefoneAluno && telefoneAluno.value) {
                formatarTelefone(telefoneAluno);
            }
        });
    </script>


    <!-- AJAX -->
    <script>
        document.getElementById('form_atu').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = new FormData(event.target);

            fetch(`<?= URL ?>info/atualizar_cadastro`, {
                    method: event.target.method,
                    body: form
                })

                .then(response => response.json())
                .then(data => {
                    if (!data.sucesso) {
                        mostrarAlerta(data.error, 'error');
                        console.log(data);
                    } else {
                        mostrarAlerta(data.sucesso);
                        location.reload();
                    }
                })

                .catch(error => {
                    console.error(error);
                })
        });
    </script>
</body>

</html>