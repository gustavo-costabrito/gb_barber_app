<footer>
    <div class="site">
        <nav>
            <ul>
                <li id="inicio">
                    <img src="<?= URL ?>assets/img/casa.png" alt="">
                    <p>Inicio</p>
                </li>
                <li>
                    <img src="<?= URL ?>assets/img/agenda.png" alt="">
                    <p>Agendamentos</p>
                </li>
                <li>
                    <img src="<?= URL ?>assets/img/perguntando.png" alt="">
                    <p>Perguntas</p>
                </li>
                <li>
                    <img src="<?= URL ?>assets/img/aplicativos.png" alt="">
                    <p>Servicos</p>
                </li>
            </ul>
        </nav>
    </div>
</footer>

<script>
    document.getElementById('inicio').addEventListener('click', function(){
        window.location.href = "<?= URL?>inicio";
    });
</script>