var arrayDatos = null;


function obtenerAsistencia(valor1, valor2) {        
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/asistencias/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
        data: { id: valor1, tabla: valor2 }, //aqui tus datos
        success: function(data) {               
            arrayDatos = $.parseJSON(data);

            $('#asis_semana').empty();            
            var option = new Option("Todas", "Todas" );                
            $("#asis_semana").append(option);

            $('#asis_cateem').prop('disabled', true);
            $('#asis_cateco').prop('disabled', true);            

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

    if(valor1 == "Todas")
    {
        $('#asis_cateem').val("todos");
        $('#asis_cateco').val("todos");
    
        $('#asis_cateem').prop('disabled', true);
        $('#asis_cateco').prop('disabled', true);            

        $('#fechInicial_Reporte').val("");
        $('#fechFinal_Reporte').val("");
    }
    else
    {
        $('#asis_cateem').prop('disabled', false);
        $('#asis_cateco').prop('disabled', false);            
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
}


function imprimirNomina()
{
    var id = $('#asis_id').val();    
    var cateem = $('#asis_cateem').val();
    var cateco = $('#asis_cateco').val();
    if($('#asis_semana').val() == "Todas"){
        var idObra = $('#asis_obra').val();
        window.open("../imprimir.php?idObra="+idObra+"&archivo=pageNomina", '_blank');

    }
    else{
        window.open("../imprimir.php?id="+id+"&archivo=pageNomina&cateem="+cateem+"&cateco="+cateco, '_blank');

    }


    
}