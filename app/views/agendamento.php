<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <main>
        <section class="agendamento">
            <div class="site">
                <div class="tituloTela">
                    <div>
                        <img src="<?= URL ?>assets/img/voltar.png" alt="Botão de voltar para página anterior" id="voltar">
                        <h2>Realizar <span>agendamento:</span></h2>
                    </div>
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
                                    <div class="servicoCombo1" style="background-image: url(<?= URL_UPLOAD ?><?= $atributos['imagem_combo'] ?? $atributos['imagem_servico'] ?>);">
                                        <div class="nomeValorAgendamento">
                                            <h3><?= $atributos['nome_servico'] ?? $atributos['nome_combo'] ?></h3>
                                            <h4>R$<?= $atributos['valor_servico'] ?? $atributos['valor_combo'] ?></h4>
                                        </div>
                                        <input type="radio" class="selecionar" name="servico" id="selecionar_<?= $atributos['id_servico'] ?? $atributos['id_combo'] ?>" value="<?= $atributos['id_servico'] ?? $atributos['id_combo'] + 3 ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="dataAgendamento">
                            <label for="data">Data para agendamento:</label>
                            <div class="custom-select" id="dataAgendamento">
                                <div class="select-selected">Selecione uma opção</div>
                                <div class="select-items">
                                    <?php foreach ($datas as $atributos) : ?>
                                        <div class="select-item" data-value="<?= $atributos['id_data'] ?>">
                                            <?php
                                            $data = str_replace('-', '', $atributos['nome_data']);
                                            echo preg_replace('/^(\d{4})(\d{2})(\d{2})$/', '$3/$2/$1', $data);
                                            ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <input type="hidden" name="dataAgendamento" id="inputDataAgendamento" value="">
                        </div>
                        <div class="horarioAgendamento">
                            <label for="horarioAgendamento">Horário:</label>
                            <div class="custom-select" id="horarioAgendamento">
                                <div class="select-selected">Selecione um horário</div>
                                <div class="select-items">
                                    <!-- Os horários serão inseridos aqui via AJAX -->
                                </div>
                            </div>
                            <input type="hidden" name="horarioAgendamento" id="inputHorarioAgendamento" value="">
                        </div>
                        <button type="submit">Realizar agendamento</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script src="<?= URL ?>assets/js/script.js"></script>

    <script>
        // --- SELECT DE DATA ---
        const selectData = document.getElementById('dataAgendamento');
        const selectedData = selectData.querySelector('.select-selected');
        const optionsData = selectData.querySelectorAll('.select-item');
        const inputDataAgendamento = document.getElementById('inputDataAgendamento');

        selectedData.addEventListener('click', () => {
            selectData.classList.toggle('open');
        });

        optionsData.forEach(option => {
            option.addEventListener('click', () => {
                const id = option.dataset.value;
                selectedData.textContent = option.textContent;
                inputDataAgendamento.value = id;
                selectData.classList.remove('open');

                // Reseta o select de horário
                const horarioSelected = document.querySelector('#horarioAgendamento .select-selected');
                horarioSelected.textContent = 'Selecione um horário';
                document.getElementById('inputHorarioAgendamento').value = '';

                // --- CHAMADA AJAX PARA LISTAR HORÁRIOS ---
                fetch(`<?= URL ?>agendamento/listar_horarios_data/${parseInt(id)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.erro) {
                            mostrarAlerta(data.erro, 'error');
                            return;
                        }

                        const horarioSelectItems = document.querySelector('#horarioAgendamento .select-items');

                        // Limpa os horários anteriores
                        horarioSelectItems.innerHTML = '';

                        // Adiciona os novos horários
                        data.forEach(horario => {
                            const selectItem = document.createElement('div');
                            selectItem.classList.add('select-item');
                            selectItem.dataset.value = horario.id_data_horario;
                            selectItem.textContent = horario.hora_inicio;

                            // Adiciona evento de clique para cada horário
                            selectItem.addEventListener('click', () => {
                                const horarioSelected = document.querySelector('#horarioAgendamento .select-selected');
                                const inputHorarioAgendamento = document.getElementById('inputHorarioAgendamento');

                                horarioSelected.textContent = selectItem.textContent;
                                inputHorarioAgendamento.value = horario.id_data_horario;
                                selectHorario.classList.remove('open');
                            });

                            horarioSelectItems.appendChild(selectItem);
                        });
                    })
                    .catch(error => {
                        console.error("Erro:", error);
                        mostrarAlerta('Erro ao carregar horários', 'error');
                    });
            });
        });

        // --- SELECT DE HORÁRIO ---
        const selectHorario = document.getElementById('horarioAgendamento');
        const selectedHorario = selectHorario.querySelector('.select-selected');

        selectedHorario.addEventListener('click', () => {
            selectHorario.classList.toggle('open');
        });

        // Fecha todos ao clicar fora
        window.addEventListener('click', (e) => {
            document.querySelectorAll('.custom-select').forEach(sel => {
                if (!sel.contains(e.target)) {
                    sel.classList.remove('open');
                }
            });
        });

        // --- ENVIO DO FORMULÁRIO ---
        document.getElementById('form_agendamento').addEventListener('submit', function(e) {
            e.preventDefault();

            const horarioAgendamento = document.getElementById('inputHorarioAgendamento').value;
            const servicoRadio = document.querySelector('input[name="servico"]:checked');

            // Validação no front-end
            if (!servicoRadio) {
                mostrarAlerta('Por favor, selecione um serviço', 'error');
                return;
            }

            if (!horarioAgendamento) {
                mostrarAlerta('Por favor, selecione um horário', 'error');
                return;
            }

            // Cria o FormData
            const formData = new FormData();
            formData.append('horarioAgendamento', horarioAgendamento);
            formData.append('servico', servicoRadio.value);

            // Envia via AJAX
            fetch('<?= URL ?>agendamento/adicionar_agendamento', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        mostrarAlerta(data.error, 'error');
                        return;
                    }

                    if (data.sucesso) {
                        mostrarAlerta(data.sucesso);

                        // Reseta o formulário
                        document.getElementById('form_agendamento').reset();
                        document.querySelector('#dataAgendamento .select-selected').textContent = 'Selecione uma opção';
                        document.querySelector('#horarioAgendamento .select-selected').textContent = 'Selecione um horário';

                        // Limpa os horários
                        document.querySelector('#horarioAgendamento .select-items').innerHTML = '';

                        // Limpa os inputs hidden
                        document.getElementById('inputDataAgendamento').value = '';
                        document.getElementById('inputHorarioAgendamento').value = '';

                        // Redireciona ou atualiza a página após 2 segundos
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    mostrarAlerta('Erro ao processar agendamento', 'error');
                });
        });

        // --- BOTÃO VOLTAR ---
        document.getElementById('voltar').addEventListener('click', function() {
            window.history.back();
        });
    </script>
</body>

</html>