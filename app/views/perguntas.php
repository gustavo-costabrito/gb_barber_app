<!DOCTYPE html>
<html lang="en">
<?php require_once('includes/head.php') ?>

<body>
    <?php require_once('includes/header.php') ?>
    <section style="background-color: var(--cor-principal);" class="perguntas">
        <img id="inicio" style="height: 35px;width: 35px;padding: 5px 15px;" src="<?= URL ?>assets/img/voltar.png" alt="">
        <div class="site">
            <h2 style="color: #fff; font-size: var(--font-principal); text-align: center;padding: 3rem 1rem;">Minhas <span style="color: var(--cor-terciaria);">Perguntas</span></h2>

            <?php foreach ($perguntas as $atributos) : ?>
                <div class="container-perguntas">
                    <div class="tudo-info1" style="display: flex;">
                        <div class="info1-perguntas">
                            <ul>
                                <li class="nome-perguntas">Gustavo Costa Brito</li>
                                <li class="gmail-perguntas">gustavo@email.com</li>
                                <li class="telefone-perguntas">(11) 91887-3838</li>
                            </ul>
                        </div>
                        <div class="info2-perguntas">
                            <h2>10 dias atrás</h2>
                        </div>
                    </div>

                    <div class="info3-perguntas">
                        <h2>
                            Mensagem:<span style="color:rgb(121, 121, 121); font-size: 1.1rem ;"> Vocês têm horário disponivel para agora, ou só com agendamento?</span>
                        </h2>
                    </div>
                    <button class="exibir-perguntas" id="exibir-perguntas">
                        Exibir Resposta
                    </button>
                    <div style="padding: 1rem 1rem;" class="exibir-resposta" id="exibir-resposta">
                        <h2 style="font-size: var(--font-secundaria);margin-bottom: 10px;">Administrador</h2>
                        <h3 style="font-size: var(--font-terciaria);">Reposta: <span style="color:rgb(138, 138, 138);">Sim! Estamos funcionando normalmente, <br> pode vir!</span></h3>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>

    <script>
        const btn = document.getElementById('exibir-perguntas');
        const resposta = document.getElementById('exibir-resposta');

        btn.addEventListener("click", () => {
            if (resposta.style.display === "none" || resposta.style.display === "") {
                resposta.style.display = "block";
                btn.style.backgroundColor = "#BE4949";
                btn.style.color = "#fff";
                btn.style.fontSize = "1.1rem"
                btn.textContent = "Exibir Menos";
            } else {
                resposta.style.display = "none";
                btn.style.backgroundColor = "#fff"
                btn.style.color = "#BE4949";
                btn.textContent = "Exibir Resposta";
            }
        });
    </script>

    <script>
        document.getElementById("inicio").addEventListener("click", () => {
            window.location.href = "<?= URL ?>menu";
        });
    </script>
    <?php require_once('includes/footer.php') ?>
</body>

</html>