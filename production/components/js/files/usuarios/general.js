
var arrayDatos = null;


function obtenerTipo(valor1) {        

    debugger;

    switch (valor1) {
        case "empleados":
            var url = '../../../production/core/empleados/actions/getEmpleados.php';
            var valor2 = "todos";
            break;
        case "clientes":
            var url = '../../../production/core/clientes/actions/getDatos.php';
            var valor2 = "todos";
            break;
    
        default:
            break;
    }
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: url,
        data: { id: valor2 }, //aqui tus datos
        success: function(data) {               
            arrayDatos = $.parseJSON(data);

            $('#usuarios_lista').empty().append('<option>Seleccione</option>');            
            for(var i = 0; i < arrayDatos.length; i++)
            {
                var valor = arrayDatos[i].id;
                var text = arrayDatos[i].nombre;
                var option = new Option(text, valor );                
                $("#usuarios_lista").append(option);
            }            
        },
        error: function(data) {
            alert("error");
        }
    });
}



function obtenerValores(valor1) {        

    debugger;

    var tipo = $("#usuarios_tipo").val();



    switch (tipo) {
        case "empleados":
            var url = '../../../production/core/empleados/actions/getEmpleados.php';
            var valor2 = valor1;
            break;
        case "clientes":
            var url = '../../../production/core/clientes/actions/getDatos.php';
            var valor2 = valor1;
            break;
    
        default:
            break;
    }
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: url,
        data: { id: valor2 }, //aqui tus datos
        success: function(data) {               
            debugger;

            arrayDatos = $.parseJSON(data);
            if(arrayDatos != null)
            {
                $("#usuario_nombre").val(arrayDatos.usuario);
                $("#usuario_password").val(arrayDatos.pass);                
                $("#usuario_id").val(arrayDatos.id);                
                $("#usuario_perfil").val(arrayDatos.perfil);
                if(arrayDatos.id != null || arrayDatos.id != "")
                {
                    $("#divBorrar").show();    
                }
            }
            else
            {
                $("#usuario_nombre").val("");
                $("#usuario_password").val("");                
                $("#usuario_id").val("");                
                $("#usuario_perfil").val();
                $("#divBorrar").hide();
            }            
        },
        error: function(data) {
            alert("error");
        }
    });
}


function borrar()
{
    debugger;
    var id = $("#usuario_id").val();                

    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: 'production/core/usuarios/actions/delusuarios.php', //aqui va tu direccion donde esta tu funcion php
        data: { id: id }, //aqui tus datos
        success: function(data) {
            location.href = "index.php?p=usuarios" + "Del";
            //alert('Exito, se corrigio');
        },
        error: function(data) {
            alert('Hubo algun error, intente nuevamente');
        }
    });
}