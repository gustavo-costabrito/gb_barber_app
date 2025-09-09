<!DOCTYPE html>
<html lang="en">
<?php require_once('includes/head.php') ?>

<body>
    <?php require_once('includes/header.php') ?>

    <section class="servicos-todos">
        <div class="site">
            <img id="inicio" style="height: 35px;width: 35px;padding: 5px 15px;" src="<?= URL ?>assets/img/voltar.png" alt="">
            <div>
                <h2 style="color: #fff; text-align: center;font-size: var(--font-principal);">Todos os nossos <span style="color: #BE4949;">servicos</span></h2>
            </div>
            <div class="container-todos-servicos">
                <div class="box-detalhe-servico" style="background-image: url(<?= URL ?>assets/img/barba.jpg);">
                    <h2>Corte Rápido</h2>
                    <p>Lorem ipsum dolor sit amet consectetur is pariatur eaque ullam quidem eligendi tempore deleniti amet fugit qui id.</p>
                    <button class="button-todos-servicos">Ver detalhe</button>


                </div>
            </div>
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