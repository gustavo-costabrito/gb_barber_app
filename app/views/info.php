<!DOCTYPE html>
<html lang="en">
<?php require_once(__DIR__ . "/includes/head.php") ?>

<body>
    <?php require_once(__DIR__ . "/includes/header.php") ?>
    <section class="info">
        <img style="height: 35px;width: 35px;padding: 5px 15px;" src="<?= URL ?>assets/img/voltar.png" alt="">
        <div class="site">
            <h2 class="tt-info">Suas Informações <span style="color: var(--cor-terciaria);">pessoais</span></h2>
            <form class="container-info" action="" method="post" id="form_atu">
                <div class="box-info">
                    <label for="">Nome:</label>
                    <div class="linha-input">
                        <input type="text" placeholder="example_nome" id="nome_atu" value="<?= $dadosLogin['nome'] ?>">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <div class="box-info">
                    <label for="">E-mail:</label>
                    <div class="linha-input">
                        <input type="text" placeholder="email@example.com" id="email_atu" value="<?= $dadosLogin['email'] ?>">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <div class="box-info">
                    <label for="">Whatsapp:</label>
                    <div class="linha-input">
                        <input id="telefone" placeholder="(11)99999-9999" type="text" id="whatsapp_atu" value="<?= $dadosLogin['whatsapp'] ?>">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <div class="box-info">
                    <label for="">Senha:</label>
                    <div class="linha-input">
                        <input type="text" placeholder="<?= $dadosLogin['senha'] ? 'Aperte para alterar senha' : 'Aperte para adicionar senha' ?>" id="senha_atu">
                        <img style="width: 15px; height: 15px;" src="<?= URL ?>assets/img/lapis.png" alt="">
                    </div>
                </div>
                <button class="button-info" type="submit">Salvar</button>
            </form>
        </div>
    </section>
    <?php require_once(__DIR__ . "/includes/footer.php") ?>
    <script>
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
        document.addEventListener('DOMContentLoaded', function(){
            const input = [
                document.getElementById('nome_atu'),
                document.getElementById('email_atu'),
                document.getElementById('whatsapp_atu'),
                document.getElementById('senha_atu'),
            ];

            input.forEach(valor => {
                valor.addEventListener('input', function(){
                    enviar_formulario();
                });
            });
        });

        function enviar_formulario()
        {
            const form = document.getElementById('form_atu');

            form.addEventListener('submit', function(event){
                event.preventDefault();

                const formulario = new FormData(event.target);

                fetch(`<?= URL?>info/atu_cadastro`, {
                    method: event.target.method,
                    body: formulario
                })

                .then(response => response.json())
                .then(data => {
                    if(!data.sucess){
                        alert(data.error);
                        console.log(data.error);
                    } else {
                        alert(data.error);
                    }
                })

                .catch(error => {
                    console.error(error);
                })
            });
        }
     </script>
</body>

</html>