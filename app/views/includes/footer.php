<footer>
    <div class="site">
        <nav>
            <ul>
                <li id="inicio" style="cursor: pointer;">
                    <img src="<?= URL ?>assets/img/casa.png" alt="">
                    <p>Inicio</p>
                </li>
                <li id="agendamento" style="cursor: pointer;">
                    <img src="<?= URL ?>assets/img/agenda.png" alt="">
                    <p>Agendamentos</p>
                </li>
                <li id="perguntas" style="cursor: pointer;">
                    <img src="<?= URL ?>assets/img/perguntando.png" alt="">
                    <p>Perguntas</p>
                </li>
                <li id="servicos" style="cursor: pointer;">
                    <img src="<?= URL ?>assets/img/aplicativos.png" alt="">
                    <p>Serviços</p>
                </li>
            </ul>
        </nav>
    </div>
</footer>

<script>
    document.getElementById('inicio').addEventListener('click', function(){
        window.location.href = "<?= URL?>inicio";
    });

    document.getElementById('agendamento').addEventListener('click', function(){
        window.location.href = "<?= URL?>agendamento/meus_agendamentos";
    });
    
    document.getElementById('perguntas').addEventListener('click', function(){
        window.location.href = "<?= URL?>perguntas";
    });

    document.getElementById('servicos').addEventListener('click', function(){
        window.location.href = "<?= URL?>servicos";
    });
</script>