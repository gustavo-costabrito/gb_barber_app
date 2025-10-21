<!DOCTYPE html>
<html lang="pt-br">
<?php require_once('includes/head.php') ?>

<body>
    <?php require_once('includes/header.php') ?>

    <section class="servicos-todos">
        <div class="site">
            <div class="tituloTela">
                <div>
                    <img src="<?= URL ?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
                    <h2>Todos os <span>servicos:</span></h2>
                </div>
            </div>

            <?php foreach ($servicos as $atributos) : ?>
                <?php extract($atributos) ?>
                <div class="container-todos-servicos">
                    <div class="box-detalhe-servico" style="background-image: url(<?= URL_UPLOAD ?><?= $imagem_combo ?? $imagem_servico ?>);">
                        <h2><?= $nome_combo ?? $nome_servico ?></h2>
                        <p><?= $descricao_combo ?? $descricao_servico ?></p>
                        <button type="button" class="button-todos-servicos" data-name="<?= Controller::tratar_url($nome_combo ?? $nome_servico) ?>" id="detalheServico">Ver detalhe</button>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const URL = 'http://localhost/gb_barber_app/public/';

            document.querySelectorAll('.button-todos-servicos').forEach((valor) => {
                valor.addEventListener('click', function() {
                    const name = this.dataset.name;

                    window.location.href = `${URL}detalhe/servico/${name}`;
                });
            });
        });
    </script>

    <?php require_once('includes/footer.php') ?>

</body>

</html>