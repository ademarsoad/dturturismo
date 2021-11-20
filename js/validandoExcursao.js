function checaDatas() {
    var dataHoje = new Date();
    var dia = dataHoje.getDate();
    var mes = dataHoje.getMonth();
    var ano = dataHoje.getFullYear();

    var strData = ano + "-" +(mes+1) + "-" + dia;

    var dataIda = document.getElementById('dataIda').value;
    var dataVolta = document.getElementById('dataVolta').value;

    if(dataIda < strData) {
        alert("Dia do passeio é anterior ao dia atual");
    }
    

}