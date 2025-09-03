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
})