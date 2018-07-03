var detalle = 0;

function addDetalles() {
    var table = document.getElementById('tableDetalles');
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var cel0 = row.insertCell(0);
    var cel1 = row.insertCell(1);
    var cel2 = row.insertCell(2);
    var cel3 = row.insertCell(3);
    var cel4 = row.insertCell(4);
    var cel5 = row.insertCell(5);
    var cel6 = row.insertCell(6);
    var cel7 = row.insertCell(7);
    var cel8 = row.insertCell(8);
    var cel9 = row.insertCell(9);
    var cel10 = row.insertCell(10);
    var cel11 = row.insertCell(11);
    var cel12 = row.insertCell(12);
    var cel13 = row.insertCell(13);
    var cel14 = row.insertCell(14);
    cel0.innerHTML = '<button type="button" id="btnBorrar' + detalle + '" onclick="deleteDetalle(' + detalle + ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button>';
    cel1.innerHTML = '<input type="text" class="form-control" name="detalleProceso' + detalle + '" id="detalleProceso' + detalle + '" placeholder="Proceso">';
    cel2.innerHTML = '<textarea  class="form-control" name="detalleDescripcion' + detalle + '" id="detalleDescripcion' + detalle + '"></textarea>';
    cel3.innerHTML = '<input type="text" class="form-control"  name="detalleDuracion' + detalle + '" id="detalleDuracion' + detalle + '" placeholder="Duración">';
    cel4.innerHTML = '<input type="text" class="form-control"  name="detalleX' + detalle + '" id="detalleX' + detalle + '" placeholder="x">';
    cel5.innerHTML = '<input type="text" class="form-control"  name="detalleUnidad' + detalle + '" id="detalleUnidad' + detalle + '" placeholder="Unidad">';
    cel6.innerHTML = '<input type="text" class="form-control"  name="detalleAncho' + detalle + '" id="detalleAncho' + detalle + '" placeholder="Ancho/Pieza">';
    cel7.innerHTML = '<input type="text" class="form-control"  name="detalleLargo' + detalle + '" id="detalleLargo' + detalle + '" placeholder="Largo">';
    cel8.innerHTML = '<input type="text" class="form-control"  name="detalleAlto' + detalle + '" id="detalleAlto' + detalle + '" placeholder="Alto">';
    cel9.innerHTML = '<input type="text" class="form-control"  name="detalleCantidad' + detalle + '" onchange="importe(' + detalle + ' )" id="detalleCantidad' + detalle + '" placeholder="Cantidad">';
    cel10.innerHTML = '<input type="text" class="form-control"  name="detalleCosto' + detalle + '" onchange="importe(' + detalle + ' )" id="detalleCosto' + detalle + '" placeholder="Costo">';
    cel11.innerHTML = '<input type="text" class="form-control"  name="detalleImporte' + detalle + '" id="detalleImporte' + detalle + '" placeholder="Importe">';
    cel12.innerHTML = '<input type="text" class="form-control"  name="detalleSubtotalxTarea' + detalle + '" id="detalleSubtotalxTarea' + detalle + '" placeholder="Subtotal x tarea">';
    cel13.innerHTML = '<input type="text" class="form-control"  name="detalleSubtotalxFecha' + detalle + '" id="detalleSubtotalxFecha' + detalle + '" placeholder="Subtotal x fecha">';
    cel14.innerHTML = '<input type="text" class="form-control"  name="detalleSubtotalxProceso' + detalle + '" id="detalleSubtotalxProceso' + detalle + '" placeholder="Subtotal x proceso">';

    detalle++;
    document.getElementById('detalleCantidad').value = detalle;
    sumaFinal();

}

function deleteDetalle(numero) {
    document.getElementById("tableDetalles").deleteRow(numero + 1);
    updateDetalle(numero);

    detalle = detalle - 1;
    document.getElementById('detalleCantidad').value = detalle;
    sumaFinal();
}

function updateDetalle(numero) {
    var i = 0;
    for (var count = 0; count < detalle; count++) {
        if (count != numero) {
            document.getElementById('btnBorrar' + count).name = 'btnBorrar' + i;
            document.getElementById('btnBorrar' + count).id = 'btnBorrar' + i;
            document.getElementById('btnBorrar' + i).setAttribute('onclick', 'deleteDetalle(' + i + ')');
            document.getElementById('detalleProceso' + count).name = 'detalleProceso' + i;
            document.getElementById('detalleProceso' + count).id = 'detalleProceso' + i;
            document.getElementById('detalleDescripcion' + count).name = 'detalleDescripcion' + i;
            document.getElementById('detalleDescripcion' + count).id = 'detalleDescripcion' + i;
            document.getElementById('detalleDuracion' + count).name = 'detalleDuracion' + i;
            document.getElementById('detalleDuracion' + count).id = 'detalleDuracion' + i;
            document.getElementById('detalleX' + count).name = 'detalleX' + i;
            document.getElementById('detalleX' + count).id = 'detalleX' + i;
            document.getElementById('detalleUnidad' + count).name = 'detalleUnidad' + i;
            document.getElementById('detalleUnidad' + count).id = 'detalleUnidad' + i;
            document.getElementById('detalleAncho' + count).name = 'detalleAncho' + i;
            document.getElementById('detalleAncho' + count).id = 'detalleAncho' + i;
            document.getElementById('detalleLargo' + count).name = 'detalleLargo' + i;
            document.getElementById('detalleLargo' + count).id = 'detalleLargo' + i;
            document.getElementById('detalleAlto' + count).name = 'detalleAlto' + i;
            document.getElementById('detalleAlto' + count).id = 'detalleAlto' + i;
            document.getElementById('detalleCantidad' + count).name = 'detalleCantidad' + i;
            document.getElementById('detalleCantidad' + count).id = 'detalleCantidad' + i;
            document.getElementById('detalleCosto' + count).name = 'detalleCosto' + i;
            document.getElementById('detalleCosto' + count).id = 'detalleCosto' + i;
            document.getElementById('detalleImporte' + count).name = 'detalleImporte' + i;
            document.getElementById('detalleImporte' + count).id = 'detalleImporte' + i;
            document.getElementById('detalleSubtotalxTarea' + count).name = 'detalleSubtotalxTarea' + i;
            document.getElementById('detalleSubtotalxTarea' + count).id = 'detalleSubtotalxTarea' + i;
            document.getElementById('detalleSubtotalxFecha' + count).name = 'detalleSubtotalxFecha' + i;
            document.getElementById('detalleSubtotalxFecha' + count).id = 'detalleSubtotalxFecha' + i;
            document.getElementById('detalleSubtotalxProceso' + count).name = 'detalleSubtotalxProceso' + i;
            document.getElementById('detalleSubtotalxProceso' + count).id = 'detalleSubtotalxProceso' + i;

            i++;
        }
    }
}

function importe(id) {
    var cant = document.getElementById('detalleCantidad' + id).value;
    var unit = document.getElementById('detalleCosto' + id).value;
    document.getElementById('detalleImporte' + id).value = (cant * unit).toFixed(2);
    sumaFinal();
}

var sub = 0;
var iva = 0;

function sumaFinal() {
    document.getElementById('costoTotal').value = 0;
    var valor1 = 0;
    var total = 0;
    for (var count = 0; count < detalle; count++) {
        valor1 = parseFloat(document.getElementById('detalleImporte' + count).value);
        total = valor1 + total;
    }
    document.getElementById('costoTotal').value = total;
}