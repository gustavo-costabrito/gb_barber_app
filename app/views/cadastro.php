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
            <div class="form-cadastro">
                <div class="form-cadastro__title">
                    <h2>Realização do <span>cadastro</span></h2>
                </div>
                <div class="form-cadastro__content">
                    <div class="__content__input">
                        <label for="nomeCadastro">Nome:</label>
                        <input type="text" placeholder="Nome Completo" name="nomeCadastro" id="nomeCadastro">
                    </div>
                    <div class="__content__input">
                        <label for="emailCadastro">E-mail:</label>
                        <input type="email" placeholder="seuemail@dominio.com" name="emailCadastro" id="emailCadastro">
                    </div>
                    <div class="__content__input">
                        <label for="whatsappCadastro">Whatsapp:</label>
                        <input type="tel" placeholder="(00) 00000-0000" name="whatsappCadastro" id="whatsappCadastro">
                    </div>
                    <div class="__content__input">
                        <label for="senhaCadastro">Senha:</label>
                        <input type="password" placeholder="senha123..." name="senhaCadastro" id="senhaCadastro">
                    </div>
                    <div class="__content__button">
                        <a href="<?= URL?>login">
                            <button type="button">Retornar ao login</button>
                        </a>
                        <button type="button">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="fundo-cadastro" style="background-image: url(<?= URL ?>assets/img/fundo-cadastro.jpg);"></div>
    </section>


    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>