<!DOCTYPE html>
<html lang="pt-br">
<?php require_once('includes/head.php') ?>

<body>
    <?php require_once('includes/header.php') ?>

    <section class="servicos-todos">
        <div class="site">
            <img id="inicio" style="height: 35px;width: 35px;padding: 5px 15px;" src="<?= URL ?>assets/img/voltar.png" alt="">
            <div>
                <h2 style="color: #fff; text-align: center;font-size: var(--font-principal);">Todos os nossos <span style="color: #BE4949;">servicos</span></h2>
            </div>

            <?php foreach ($servicos as $atributos) : ?>
                <?php extract($atributos)?>
                <div class="container-todos-servicos">
                    <div class="box-detalhe-servico" style="background-image: url(<?= URL ?>assets/img/<?= $imagem_combo ?? $imagem_servico?>);">
                        <h2><?= $nome_combo ?? $nome_servico?></h2>
                        <p><?= $descricao_combo ?? $descricao_servico?></p>
                        <button type="button" class="button-todos-servicos" id="detalheServico" data-id="<?= $id_combo + 3 ?? $id_servico?>">Ver detalhe</button>
                    </div>
                </div>
            <?php endforeach?>
        </div>
    </section>


    <script>
        document.getElementById("inicio").addEventListener("click", () => {
            window.location.href = "<?= URL ?>menu";
        });
    </script>

    <?php require_once('includes/footer.php') ?>

</body>

</html>