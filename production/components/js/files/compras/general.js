function actualizar(obra) {

    var pa1 = "";
    var pa2 = "";
    var pa3 = obra;
    if (pa1 == "") {
        pa1 = "";
    }
    if (pa2 == "") {
        pa2 = "";
    }
    if (pa3 == "0") {
        pa3 = "";
    }
    $("#tableCompras").load('../../../workshop.com/production/core/compras/templates/tableCompras.php?ini=' + pa1 + '&fin=' + pa2 + '&obra=' + pa3);
}



function obtenerFactura() {
    var totalFactura = 0;
    var importe = document.getElementById("Importe_Reporte").value;
    var cliente = document.getElementById("Cliente_Reporte").value;
    var obra = document.getElementById("Obra_Reporte").value;
    var fac = document.getElementById("NomFactura_Reporte").value;

    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../workshop.com/production/core/compras/actions/getFactTotal.php', //aqui va tu direccion donde esta tu funcion php
        data: { val2: cliente, val3: obra, val4: fac }, //aqui tus datos
        success: function(data) {
            datos = $.parseJSON(data);
            $('#totalFact_Reporte').val(datos['importe']);
        },
        error: function(data) {
            alert("error");
        }
    });;
}