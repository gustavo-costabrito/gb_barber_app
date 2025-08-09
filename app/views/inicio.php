<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <main>
        <section class="banner" style="background-image: url(<?= URL?>assets/img/fundo-banner.jpg);">
            <div class="site">
                <h2>
                    Seja bem vindo,
                    Gustavo Costa
                </h2>
                <div class="banner__content">
                    <h3>Descubra o melhor serviço de barbearia na <span>GB BARBER</span></h3>
                    <button type="button">Fazer agendamento</button>
                </div>
            </div>
        </section>

        <section class="carrosel">
            <div class="site">
                <div class="carrosel_1">
                    <h2>Principais Serviços</h2>
                    <span>Principais Serviços</span>
                </div>
                <div class="carrosel_2">
                    <h2>Principais Serviços</h2>
                    <span>Principais Serviços</span>
                </div>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>