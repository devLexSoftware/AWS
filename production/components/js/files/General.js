//---Para cargar los mensajes cuando se realiza una accion
function messages() {
    $('#divmessages').load('../default/messages.php');
}

//---Mostrar todos los mensajes y alertas
function showall(o) {
    if (o == "mensajes") {
        $("#divallmessages").load('../default/allmessages.php');
    } else if (o == "alertas") {
        $("#divallalerts").load('../default/allalerts.php');
    }
}


function abrir(archivo, ref) {
    switch (archivo) {

        //***********   Para sistema
        case "cotizaciones":
            $("#divContenido").load('production/core/cotizaciones/templates/cotizaciones.php');
            break;
        case "cotizacionesOk":
            $("#divContenido").load('production/core/cotizaciones/templates/cotizaciones.php');
            break;
        case "optionCotizaciones":
            $("#divContenido").load('production/core/cotizaciones/templates/optionCotizaciones.php?ref=' + ref);
            break;
        case "proveedores":
            $("#divContenido").load('production/core/proveedores/templates/proveedores.php');
            break;
        case "optionProveedores":
            $("#divContenido").load('production/core/proveedores/templates/optionProveedores.php?ref=' + ref);
            break;
        case "proveedoresOk":
            $("#divContenido").load('production/core/proveedores/templates/proveedores.php');
            break;
        case "proveedoresDel":
            $("#divContenido").load('production/core/proveedores/templates/proveedores.php');
            break;
        case "compras":
            $("#divContenido").load('production/core/compras/templates/compras.php');
            break;
        case "compras_reportes.php":
            $("#divContenido").load('production/core/compras/templates/compras_reportes.php');
            break;
        case "optionCompras":
            $("#divContenido").load('production/core/compras/templates/optionCompras.php?ref=' + ref);
            break;
        case "comprasOk":
            $("#divContenido").load('production/core/compras/templates/compras.php');
            break;
        case "comprasDel":
            $("#divContenido").load('production/core/compras/templates/compras.php');
            break;
        case "clientes":
            $("#divContenido").load('production/core/clientes/templates/clientes.php');
            break;
        case "clientesDel":
            $("#divContenido").load('production/core/clientes/templates/clientes.php');
            break;
        case "optionClientes":
            $("#divContenido").load('production/core/clientes/templates/optionClientes.php?ref=' + ref);
            break;
        case "clientesOk":
            $("#divContenido").load('production/core/clientes/templates/clientes.php');
            break;
        case "obras":
            $("#divContenido").load('production/core/obras/templates/obras.php');
            break;
        case "optionObras":
            $("#divContenido").load('production/core/obras/templates/optionObras.php?ref=' + ref);
            break;
        case "obrasOk":
            $("#divContenido").load('production/core/obras/templates/obras.php');
            break;
        case "obrasDel":
            $("#divContenido").load('production/core/obras/templates/obras.php');
            break;

        case "empleados":
            $("#divContenido").load('production/core/empleados/templates/empleados.php');
            break;
        case "optionEmpleados":
            $("#divContenido").load('production/core/empleados/templates/optionEmpleados.php?ref=' + ref);
            break;
        case "empleadosOk":
            $("#divContenido").load('production/core/empleados/templates/empleados.php');
            break;
        case "empleadosDel":
            $("#divContenido").load('production/core/empleados/templates/empleados.php');
            break;

        case "grupos":
            $("#divContenido").load('production/core/grupos/templates/grupos.php');
            break;
        case "gruposOk":
            $("#divContenido").load('production/core/grupos/templates/grupos.php');
            break;
        case "optionGrupos":
            $("#divContenido").load('production/core/grupos/templates/optionGrupos.php?ref=' + ref);
            break;
        case "gruposDel":
            $("#divContenido").load('production/core/grupos/templates/grupos.php');
            break;

        case "pedidos":
            $("#divContenido").load('production/core/pedidos/templates/pedidos.php');
            break;
        case "optionPedidos":
            $("#divContenido").load('production/core/pedidos/templates/optionPedidos.php?ref=' + ref);
            break;
        case "pedidosOk":
            $("#divContenido").load('production/core/pedidos/templates/pedidos.php');
            break;
        case "pedidosDel":
            $("#divContenido").load('production/core/pedidos/templates/pedidos.php');
            break;

        case "soporte":
            $("#divContenido").load('production/core/soporte/templates/soporte.php');
            break;
        case "soporteExito":
            $("#divContenido").load('production/core/soporte/templates/soporte.php');
            break;
        case "soporteError":
            $("#divContenido").load('production/core/soporte/templates/soporte.php');
            break;

        case "inventario":
            $("#divContenido").load('production/core/inventarios/templates/inventario.php');
            break;
        case "optionInventario":
            $("#divContenido").load('production/core/inventarios/templates/optioninventarios.php?ref=' + ref);
            break;
        case "inventarioOk":
            $("#divContenido").load('production/core/inventarios/templates/inventario.php');
            break;
        case "inventariosDel":
            $("#divContenido").load('production/core/inventarios/templates/inventario.php');
            break;


        case "contratistas":
            $("#divContenido").load('production/core/contratistas/templates/contratistas.php');
            break;
        case "optionContratistas":
            $("#divContenido").load('production/core/contratistas/templates/optionContratistas.php?ref=' + ref);
            break;
        case "contratistasOk":
            $("#divContenido").load('production/core/contratistas/templates/contratistas.php');
            break;
        case "contratistasDel":
            $("#divContenido").load('production/core/contratistas/templates/contratistas.php');
            break;


        case "asistencias":
            $("#divContenido").load('production/core/asistencias/templates/asistencias.php');
            break;
        case "optionAsistencias":
            $("#divContenido").load('production/core/asistencias/templates/optionAsistencias.php?ref=' + ref);
            break;
        case "asistenciasOk":
            $("#divContenido").load('production/core/asistencias/templates/asistencias.php');
            break;
        case "asistenciasDel":
            $("#divContenido").load('production/core/asistencias/templates/asistencias.php');
            break;

        case "usuarios":
            $("#divContenido").load('production/core/usuarios/templates/usuarios.php');
            break;
        case "optionUsuarios":
            $("#divContenido").load('production/core/usuarios/templates/optionUsuarios.php?ref=' + ref);
            break;
        case "usuariosOk":
            $("#divContenido").load('production/core/usuarios/templates/usuarios.php');
            break;
        case "usuariosDel":
            $("#divContenido").load('production/core/usuarios/templates/usuarios.php');
            break;


        case "nominas":
            $("#divContenido").load('production/core/nominas/templates/nominas.php');
            break; 
            
        case "reportesObras":
            $("#divContenido").load('production/core/obras/templates/reportes.php');
            break;


        default:
            $("#divContenido").load('production/core/inicio/templates/cuentaObras.php');
            break;
    }
}

function del(pag, referencia) {
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: 'production/core/' + pag + '/actions/delete' + pag + '.php', //aqui va tu direccion donde esta tu funcion php
        data: { pagina: pag, ref: referencia }, //aqui tus datos
        success: function(data) {
            location.href = "index.php?p=" + pag + "Del";
            //alert('Exito, se corrigio');
        },
        error: function(data) {
            alert('Hubo algun error, intente nuevamente');
        }
    });
}