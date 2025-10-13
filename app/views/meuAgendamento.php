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
                    <div class="caixaAgendamento concluido">
                        <div class="caixaAgendamento__dadosCliente">
                            <h2>Gustavo Costa Brito</h2>
                            <h3>gustavo@email.com</h3>
                            <h3>(11) 91295-4343</h3>
                            <p><span>Valor do agendamento: </span>R$60,00</p>
                            <button type="button">Cancelar</button>
                        </div>
                        <div class="caixaAgendamento__dadosServico">
                            <div class="caixaAgendamento__status">
                                <img src="" alt="">
                                <span>Realizado</span>
                            </div>
                            <div class="caixaAgendamento__servicoData">
                                <div class="__servicoData__servico">
                                    <h3>Serviço agendado:</h3>
                                    <p>Corte Rápido + Sobrancelha + Barba - R$20,00</p>
                                </div>
                                <h3>03/08/2025, ás 10:30 até 12:00</h3>
                            </div>
                        </div>
                    </div>
                    <div class="caixaAgendamento">
                        <div class="caixaAgendamento__dadosCliente">
                            <h2>Gustavo Costa Brito</h2>
                            <h3>gustavo@email.com</h3>
                            <h3>(11) 91295-4343</h3>
                            <p><span>Valor do agendamento: </span>R$60,00</p>
                            <button type="button">Cancelar</button>
                        </div>
                        <div class="caixaAgendamento__dadosServico">
                            <div class="caixaAgendamento__status">
                                <img src="" alt="">
                                <span>Aguardando</span>
                            </div>
                            <div class="caixaAgendamento__servicoData">
                                <div class="__servicoData__servico">
                                    <h3>Serviço agendado:</h3>
                                    <p>Corte Rápido + Sobrancelha + Barba - R$20,00</p>
                                </div>
                                <h3>03/08/2025, ás 10:30 até 12:00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>