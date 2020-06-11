var detalle = 0;
var listEmpleados = new Array();
var listContratistas = new Array();
var detalle2 = 0;


function addDetalles(item) {
    var val = document.getElementById(item);
    var selectedText = val.options[val.selectedIndex].text;
    var selectedValue = val.options[val.selectedIndex].value;
    

    if(item == "empleados")
    {
        var ref = "empleado";
        if (listEmpleados.includes(selectedValue) == false) {
            listEmpleados.push(selectedValue);
    
            var table = document.getElementById('tableDetalles');
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cel0 = row.insertCell(0);
            var cel1 = row.insertCell(1);
            cel0.innerHTML = '<button type="button" id="btnBorrar' + detalle + '" onclick="deleteDetalle(0, ' + detalle + ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button>';
            cel1.innerHTML = '<select name="detalleEmpleado' + detalle + '" id="detalleEmpleado' + detalle + '" class="form-control"> ' +
                '<option  value="' + selectedValue + '">' + selectedText + '</option>' +
                '</select>';
            detalle++;
            document.getElementById('detalleCantidad').value = detalle;
        }    
    }    
    else if(item == "contratistas")
    {
        var ref = "contratista";
        if (listContratistas.includes(selectedValue) == false) {
            listContratistas.push(selectedValue);
    
            var table = document.getElementById('tableDetalles2');
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cel0 = row.insertCell(0);
            var cel1 = row.insertCell(1);
            cel0.innerHTML = '<button type="button" id="btnBorrar2' + detalle2 + '" onclick="deleteDetalle(1, ' + detalle2 + ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button>';
            cel1.innerHTML = '<select name="detalleContratista' + detalle2 + '" id="detalleContratista' + detalle2 + '" class="form-control"> ' +
                '<option  value="' + selectedValue + '">' + selectedText + '</option>' +
                '</select>';
            detalle2++;
            document.getElementById('detalleCantidad2').value = detalle2;
        }    
    }


}

function deleteDetalle(item, numero) {

    if(item == 0)
    {         
        var valor = document.getElementById("detalleEmpleado" + numero);
        var eliminar = valor.options[valor.selectedIndex].value;
        listEmpleados = jQuery.grep(listEmpleados, function(value) {
            return value != eliminar;
        });

        document.getElementById("tableDetalles").deleteRow(numero + 1);
        updateDetalle("empleado", numero);
        detalle = detalle - 1;
        document.getElementById('detalleCantidad').value = detalle;
    }    
    else if(item == 1)
    {
        var valor = document.getElementById("detalleContratista" + numero);
        var eliminar = valor.options[valor.selectedIndex].value;
        listContratistas = jQuery.grep(listContratistas, function(value) {
            return value != eliminar;
        });

        document.getElementById("tableDetalles2").deleteRow(numero + 1);
        updateDetalle("contratista", numero);
        detalle2 = detalle2 - 1;
        document.getElementById('detalleCantidad2').value = detalle2;
    }
}

function updateDetalle(item, numero) {
    var i = 0;
    if(item == 0)
    {
        for (var count = 0; count < detalle; count++) {
            if (count != numero) {
                document.getElementById('btnBorrar' + count).name = 'btnBorrar' + i;
                document.getElementById('btnBorrar' + count).id = 'btnBorrar' + i;
                document.getElementById('btnBorrar' + i).setAttribute('onclick', 'deleteDetalle("empleado",' + i + ')');
                document.getElementById('detalleEmpleado' + count).name = 'detalleEmpleado' + i;
                document.getElementById('detalleEmpleado' + count).id = 'detalleEmpleado' + i;
                i++;
            }
        }
    }
    else if(item == 1)
    {
        for (var count = 0; count < detalle2; count++) {
            if (count != numero) {
                document.getElementById('btnBorrar2' + count).name = 'btnBorrar2' + i;
                document.getElementById('btnBorrar2' + count).id = 'btnBorrar2' + i;
                document.getElementById('btnBorrar2' + i).setAttribute('onclick', 'deleteDetalle("contratista",' + i + ')');
                document.getElementById('detalleContratista' + count).name = 'detalleContratista' + i;
                document.getElementById('detalleContratista' + count).id = 'detalleContratista' + i;
                i++;
            }
        }
    }
    
}

function cargarEmpleados() {
    var elementos = document.getElementById('countEmpleados').value;
    for (var count = 0; count < elementos; count++) {
        var valor = document.getElementById("detalleEmpleado" + count).value;
        listEmpleados.push(valor);
    }
    document.getElementById('detalleCantidad').value = elementos;
    detalle = elementos;

    var elementos = document.getElementById('countContratistas').value;
    for (var count = 0; count < elementos; count++) {
        var valor = document.getElementById("detalleContratista" + count).value;
        listEmpleados.push(valor);
    }
    document.getElementById('detalleCantidad2').value = elementos;
    detalle2 = elementos;

}





function obtenerEquipos(valor1, valor2) {    
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../../production/core/grupos/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
        data: { id: valor1, tabla: valor2 }, //aqui tus datos
        success: function(data) {
            switch (valor2) {
                case "proveedores":
                    datos = $.parseJSON(data);
                    $('#Unidad_Reporte').val(datos['unidad']);
                    $('#Descripcion_Reporte').val(datos['descripcion']);
                    $('#CostoUnit_Reporte').val(datos['importe']);
                    break;


                case "grupos":
                    $('#tablaAsistencas').html(data).fadeIn();
                    break;

            }
        },
        error: function(data) {
            alert("error");
        }
    });
}