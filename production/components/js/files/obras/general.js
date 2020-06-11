function obtenerObras(valor1, valor2) {
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/obras/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
        data: { id: valor1, tabla: valor2 }, //aqui tus datos
        success: function(data) {
            switch (valor2) {
                case "proveedores":
                    datos = $.parseJSON(data);
                    $('#Unidad_Reporte').val(datos['unidad']);
                    $('#Descripcion_Reporte').val(datos['descripcion']);
                    $('#CostoUnit_Reporte').val(datos['importe']);
                    break;
                case "obras":
                    $('#Obra_Reporte').html(data).fadeIn();
                    break;

            }
        },
        error: function(data) {
            alert("error");
        }
    });
}






var arrayDatos = null;


function obtenerAvances(valor1, valor2) {        

    debugger;
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/obras/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
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



function obtenerListaEmpleados(valor1, valor2){
    debugger;
    var exito = false;
    var id = 0;
    for(var i = 0; i < arrayDatos.length; i++)
    {
        if(arrayDatos[i].id== valor1){
            $("#fechInicial_Reporte").val(arrayDatos[i].periodoInicial);
            $("#fechFinal_Reporte").val(arrayDatos[i].periodoFinal);
            id = arrayDatos[i].id;
            $("#asis_id").val(id);
            exito = true;
            break;
        }
        

    }   
}


function imprimirReporte()
{
    var id = $('#asis_obra').val();
    var semana = $('#asis_semana').val();
    window.open("../imprimir.php?id="+id+"&archivo=pageObraAvance&semana="+semana, '_blank');
}