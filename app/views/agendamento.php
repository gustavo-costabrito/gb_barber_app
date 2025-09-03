<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <main>
        <section class="agendamento">
            <div class="site">
                <div class="tituloTela">
                    <img src="<?= URL ?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
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
                                <?php foreach ($servicos as $atributos) : ?>
                                    <div class="servicoCombo1">
                                        <span class="selecionar">
                                            <div id="selecionado"></div>
                                        </span>
                                        <div class="nomeValorAgendamento">
                                            <h3><?= $atributos['nome_servico'] ?? $atributos['nome_combo']?></h3>
                                            <h4>R$<?= $atributos['valor_servico'] ?? $atributos['valor_combo']?></h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="dataAgendamento">
                            <label for="data">Data para agendamento:</label>
                            <select name="dataAgendamento" id="dataAgendamento" class="dataAdatagendamento" style="max-height: 5rem;">
                                <option value="0" selected>Selecione uma data:</option>
                                <?php foreach ($datas as $atributos) : ?>
                                    <option value="<?= $atributos['id_data'] ?>">
                                        <?php
                                        $data = $atributos['nome_data'];

                                        $data = explode('-', $data, 3);

                                        $data = array_reverse($data);

                                        $data = implode('/', $data);

                                        echo $data;
                                        ?>
                                    </option>
                                <?php endforeach ?>
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