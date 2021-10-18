function checaDatas() {
    var dataHoje = new Date();
    var dia = dataHoje.getDate();
    var mes = dataHoje.getMonth();
    var ano = dataHoje.getFullYear();

    var strData = ano + "-" +(mes+1) + "-" + dia;

    var dataExcursao = document.getElementById('dataIda').value;

    alert('Dia atual: ' + strData + ' Dia da excursao: ' + dataExcursao);

}