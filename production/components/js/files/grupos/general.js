var detalle = 0;
var listEmpleados = new Array();


function addDetalles(empleados) {
    var val = document.getElementById("empleados");
    var selectedText = val.options[val.selectedIndex].text;
    var selectedValue = val.options[val.selectedIndex].value;
    if (listEmpleados.includes(selectedValue) == false) {
        listEmpleados.push(selectedValue);

        var table = document.getElementById('tableDetalles');
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var cel0 = row.insertCell(0);
        var cel1 = row.insertCell(1);
        cel0.innerHTML = '<button type="button" id="btnBorrar' + detalle + '" onclick="deleteDetalle(' + detalle + ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button>';
        cel1.innerHTML = '<select name="detalleEmpleado' + detalle + '" id="detalleEmpleado' + detalle + '" class="form-control"> ' +
            '<option  value="' + selectedValue + '">' + selectedText + '</option>' +
            '</select>';
        detalle++;
        document.getElementById('detalleCantidad').value = detalle;
    }
}

function deleteDetalle(numero) {
    var valor = document.getElementById("detalleEmpleado" + numero);
    var eliminar = valor.options[valor.selectedIndex].value;
    listEmpleados = jQuery.grep(listEmpleados, function(value) {
        return value != eliminar;
    });

    document.getElementById("tableDetalles").deleteRow(numero + 1);
    updateDetalle(numero);



    detalle = detalle - 1;
    document.getElementById('detalleCantidad').value = detalle;
}

function updateDetalle(numero) {
    var i = 0;
    for (var count = 0; count < detalle; count++) {
        if (count != numero) {
            document.getElementById('btnBorrar' + count).name = 'btnBorrar' + i;
            document.getElementById('btnBorrar' + count).id = 'btnBorrar' + i;
            document.getElementById('btnBorrar' + i).setAttribute('onclick', 'deleteDetalle(' + i + ')');
            document.getElementById('detalleEmpleado' + count).name = 'detalleEmpleado' + i;
            document.getElementById('detalleEmpleado' + count).id = 'detalleEmpleado' + i;
            i++;
        }
    }
}

function cargarEmpleados() {
    var elementos = document.getElementById('auxcantidad').value;
    for (var count = 0; count < elementos; count++) {
        var valor = document.getElementById("detalleEmpleado" + count).value;
        listEmpleados.push(valor);
    }
    document.getElementById('detalleCantidad').value = elementos;
    detalle = elementos;
}