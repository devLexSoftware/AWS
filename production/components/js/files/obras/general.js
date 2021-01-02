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
            debugger;             
            arrayDatos = $.parseJSON(data);            

            $('#asis_semana').empty().append('<option>Selecciona la semana</option>');            
            if(arrayDatos != null)
            {
                for(var i = 0; i < arrayDatos.length; i++)
                {
                    var valor = arrayDatos[i].id;
                    var text = arrayDatos[i].semana;
                    var option = new Option(text, valor );                
                    $("#asis_semana").append(option);
                }            
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


function obtenerTotal(valor1, valor2) {        
    
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/obras/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
        data: { id: valor1, tabla: valor2 }, //aqui tus datos
        success: function(data) {  
            
            
            $('#tablaTotal').html(data).fadeIn();
            

            // $('#asis_semana').empty().append('<option>Selecciona la semana</option>');            
            // if(arrayDatos != null)
            // {
            //     for(var i = 0; i < arrayDatos.length; i++)
            //     {
            //         var valor = arrayDatos[i].id;
            //         var text = arrayDatos[i].semana;
            //         var option = new Option(text, valor );                
            //         $("#asis_semana").append(option);
            //     }            
            // }            
        },
        error: function(data) {
            alert("error");
        }
    });
}




function imprimirReporte()
{
    var id = $('#asis_obra').val();
    var semana = $('#asis_semana').val();
    window.open("../imprimir.php?id="+id+"&archivo=pageObraAvance&semana="+semana, '_blank');
}


function guardarPagos(){

    var idObra = $("#asis_obra").val();
debugger;
    if(idObra != 19){
        var count = $("#semregi").val();
        var semanas = [];
    
        for(var i = 1; i <= count; i++){
            var pago = $("#pago"+i).val();
            var come = $("#come"+i).val();
            var semana = {};
            semana['semana'] = i;
            semana['pago'] = pago;
            semana['comen'] = come;
            semanas.push(semana);
        }
    
        debugger;
    
        $.ajax({
            type: 'POST', //aqui puede ser igual get
            url: '../../../production/core/obras/actions/addPagos.php', //aqui va tu direccion donde esta tu funcion php
            data: { id: idObra, valor: semanas }, //aqui tus datos
            success: function(data) {              
               imprimirReporteTotal();
            },
            error: function(data) {
                alert("error");
            }
        });
    }
    else{
        window.open("../imprimir.php?id="+idObra+"&archivo=pageReporteAnual", '_blank');
        
    }
    


}

function imprimirReporteTotal()
{
    var id = $('#asis_obra').val();
    var count = $('#semregi').val(); 
    // window.open("../imprimir.php?id="+id+"&archivo=pageObraFinal", '_blank');

    var form = document.createElement("form");
    form.target = "_blank";
    form.method = "POST";
    form.action = "../imprimir.php?id="+id+"&archivo=pageReporteTotal&id="+id+"&count="+count; 
    form.style.display = "none";

    for (let index = 0; index < count; index++) {     
        var value = $('#pago'+index).val();   
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "pago"+index;
        input.value = value;
        form.appendChild(input);

        var value = $('#come'+index).val();   
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "come"+index;
        input.value = value;
        form.appendChild(input);
    }

    debugger;
        
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
