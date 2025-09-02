<?php

if(!isset($_SESSION['login'])){
    header('Location: ' . URL . 'login');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <main>
        <section class="banner" style="background-image: url(<?= URL ?>assets/img/fundo-banner.jpg);">
            <div class="site">
                <h2>
                    Seja bem vindo,
                    <?php
                    
                    $nome = str_word_count($dadosLogin['nome'], 1);

                    $nomeExibido = [
                        $nome[0],
                        $nome[1]
                    ];

                    echo implode(' ', $nomeExibido);
                    
                    ?>
                </h2>
                <div class="banner__content">
                    <h3>Descubra o melhor serviço de barbearia na <span>GB BARBER</span></h3>
                    <button type="button">Fazer agendamento</button>
                </div>
            </div>
        </section>

        <section class="carrosel">
            <div class="site">
                <div class="carrosel">
                    <h2>Principais Serviços</h2>
                    <span>Principais Serviços</span>
                </div>
            </div>
        </section>

        <section class="servicos">
            <div class="site">
                <?php foreach ($servicos as $atributo) : ?>
                    <?php extract($atributo) ?>
                    <div class="servico" data-name="<?= Controller::tratar_url($nome_combo ?? $nome_servico)?>" style="background-image: url(<?= URL ?>assets/img/<?= $imagem_combo ?? $imagem_servico ?>);">
                        <div class="texto-servico">
                            <h2><?= $nome_combo ?? $nome_servico ?></h2>
                            <h3>R$<?= $valor_combo ?? $valor_servico ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <script>
            document.querySelectorAll('.servico').forEach((servico) => {
                servico.addEventListener('click', function(){
                    const nome = this.dataset.name;

                    window.location.href = `<?= URL?>detalhe/servico/${nome}`;
                })
            })
        </script>

        <section class="contato">
            <div class="site">
                <h2>Tem uma duvida?<span> Fale Conosco</span></h2>
                <form action="" method="post">
                    <div class="nomeContato">
                        <label for="nomeContato">Nome:</label>
                        <input type="text" placeholder="Seu Nome Completo" value="<?= $dadosLogin['nome']?>" name="nomeContato" id="nomeContato" disabled>
                    </div>
                    <div class="emailContato">
                        <label for="emailContato">E-mail:</label>
                        <input type="text" placeholder="seuemail@dominio.com" value="<?= $dadosLogin['email']?>" name="emailContato" id="emailContato" disabled>
                    </div>
                    <div class="whatsappContato">
                        <label for="whatsappContato">Whatsapp:</label>
                        <input type="text" placeholder="(00) 00000-0000" value="<?= $dadosLogin['whatsapp']?>" name="whatsappContato" id="whatsappContato" disabled>
                    </div>
                    <div class="mensagemContato">
                        <label for="mensagemContato">Mensagem:</label>
                        <textarea name="mensagemContato" placeholder="Sua mensagem que sera respondida..." id="mensagemContato"></textarea>
                    </div>
                    <div class="btnEnviarLimpar">
                        <p id="limparForm">Limpar todos os campos</p>
                        <button type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script src="<?= URL ?>assets/js/script.js"></script>
</body>

</html>