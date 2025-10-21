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
                    <div>
                        <img src="<?= URL ?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
                        <h2>Conheca esse <span>servico:</span></h2>
                    </div>
                </div>
                <div class="conteudoDetalhe">
                    <div class="servicoCombo" style="background-image: url(<?= URL_UPLOAD ?><?= $imagem_combo ?? $imagem_servico ?>);">
                        <p><?= $descricao_combo ?? $descricao_servico ?></p>
                        <div class="nomeValor">
                            <h2><?= $nome_combo ?? $nome_servico ?></h2>
                            <h3>R$<?= $valor_combo ?? $valor_servico ?></h3>
                        </div>
                        <div class="horaBtn" style="margin-top: 1rem;">
                            <h2>Tempo:
                                <?php

                                $tempo = str_replace(':', '', $tempo_estimado);

                                echo preg_replace('/(\d{2})(\d{2})(\d{2})$/', '$1h $2m $3s', $tempo);

                                ?>
                            </h2>
                            <button type="button">Agendar Servico</button>
                        </div>
                    </div>
                    <button type="button" id="veja-mais">Veja mais</button>
                </div>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <!-- JAVASCRIPT -->
    <script>
        document.getElementById('veja-mais').addEventListener('click', function() {
            window.location.href = `<?= URL ?>servicos`;
        });
    </script>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>