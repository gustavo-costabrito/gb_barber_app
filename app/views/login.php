<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php')?>
<body>
    <header class="not-login">
        <div class="site">
            <h1>GB-Barbearia</h1>
        </div>
    </header>

    <section class="login">
        <div class="site">
            <div class="form-login">
                <div class="form-login__title">
                    <h2>Faça <span>login</span> conosco para ter acesso á uma experiência <span>completa</span></h2>
                </div>
                <div class="form-login__content">
                    <form action="" method="post" id="formLogin">
                        <div class="__content__email">
                            <label for="emailLogin">E-mail:</label>
                            <input type="email" name="emailLogin" placeholder="seuemail@dominio.com" id="emailLogin">
                        </div>
                        <div class="__content__senha">
                            <div class="__senha__label">
                                <label for="senhaLogin">Senha:</label>
                                <div class="__senha__whatsapp">
                                    <button type="button">Senha</button>
                                    <button type="button">Whatsapp</button>
                                </div>
                            </div>
                            <input type="password" placeholder="senha123..." name="senhaLogin" id="senhaLogin">
                        </div>
                        <div class="__content__button">
                            <a href="<?= URL?>cadastro">
                                <button type="button">Cadastrar</button>
                            </a>
                            <button type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="fundo-login" style="background-image: url(<?= URL?>assets/img/fundo-login.jpg);"></div>
    </section>

    <!-- AJAX -->
    <script>
        document.getElementById('formLogin').addEventListener('submit', function(e){
            e.preventDefault();

            const form = e.target;
            const input = new FormData(form);

            fetch(`<?= URL?>login/logar`, {
                method: form.method,
                body: input
            })

            .then(response => response.json())
            .then(data => {
                console.log(data)
            })

            .catch(error => {
                alert(error);
                console.error(error);
            })
        });
    </script>

    <script src="<?= URL?>assets/js/script.js"></script>
</body>
</html>