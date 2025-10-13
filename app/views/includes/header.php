<header class="yes-login">
    <div class="site">
        <h2>GB-Barbearia</h2>
        <img src="<?= URL ?>assets/img/barra-de-menu.png" alt="Barra de menu" id="menu">
    </div>
</header>

<script>
    document.getElementById('menu').addEventListener('click', function() {
        window.location.href = "<?= URL ?>menu";
    });

    function mostrarAlerta(texto, tipo = 'success') {
        const config = {
            success: {
                titulo: 'Sucesso!',
                mensagem: texto
            },
            error: {
                titulo: 'Erro!',
                mensagem: texto
            }
        };

        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${tipo}`;
        alertDiv.innerHTML = `
                <div class="alert-icon"></div>
                <div class="alert-content">
                    <div class="alert-title">${config[tipo].titulo}</div>
                    <div class="alert-message">${config[tipo].mensagem}</div>
                </div>
                <button class="alert-close" onclick="fecharAlerta(this)">×</button>
                <div class="alert-progress"></div>
            `;

        document.body.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.classList.add('show');
        }, 10);

        setTimeout(() => {
            fecharAlerta(alertDiv);
        }, 5000);
    }

    function fecharAlerta(elemento) {
        const alert = elemento.classList ? elemento : elemento.parentElement;
        alert.classList.remove('show');
        alert.classList.add('hide');

        setTimeout(() => {
            alert.remove();
        }, 400);
    }
</script>