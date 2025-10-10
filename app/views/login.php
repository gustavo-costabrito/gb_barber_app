<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

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
                            <input type="email" name="emailLogin" placeholder="seuemail@dominio.com" id="emailLogin" required>
                        </div>
                        <div class="__content__senha">
                            <div class="__senha__label">
                                <label for="senhaLogin" id="labelLogin">Senha:</label>
                                <div class="__senha__whatsapp">
                                    <button type="button" class="ativo" id="buttonSenha">Senha</button>
                                    <button type="button" class="inativo" id="buttonWhatsapp">Whatsapp</button>
                                </div>
                            </div>
                            <input type="password" placeholder="senha123..." name="senhaLogin" id="senhaLogin" required>
                        </div>
                        <div class="__content__button">
                            <a href="<?= URL ?>cadastro">
                                <button type="button">Cadastrar</button>
                            </a>
                            <button type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <button id="btnInstalar">instalar</button>

        <div class="fundo-login" style="background-image: url(<?= URL ?>assets/img/fundo-login.jpg);"></div>
    </section>

    

    <!-- Javascript -->
    <script>
        document.getElementById('buttonSenha').addEventListener('click', function() {
            if (!this.classList.contains('ativo')) {
                this.className = 'ativo';

                document.getElementById('buttonWhatsapp').className = 'inativo';

                const label = document.getElementById('labelLogin');
                const input = document.getElementById('whatsappLogin');

                input.type = 'password';
                input.name = 'senhaLogin';
                input.id = 'senhaLogin';
                input.placeholder = 'senha123...';
                input.value = '';
                input.removeAttribute('maxlength');

                label.innerText = 'Senha:';

                formatacao();
            }
        });

        document.getElementById('buttonWhatsapp').addEventListener('click', function() {
            if (!this.classList.contains('ativo')) {
                this.className = 'ativo';

                document.getElementById('buttonSenha').className = 'inativo';

                const label = document.getElementById('labelLogin');
                const input = document.getElementById('senhaLogin');

                input.type = 'text';
                input.placeholder = '(xx) xxxxx-xxxx';
                input.name = 'whatsappLogin';
                input.id = 'whatsappLogin';
                input.value = '';
                input.setAttribute('maxlength', '15');

                label.innerText = 'Whatsapp:';

                formatacao();
            }
        });

        function formatacao() {
            if (document.getElementById('whatsappLogin')) {
                document.getElementById('whatsappLogin').addEventListener('input', function(event) {
                    let valor = event.target.value;

                    event.target.value = valor.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
                });
            }
        }
    </script>

    <!-- AJAX -->
    <script>
        document.getElementById('formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = new FormData(event.target);

            fetch(`<?= URL ?>login/logar`, {
                    method: event.target.method,
                    body: form
                })

                .then(response => response.text())
                .then(data => {
                    if (!data.includes('Sucesso')) {
                        alert(data);
                    } else {
                        window.location.href = `<?= URL ?>inicio`;
                    }
                })

                .catch(error => {
                    console.error(error);
                })
        });
    </script>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>