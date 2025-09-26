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
                    <form action="" method="post" id="form_agendamento">
                        <div class="nomeAgendamento">
                            <label for="nomeAgendamento">Nome:</label>
                            <input type="text" name="nomeAgendamento" value="<?= $dadosLogin['nome'] ?>" placeholder="Seu Nome Completo" id="nomeAgendamento" disabled>
                        </div>
                        <div class="emailAgendamento">
                            <label for="emailAgendamento">E-mail:</label>
                            <input type="email" name="emailAgendamento" value="<?= $dadosLogin['email'] ?>" placeholder="seuemail@domínio.com" id="emailAgendamento" disabled>
                        </div>
                        <div class="whatsappAgendamento">
                            <label for="whatsappAgendamento">Whatsapp:</label>
                            <input type="tel" name="whatsappAgendamento" value="<?= $dadosLogin['whatsapp'] ?>" placeholder="(xx) xxxxx-xxxx" id="whatsappAgendamento" disabled>
                        </div>
                        <div class="servicoAgendamento">
                            <h2>Selecione um serviço para o seu <span>agendamento:</span></h2>
                            <div class="servicosCombos">
                                <?php foreach ($servicos as $atributos) : ?>
                                    <div class="servicoCombo1" style="background-image: url(<?= URL_UPLOAD?><?= $atributos['imagem_combo'] ?? $atributos['imagem_servico']?>);">
                                        <div class="nomeValorAgendamento">
                                            <h3><?= $atributos['nome_servico'] ?? $atributos['nome_combo'] ?></h3>
                                            <h4>R$<?= $atributos['valor_servico'] ?? $atributos['valor_combo'] ?></h4>
                                        </div>
                                        <input type="radio" class="selecionar" name="servico" id="selecionar" value="<?= $atributos['id_servico'] ?? $atributos['id_combo'] + 3?>">
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

    <!-- AJAX -->
    <script>
        document.getElementById('dataAgendamento').addEventListener('change', function() {
            const id = this.value;

            fetch(`<?= URL ?>agendamento/listar_horarios_data/${parseInt(id)}`)

                .then(response => response.text())
                .then(data => {
                    if (data.includes("Erro")) {
                        alert(data);
                    } else {
                        let horario = document.getElementById('horarioAgendamento');

                        horario.innerHTML = data;
                    }

                })

                .catch(error => {
                    alert(error);
                    console.error(error);
                })
        });
    </script>


    <script>
        document.getElementById('form_agendamento').addEventListener('submit', function(event){
            event.preventDefault();

            const form = new FormData(event.target);

            fetch(`<?= URL?>agendamento/adicionar_agendamento`, {
                method: event.target.method,
                body: form
            })

            .then(response => response.json())
            .then(data => {
                if(data.error){
                    alert(data.error);
                    console.log(data);
                } else {
                    alert(data.sucesso);
                    console.log(data);
                }
            })

            .catch(error => {
                console.error(error);
            })
        });
    </script>
</body>

</html>