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