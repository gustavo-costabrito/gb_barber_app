<!DOCTYPE html>
<html lang="en">
<?php require_once(__DIR__ . '/includes/head.php') ?>

<body>
    <?php require_once(__DIR__ . '/includes/header.php') ?>

    <section class="notificacoes">
        <div class="site">
            <div>
                <div>
                    <h2 class="tt-notificacoes">
                        Suas <span style="color: var(--cor-terciaria);">Notificações</span>
                    </h2>
                </div>
                <div class="buttons-noti">
                    <button id="button1-noti">
                        Não lidas
                    </button>

                    <button id="button2-noti">
                        Lidas
                    </button>
                </div>

                <?php if (is_array($notificacaoNaoLidas) && !isset($notificacaoNaoLidas['error'])) : ?>
                    <?php foreach ($notificacaoNaoLidas as $atributos) : ?>
                        <div class="container-perguntas1" id="conatiner1-noti" style="margin-top: 50px;box-shadow: 0px 2px 10px var(--cor-terciaria); border-radius: 20px; padding: 1rem;">
                            <div class="tudo-info1" style="display: flex;">

                                <div class="info1-perguntas">
                                    <ul>
                                        <li class="nome-perguntas" style="margin-bottom: 5px;"><?= $atributos['tipo_notificacao']?>:</li>
                                        <li class="gmail-perguntas"></li>
                                        <li class="telefone-perguntas"><?= $atributos['data_notificacao']?></li>
                                    </ul>
                                </div>
                                <div class="info2-perguntas">
                                    <h2></h2>
                                </div>
                            </div>

                            <div class="info3-perguntas">
                                <h2 style="padding: 0rem 0.8rem;">
                                    Mensagem:<span style="color:rgb(121, 121, 121); font-size: 1.1rem ;"> <?php 
                                        
                                        if($atributos['tipo_notificacao'] === 'Atualizado' && $atributos['tabela_afetada'] === 'tbl_cliente'){
                                            echo "Cadastro atualizado com sucesso";
                                        }

                                        if($atributos['tipo_notificacao'] === 'Adicionado' && $atributos['tabela_afetada'] === 'tbl_comentario'){
                                            echo "Comentario adicionado com sucesso";
                                        }

                                        if($atributos['tipo_notificacao'] === 'Adicionado' && $atributos['tabela_afetada'] === 'tbl_agendamento'){
                                            echo "Agendamento realizado com sucesso";
                                        }

                                        ?></span>
                                </h2>
                            </div>


                            <button class="exibir-perguntas1 btnLido" style="border-radius: 10px;outline: none;border: none;padding: .5rem .8rem;color: var(--cor-secundaria);background: var(--cor-terciaria);margin-top: 2rem;margin-left: 125px;" data-id="<?= $atributos['id_notificacao']?>" id="exibir">
                                Marcar como lido ✓
                            </button>


                            <div style="padding: 1rem 1rem;" class="exibir-resposta" id="exibir-resposta">
                                <h2 style="font-size: var(--font-secundaria);margin-bottom: 10px;">Administrador</h2>
                                <h3 style="font-size: var(--font-terciaria);">Reposta: <span style="color:rgb(138, 138, 138);">Sim! Estamos funcionando normalmente, <br> pode vir!</span></h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>

                <?php if (is_array($notificacaoLidas) && !isset($notificacaoLidas['error'])) : ?>
                    <?php foreach ($notificacaoLidas as $atributos) : ?>
                        <div class="container-perguntas2" id="conatiner2-noti" hidden style="margin-top: 50px;box-shadow: 0px 2px 10px var(--cor-terciaria); border-radius: 20px; padding: 1rem;">
                            <div class="tudo-info1" style="display: flex;">
                                <div class="info1-perguntas">
                                    <ul>
                                        <li class="nome-perguntas" style="margin-bottom: 5px;"><?= $atributos['tipo_notificacao']?>:</li>
                                        <li class="gmail-perguntas"><?= $atributos['data_notificacao']?></li>
                                        <li class="telefone-perguntas"><?php 
                                        
                                        if($atributos['tabela_afetada'] === 'tbl_cliente'){
                                            echo "Cadastro";
                                        }

                                        if($atributos['tabela_afetada'] === 'tbl_comentario'){
                                            echo "Comentario";
                                        }

                                        if($atributos['tabela_afetada'] === 'tbl_agendamento'){
                                            echo "Agendamento";
                                        }
                                        
                                        ?></li>
                                    </ul>
                                </div>
                                <div class="info2-perguntas">
                                    <h2>Visto ✓</h2>
                                </div>
                            </div>

                            <div class="info3-perguntas">
                                <h2 style="padding: 0rem 0.8rem; margin-top: 20px;">
                                    Mensagem:<span style="color:rgb(121, 121, 121); font-size: 1.1rem ;"> <?php 
                                    
                                    if($atributos['tipo_notificacao'] === 'Atualizado' && $atributos['tabela_afetada'] === 'tbl_cliente'){
                                            echo "Cadastro atualizado com sucesso";
                                        }

                                        if($atributos['tipo_notificacao'] === 'Adicionado' && $atributos['tabela_afetada'] === 'tbl_comentario'){
                                            echo "Comentario adicionado com sucesso";
                                        }

                                        if($atributos['tipo_notificacao'] === 'Adicionado' && $atributos['tabela_afetada'] === 'tbl_agendamento'){
                                            echo "Agendamento realizado com sucesso";
                                        }
                                    
                                    ?></span>
                                </h2>
                            </div>
                            <div style="padding: 1rem 1rem;" class="exibir-resposta" id="exibir-resposta">
                                <h2 style="font-size: var(--font-secundaria);margin-bottom: 10px;">Administrador</h2>
                                <h3 style="font-size: var(--font-terciaria);">Reposta: <span style="color:rgb(138, 138, 138);">Sim! Estamos funcionando normalmente, <br> pode vir!</span></h3>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>

            </div>
        </div>
    </section>


    <?php require_once(__DIR__ . '/includes/footer.php') ?>

    <script>
        const butao1 = document.getElementById('button1-noti');
        const butao2 = document.getElementById('button2-noti');
        const caixa1 = document.querySelectorAll('.container-perguntas1');
        const caixa2 = document.querySelectorAll('.container-perguntas2');

        butao1.addEventListener('click', () => {
            caixa2.forEach(box2 => {
                box2.hidden = true
            })
            caixa1.forEach(box1 => {
                box1.hidden = false
            })
        })

        butao2.addEventListener('click', () => {
            caixa1.forEach(box1 => {
                box1.hidden = true
            })
            caixa2.forEach(box2 => {
                box2.hidden = false
            })
        })

        document.querySelectorAll('.exibir-perguntas1').forEach(confere => {
            confere.addEventListener('click', () => {
                confere.textContent = 'Marcado como lido'
            })
        })
    </script>

    <!-- AJAX -->
     <script>
        const btn = document.querySelectorAll('.btnLido');

        btn.forEach((valor) => {
            valor.addEventListener('click', function(){
                const id = this.dataset.id;

                fetch(`<?= URL?>notificacoes/marcar_lida/${id}`, {
                    method: 'PATCH'
                })

                .then(response => response.json())
                .then(data => {
                    if(!data.sucesso){
                        mostrarAlerta(data.error, 'error');
                        console.log(data);
                    } else {
                        mostrarAlerta(data.sucesso);
                    }
                })
            });
        });
     </script>
</body>

</html>