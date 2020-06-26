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
    $("#tableCompras").load('../../../production/core/compras/templates/tableCompras.php?ini=' + pa1 + '&fin=' + pa2 + '&obra=' + pa3);
}



function obtenerFactura() {
    var totalFactura = 0;
    var importe = document.getElementById("Importe_Reporte").value;
    var cliente = document.getElementById("Cliente_Reporte").value;
    var obra = document.getElementById("Obra_Reporte").value;
    var fac = document.getElementById("NomFactura_Reporte").value;

    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/compras/actions/getFactTotal.php', //aqui va tu direccion donde esta tu funcion php
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


function obtenerCompras(valor1, valor2) {        
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/compras/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
        data: { id: valor1, tabla: valor2 }, //aqui tus datos
        success: function(data) {               
            arrayDatos = $.parseJSON(data);

            $('#asis_semana').empty().append('<option>Selecciona la semana</option>');            
            for(var i = 0; i < arrayDatos.length; i++)
            {
                var valor = arrayDatos[i].id;
                var text = arrayDatos[i].semana;
                var option = new Option(text, valor );                
                $("#asis_semana").append(option);
            }            
        },
        error: function(data) {
            alert("error");
        }
    });
}




function imprimirReporte()
{
    var id = $('#asis_obra').val();
    // var semana = $('#asis_semana').val();
    window.open("../imprimir.php?id="+id+"&archivo=pageCompras", '_blank');
}
