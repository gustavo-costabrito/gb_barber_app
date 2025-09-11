<header class="yes-login">
    <div class="site">
        <h2>GB-Barbearia</h2>
        <img src="<?= URL?>assets/img/barra-de-menu.png" alt="Barra de menu" id="menu">
    </div>
</header>

<script>
    document.getElementById('menu').addEventListener('click', function(){
        window.location.href = "<?= URL?>menu";
    });
</script>