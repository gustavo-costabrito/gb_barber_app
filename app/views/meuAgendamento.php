<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <main>
        <section class="meuAgendamento">
            <div class="site">
                <div class="tituloTela">
                    <div>
                        <img src="<?= URL ?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
                        <h2>Meus <span>agendamentos:</span></h2>
                    </div>
                </div>
                <div class="conteudoMeuAgendamento">

                    <?php if (!empty($agendamentos) || !is_array($agendamentos)) : ?>
                        <?php foreach ($agendamentos as $atributos) : ?>
                            <div class="caixaAgendamento <?= $atributos['status_agendamento'] !== 'Aguardando' ? 'concluido' : ''?>">
                                <div class="caixaAgendamento__dadosCliente">
                                    <h2><?= $atributos['nome_cliente']?></h2>
                                    <h3><?= $atributos['email_cliente']?></h3>
                                    <h3><?= $atributos['whatsapp_cliente']?></h3>
                                    <p><span>Valor do agendamento: </span>R$ <?= $atributos['valor_servico'] ?? $atributos['valor_combo']?></p>
                                    <button type="button">Cancelar</button>
                                </div>
                                <div class="caixaAgendamento__dadosServico">
                                    <div class="caixaAgendamento__status">
                                        <img src="" alt="">
                                        <span><?= $atributos['status_agendamento']?></span>
                                    </div>
                                    <div class="caixaAgendamento__servicoData">
                                        <div class="__servicoData__servico">
                                            <h3>Serviço agendado:</h3>
                                            <p><?= $atributos['nome_servico'] ?? $atributos['nome_combo']?> - R$<?= $atributos['valor_servico'] ?? $atributos['valor_combo']?></p>
                                        </div>
                                        <h3><?= $atributos['nome_data']?>, ás <?= $atributos['hora_inicio']?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach?>
                    <?php endif ?>
                </div>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>