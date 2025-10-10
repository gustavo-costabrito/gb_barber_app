document.addEventListener('DOMContentLoaded', function(){
    const limparForm = document.getElementById('limparForm');
    const mensagem = document.getElementById('mensagemContato');

    limparForm.addEventListener('click', function() {
        mensagem.value = "";
    });
});

document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('voltar').addEventListener('click', function(){
        history.back();
    });

    document.getElementById('dataAgendamento').addEventListener('change', function(){
        const valor = parseInt(this.value);
    
        if(valor <= 0){
            document.getElementById('horarioPadrao').innerText = "Data não definida";
    
            document.getElementById('horarioAgendamento').disabled = true;
        } else{
            document.getElementById('horarioPadrao').innerText = "Selecione um horário:";
    
            document.getElementById('horarioAgendamento').disabled = false;
        }
    });
});



// Aplicativo subir

let deferredPrompt;
const instalar = document.getElementById('instalar');
const btnInstalar = document.getElementById('btnInstalar');
const btnFechar = document.getElementById('btnFechar');

if(instalar){
    window.addEventListener('beforeinstallprompt', (event) => {
        event.preventDefault();
        deferredPrompt = event;
        instalar.style.display = 'block';

        btnInstalar.addEventListener('click', async () => {
            instalar.style.display = 'none';
            deferredPrompt.prompt();

            const { outcome } = await deferredPrompt.userChoice;
            console.log(`Instalação: ${outcome}`);
            deferredPrompt = null;
        });

        btnFechar.addEventListener('click', () => {
            instalar.style.display = 'none';
        });
    });
}


if(document.body.id === 'login'){
    const isInStandaloneMode = () => {
        'standalone' in window.navigator && window.navigator.standalone
    };

    const isIOS = () => {
        const userAgent = window.navigator.userAgent.toLowerCase();
        return /iphone|ipad|ipod/.test(userAgent);
    };

    window.addEventListener('load', () => {
        if(isIOS() && !isInStandaloneMode()){
            if(!localStorage.getItem('salvar-resposta-ios')){
                const banner = document.createElement('div');
                banner.className = 'instalar-ios';
                banner.innerHTML = ``;

                document.body.appendChild(banner);

                banner.querySelector('.fechar-ios').addEventListener('click', function(){
                    banner.remove();
                    sessionStorage.setItem('salvar-resposta-ios', 'true');
                });
            }
        }
    });
}


if('serviceWorke' in navigator){
    window.addEventListener('load', function(){
        this.navigator.serviceWorker.register('/sw.js')
            .then(function (registration) {
                console.log('ServiceWorker registrado com sucesso: ', registration.scope);
            })
            .catch(function (error) {
                console.log('Falha ao registrar o ServiceWorker: ', error);
            })
    });
}