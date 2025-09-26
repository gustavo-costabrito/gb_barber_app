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