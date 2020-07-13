var arrayDatos = null;


function obtenerAsistencia(valor1, valor2) {        
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/asistencias/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
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
    // if(exito == true)
    // {
    //     $.ajax({
    //         type: 'POST', //aqui puede ser igual get
    //         url: '../../../production/core/asistencias/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
    //         data: { id: id, tabla: valor2 }, //aqui tus datos
    //         success: function(data) {               
    //             // arrayDatos = $.parseJSON(data);
    
    //             // $('#asis_semana').empty().append('<option>Selecciona la semana</option>');            
    //             // for(var i = 0; i < arrayDatos.length; i++)
    //             // {
    //             //     var valor = arrayDatos[i].id;
    //             //     var text = arrayDatos[i].semana;
    //             //     var option = new Option(text, valor );                
    //             //     $("#asis_semana").append(option);
    //             // }            
    //             $('#tablaAsistencas').html(data).fadeIn();
    //         },
    //         error: function(data) {
    //             alert("error");
    //         }
    //     });
    // }

}


function imprimirNomina()
{
    var id = $('#asis_id').val();
    var cateem = $('#asis_cateem').val();
    var cateco = $('#asis_cateco').val();
    window.open("../imprimir.php?id="+id+"&archivo=pageNomina&cateem="+cateem+"&cateco="+cateco, '_blank');
}