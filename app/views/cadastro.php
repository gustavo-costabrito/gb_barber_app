<?php

if(isset($_SESSION['login'])){
    header('Location: ' . URL . 'inicio');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <header class="not-login">
        <div class="site">
            <h1>GB-Barbearia</h1>
        </div>
    </header>

    <section class="cadastro">
        <div class="site">
            <form class="form-cadastro" id="form_cadastro" action="" method="post">
                <div class="form-cadastro__title">
                    <h2>Realização do <span>cadastro</span></h2>
                </div>
                <div class="form-cadastro__content">
                    <div class="__content__input">
                        <label for="nomeCadastro">Nome:</label>
                        <input type="text" placeholder="Nome Completo" name="nome_cadastro" id="nomeCadastro">
                    </div>
                    <div class="__content__input">
                        <label for="emailCadastro">E-mail:</label>
                        <input type="email" placeholder="seuemail@dominio.com" name="email_cadastro" id="emailCadastro">
                    </div>
                    <div class="__content__input">
                        <label for="whatsappCadastro">Whatsapp:</label>
                        <input type="text" placeholder="(00) 00000-0000" name="whatsapp_cadastro" id="whatsappCadastro" maxlength="15">
                    </div>
                    <div class="__content__input">
                        <label for="senhaCadastro">Senha:</label>
                        <input type="password" placeholder="senha123..." name="senha_cadastro" id="senhaCadastro">
                    </div>
                    <div class="__content__button">
                        <a href="<?= URL ?>login">
                            <button type="button">Retornar ao login</button>
                        </a>
                        <button type="submit">Salvar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="fundo-cadastro" style="background-image: url(<?= URL ?>assets/img/fundo-cadastro.jpg);"></div>
    </section>

    <!-- Javacript -->
     <script>
        document.getElementById('whatsappCadastro').addEventListener('input', function(event){
            let valor = event.target.value;

            valor = valor.replace(/\D/g, '');

            if(valor.lenght < 15){
                event.target.value = valor.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
            } else{
                event.target.value = valor.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
            }
        });
     </script>

    <!-- AJAX -->
    <script>
        document.getElementById('form_cadastro').addEventListener('submit', function(event){
            event.preventDefault();

            const form = new FormData(event.target);

            fetch(`<?= URL?>cadastro/adicionar_cadastro`, {
                method: event.target.method,
                body: form
            })

            .then(response => response.json())
            .then(data => {
                if(data.sucesso){
                    alert(data.sucesso);
                    window.location.href = `<?= URL?>inicio`;
                } else {
                    mostrarAlerta(data.error, 'error');
                    console.log(data);
                }
            })

            .catch(error => {
                console.error(error);
            })
        });
    </script>
</body>

</html>