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
            var impor = datos['importe'];
            $('#totalFact_Reporte').val(impor);
        },
        error: function(data) {
            alert("error");
        }
    });;
}

var arrayDatos = null;

function obtenerCompras(valor1, valor2) {    
    debugger;    
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/compras/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
        data: { id: valor1, tabla: valor2 }, //aqui tus datos
        success: function(data) {                   
            arrayDatos = $.parseJSON(data);     
            $("#asis_contratista").prop('disabled', false);
            $("#asis_proveedor").prop('disabled', false);          
            $("#asis_compras").prop('disabled', false);          

    debugger;

            $('#asis_semana').empty();            
            var option = new Option("Todas", "Todas" );                
            $("#asis_semana").append(option);

            $('#asis_proveedor').empty();    
            var option = new Option("Todos", "Todos" );                
            $("#asis_proveedor").append(option);   

            $('#asis_producto').empty();    
            var option = new Option("Todos", "Todos" );                
            $("#asis_producto").append(option);   

            $('#asis_contratista').empty();
            var option = new Option("Todos", "Todos" );                
            $("#asis_contratista").append(option);        


            var semana = arrayDatos[0];
            for(var i = 0; i < semana.length; i++)
            {
                // var valor = arrayDatos[i].id;
                var text = semana[i].semana;
                var option = new Option(text, text );                
                $("#asis_semana").append(option);
            }   
            
            var proveedor = arrayDatos[1];                                    
            for(var i = 0; i < proveedor.length; i++)
            {
                 var valor = proveedor[i].fk_proveedor;
                var text = proveedor[i].empresa;
                var option = new Option(text, valor );                
                $("#asis_proveedor").append(option);
            }   


            var compras = arrayDatos[2];                 
            for(var i = 0; i < compras.length; i++)
            {
                //  var valor = compras[i].fk_proveedor;
                var text = compras[i].descripcion;
                var option = new Option(text, text );                
                $("#asis_producto").append(option);
            }  

            var contratista = arrayDatos[3];                        
            for(var i = 0; i < contratista.length; i++)
            {
                 var valor = contratista[i].id;
                var text = contratista[i].empresa;
                var option = new Option(text, valor );                
                $("#asis_contratista").append(option);
            }  


        },
        error: function(data) {
            alert("error");
        }
    });
}


function deshabilitar(valor,item)
{
    switch (item) {
        case 'producto':
            if(valor != "Todos")
            {
                $("#asis_contratista").prop('disabled', true);
                $("#asis_proveedor").prop('disabled', true);            
            }
            else 
            {
                $("#asis_contratista").prop('disabled', false);
                $("#asis_proveedor").prop('disabled', false);            
            }
            
            break;
        case 'proveedor':
            if(valor != "Todos")
            {
                $("#asis_contratista").prop('disabled', true);
                $("#asis_producto").prop('disabled', true);            
            }
            else 
            {
                $("#asis_contratista").prop('disabled', false);
                $("#asis_producto").prop('disabled', false);            
            }
            break;
        case 'contratista' :
            if(valor != "Todos")
            {
                $("#asis_producto").prop('disabled', true);
                $("#asis_proveedor").prop('disabled', true);            
            }
            else 
            {
                $("#asis_producto").prop('disabled', false);
                $("#asis_proveedor").prop('disabled', false);            
            }
            break
        default:
            break;
    }
}




function ajustarSemana(valor1, valor2){
    debugger;
    var exito = false;
    var id = 0;
    var compras = arrayDatos[0];
    for(var i = 0; i < compras.length; i++)
    {
        if(compras[i].semana == valor1){
            $("#fechInicial_Reporte").val(compras[i].fechInicial);
            $("#fechFinal_Reporte").val(compras[i].fechFinal);            
            exito = true;
            break;
        }        
    }
}


function imprimirReporte()
{
    var id = $('#asis_obra').val();
    var sem = $('#asis_semana').val();
    var pro = $('#asis_producto').val();
    var prv = $('#asis_proveedor').val();
    var con = $('#asis_contratista').val();
    // var semana = $('#asis_semana').val();
    // window.open("../imprimir.php?id="+id+"&archivo=pageCompras", '_blank');
    window.open("../imprimir.php?id="+id+"&archivo=pageCompras&semana="+sem+"&producto="+pro+"&proveedor="+prv+"&contratista="+con+"", '_blank');
}
