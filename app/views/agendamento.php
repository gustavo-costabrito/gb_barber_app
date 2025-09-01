<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <main>
        <section class="agendamento">
            <div class="site">
                <div class="tituloTela">
                    <img src="<?= URL?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
                    <h2>Faça seu <span>agendamento:</span></h2>
                </div>
                <div class="conteudoAgendamento">
                    <form action="" method="post">
                        <div class="nomeAgendamento">
                            <label for="nomeAgendamento">Nome:</label>
                            <input type="text" name="nomeAgendamento" placeholder="Seu Nome Completo" id="nomeAgendamento">
                        </div>
                        <div class="emailAgendamento">
                            <label for="emailAgendamento">E-mail:</label>
                            <input type="email" name="emailAgendamento" placeholder="seuemail@domínio.com" id="emailAgendamento">
                        </div>
                        <div class="whatsappAgendamento">
                            <label for="whatsappAgendamento">Whatsapp:</label>
                            <input type="tel" name="whatsappAgendamento" placeholder="(xx) xxxxx-xxxx" id="whatsappAgendamento">
                        </div>
                        <div class="servicoAgendamento">
                            <h2>Selecione um serviço para o seu <span>agendamento:</span></h2>
                            <div class="servicosCombos">
                                <div class="servicoCombo1">
                                    <span class="selecionar"></span>
                                    <div class="nomeValorAgendamento">
                                        <h3>Nome</h3>
                                        <h4>R$</h4>
                                    </div>
                                </div>
                                <div class="servicoCombo2">
                                    <span class="selecionar"></span>
                                    <div class="nomeValorAgendamento">
                                        <h3></h3>
                                        <h4>R$</h4>
                                    </div>
                                </div>
                                <div class="servicoCombo3">
                                    <span class="selecionar"></span>
                                    <div class="nomeValorAgendamento">
                                        <h3></h3>
                                        <h4>R$</h4>
                                    </div>
                                </div>
                                <div class="servicoCombo4">
                                    <span class="selecionar"></span>
                                    <div class="nomeValorAgendamento">
                                        <h3></h3>
                                        <h4>R$</h4>
                                    </div>
                                </div>
                                <div class="servicoCombo5">
                                    <span class="selecionar"></span>
                                    <div class="nomeValorAgendamento">
                                        <h3></h3>
                                        <h4>R$</h4>
                                    </div>
                                </div>
                                <div class="servicoCombo6">
                                    <span class="selecionar"></span>
                                    <div class="nomeValorAgendamento">
                                        <h3></h3>
                                        <h4>R$</h4>
                                    </div>
                                </div>
                                <div class="servicoCombo7">
                                    <span class="selecionar"></span>
                                    <div class="nomeValorAgendamento">
                                        <h3></h3>
                                        <h4>R$</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dataAgendamento">
                            <label for="data">Data para agendamento:</label>
                            <select name="dataAgendamento" id="dataAgendamento" class="dataAdatagendamento">
                                <option value="0" selected>Selecione uma data:</option>
                                <option value="2">teste</option>
                            </select>
                        </div>
                        <div class="horarioAgendamento">
                            <label for="horarioAgendamento">Horário:</label>
                            <select name="horarioAgendamento" id="horarioAgendamento" class="horario" disabled>
                                <option value="0" id="horarioPadrao" selected>Data não definida</option>
                            </select>
                        </div>
                        <button type="submit">Realizar agendamento</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>