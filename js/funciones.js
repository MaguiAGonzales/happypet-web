function fechaIngAesp(fechaIngles){
    var f = new Date(fechaIngles);
    f.setDate(f.getDate() + 1);
    var d = f.getDate();
    var m =  f.getMonth() +1;
    var y = f.getFullYear();
    return  ceros(d) + "/" + ceros(m) + "/" + y
}
function ceros(numero) {
    var  numero = numero.toString();
    while(numero.length < 2)
        numero = "0" + numero;
    return numero;
}
function hora12(horaIngles) {
    var hora = new Date("2000-01-01 " + horaIngles);
    var hours = hora.getHours();
    var minutes = hora.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = ceros(hours) + ':' + ceros(minutes) + ' ' + ampm;
    return strTime;
}
