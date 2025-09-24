<!DOCTYPE html>
<html lang="en">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <header class="yes-login">
        <div class="site">
            <h2>GB-Barbearia</h2>
            <img src="<?= URL ?>assets/img/fechar.png" alt="Botão de voltar para página anterior" id="fechar">
        </div>
    </header>

    <section id="hidden" class="menu">
        <div class="site">
            <div class="conteiner-menu">
                <div class="box-menu" data-url="info">
                    <img src="<?= URL ?>assets/img/perfil.png" alt="">
                    <h2>Informações privativas</h2>
                </div>

                <div class="box-menu" data-url="agendamento/meus_agendamentos">
                    <img src="<?= URL ?>assets/img/calendario.png" alt="">
                    <h2>Meus agendamentos</h2>
                </div>

                <div class="box-menu" data-url="perguntas">
                    <img src="<?= URL ?>assets/img/perguntas.png" alt="">
                    <h2>Minhas perguntas</h2>
                </div>

                <div class="box-menu" data-url="notificacao">
                    <img src="<?= URL ?>assets/img/notificacao.png" alt="">
                    <h2>Minhas notificações</h2>
                </div>


                <button class="button-menu">
                    <img style="width: 25px; height: 25px; padding: 2px 5px;" src="<?= URL ?>assets/img/logout.png" alt="">
                    <a class="link-button-menu" style="color: #FFFFFF;text-decoration: none;line-height: 33px;padding: 1px 9px;" href="<?= URL ?>menu/logout">Sair da Conta</a>
                </button>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('fechar').addEventListener('click', function(){
            history.back();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const menu = document.querySelectorAll('.box-menu');

            menu.forEach((valor) => {
                valor.addEventListener('click', function(){
                    const url = this.dataset.url;

                    window.location.href = `<?= URL?>${url}`;
                });
            });
        });
    </script>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>
</body>

</html>