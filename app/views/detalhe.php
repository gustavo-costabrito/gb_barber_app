<?php extract($detalhe); ?>

<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <main>
        <section class="detalhe">
            <div class="site">
                <div class="tituloTela">
                    <img src="<?= URL ?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
                    <h2>Saiba mais sobre esse <span>servico:</span></h2>
                </div>
                <div class="conteudoDetalhe">
                    <div class="servicoCombo" style="background-image: url(<?= URL ?>assets/img/<?= $imagem_combo ?? $imagem_servico ?>);">
                        <p><?= $descricao_combo ?? $descricao_servico ?></p>
                        <div class="nomeValor">
                            <h2><?= $nome_combo ?? $nome_servico ?></h2>
                            <h3>R$<?= $valor_combo ?? $valor_servico ?></h3>
                        </div>
                        <button type="button">Agendar Servico</button>
                        <div class="fundoServicoCombo"></div>
                    </div>
                    <button type="button">Veja mais</button>
                </div>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>