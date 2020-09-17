var detalle = 0;

function addDetalles() {
    detalle = document.getElementById('detalleCantidad').value;
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

    cel0.innerHTML = '<button type="button" id="btnBorrar' + detalle + '" onclick="deleteDetalle(' + detalle + ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button>';
    cel1.innerHTML = '<textarea class="form-control" name="detalleConcepto' + detalle + '" id="detalleConcepto' + detalle + '" placeholder="Concepto"></textarea>';
    cel2.innerHTML = '<select class="form-control" id="detalleUnidad' + detalle + '" name="detalleUnidad' + detalle + '" >'+
                        '<option value="Default">Selecciona la unidad</option>'+
                        '<option value="Caja">Caja</option>'+
                        '<option value="Camion">Camión</option>'+
                        '<option value="Días">Días</option>'+
                        '<option value="Hora">Hora</option>'+
                        '<option value="Kilo">Kilo</option>'+
                        '<option value="Litros">Litros</option>'+
                        '<option value="Lote">Lote</option>'+
                        '<option value="Metros">Metros</option>'+
                        '<option value="Metros cuadrados">Metros cuadrados</option>'+
                        '<option value="Metros cubicos">Metros cubicos</option>'+
                        '<option value="Pieza">Pieza</option>'+
                        '<option value="Pipa">Pipa</option>'+
                        '<option value="Tonelada">Tonelada</option>'+
                        '<option value="Viaje">Viaje</option>'+                
                    '</select>';
    cel3.innerHTML = '<input type="text" class="form-control" onchange="calPres('+detalle+')"  name="detalleCantidad' + detalle + '" id="detalleCantidad' + detalle + '" placeholder="Cantidad">';
    cel4.innerHTML = '<input type="text" class="form-control" onchange="calPres('+detalle+')" name="detalleCosto' + detalle + '" id="detalleCosto' + detalle + '" placeholder="Costo">';
    cel5.innerHTML = '<input type="text" class="form-control"  name="detalleUtil' + detalle + '" id="detalleUtil' + detalle + '" placeholder="Util">';
    cel6.innerHTML = '<input type="text" class="form-control"  name="detalleAdmin' + detalle + '" id="detalleAdmin' + detalle + '" placeholder="Admin">';
    cel7.innerHTML = '<input type="text" class="form-control"  name="detalleDirecto' + detalle + '" id="detalleDirecto' + detalle + '" placeholder="Directo">';
    cel8.innerHTML = '<input type="text" class="form-control"  name="detalleCostoUni' + detalle + '" id="detalleCostoUni' + detalle + '" placeholder="Costo">';
    cel9.innerHTML = '<input type="text" class="form-control"  name="detalleDescuento' + detalle + '" id="detalleDescuento' + detalle + '" placeholder="Descuento">';
    cel10.innerHTML = '<input type="text" class="form-control"  name="detalleCReal' + detalle + '" id="detalleCReal' + detalle + '" placeholder="Costo Real">';
    // cel9.innerHTML = '<input type="text" class="form-control"  name="detalleCReal' + detalle + '" onchange="importe(' + detalle + ' )" id="detalleCantidad' + detalle + '" placeholder="Cantidad">';
    cel11.innerHTML = '<input type="text" class="form-control"  name="detalleGanancia' + detalle + '" id="detalleGanancia' + detalle + '" placeholder="Ganancia">';
    // cel10.innerHTML = '<input type="text" class="form-control"  name="detalleCosto' + detalle + '" onchange="importe(' + detalle + ' )" id="detalleCosto' + detalle + '" placeholder="Costo">';
    cel12.innerHTML = '<input type="text" class="form-control"  name="detalleReal' + detalle + '" id="detalleReal' + detalle + '" placeholder="Real">';
    cel13.innerHTML = '<input type="text" class="form-control"  name="detalleImporte' + detalle + '" id="detalleImporte' + detalle + '" placeholder="Importe">';    
    detalle++;
    
    document.getElementById('detalleCantidad').value = detalle;
    sumaFinal();

}

function calPres(num){
    var cant = parseFloat(document.getElementById('detalleCantidad' + num).value);
    var costo = parseFloat(document.getElementById('detalleCosto' + num).value);
    // if(cant > 0 && costo > 0){
        var util =  costo * 0.3;
        var admin = costo * 0.15;
        var directo = costo * cant;
        var cu = costo + admin + util;
        var des = cu * 0.15;
        var importe = cu * cant;
        var cr = importe - (des * cant);
        var ganancia = cr - directo;
        var real = (1 / cr) * ganancia;
    
        document.getElementById('detalleUtil'+num).value = parseFloat(util).toFixed(2);
        document.getElementById('detalleAdmin'+num).value = parseFloat(admin).toFixed(2);
        document.getElementById('detalleDirecto'+num).value = parseFloat(directo).toFixed(2);
        document.getElementById('detalleCostoUni'+num).value = parseFloat(cu).toFixed(2);
        document.getElementById('detalleDescuento'+num).value = parseFloat(des).toFixed(2);
        document.getElementById('detalleCReal'+num).value = parseFloat(cr).toFixed(2);
        document.getElementById('detalleGanancia'+num).value = parseFloat(ganancia).toFixed(2);
        document.getElementById('detalleReal'+num).value = parseFloat(real).toFixed(2);
        document.getElementById('detalleImporte'+num).value = parseFloat(importe).toFixed(2);
    // }
    sumaFinal();

}

function deleteDetalle(numero) {
    detalle = document.getElementById('detalleCantidad').value;
    debugger;
    document.getElementById("tableDetalles").deleteRow(numero + 1);
    updateDetalle(numero);
debugger;
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
            document.getElementById('detalleConcepto' + count).name = 'detalleConcepto' + i;
            document.getElementById('detalleConcepto' + count).id = 'detalleConcepto' + i;
            document.getElementById('detalleUnidad' + count).name = 'detalleUnidad' + i;
            document.getElementById('detalleUnidad' + count).id = 'detalleUnidad' + i;
            document.getElementById('detalleCantidad' + count).name = 'detalleCantidad' + i;
            document.getElementById('detalleCantidad' + count).id = 'detalleCantidad' + i;

            document.getElementById('detalleCosto' + count).name = 'detalleCosto' + i;
            document.getElementById('detalleCosto' + count).id = 'detalleCosto' + i;
            document.getElementById('detalleUtil' + count).name = 'detalleUtil' + i;
            document.getElementById('detalleUtil' + count).id = 'detalleUtil' + i;

            document.getElementById('detalleAdmin' + count).name = 'detalleAdmin' + i;
            document.getElementById('detalleAdmin' + count).id = 'detalleAdmin' + i;
            document.getElementById('detalleDirecto' + count).name = 'detalleDirecto' + i;
            document.getElementById('detalleDirecto' + count).id = 'detalleDirecto' + i;

            document.getElementById('detalleCostoUni' + count).name = 'detalleCostoUni' + i;
            document.getElementById('detalleCostoUni' + count).id = 'detalleCostoUni' + i;
            document.getElementById('detalleDescuento' + count).name = 'detalleDescuento' + i;
            document.getElementById('detalleDescuento' + count).id = 'detalleDescuento' + i;

            document.getElementById('detalleCReal' + count).name = 'detalleCReal' + i;
            document.getElementById('detalleCReal' + count).id = 'detalleCReal' + i;

            document.getElementById('detalleGanancia' + count).name = 'detalleGanancia' + i;
            document.getElementById('detalleGanancia' + count).id = 'detalleGanancia' + i;
            document.getElementById('detalleReal' + count).name = 'detalleReal' + i;
            document.getElementById('detalleReal' + count).id = 'detalleReal' + i;
            document.getElementById('detalleImporte' + count).name = 'detalleImporte' + i;
            document.getElementById('detalleImporte' + count).id = 'detalleImporte' + i;
            

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
    debugger;
    document.getElementById('costoTotal').value = 0;
    var valor1 = 0;
    var total = 0;
    for (var count = 0; count < detalle; count++) {
        valor1 = parseFloat(document.getElementById('detalleImporte' + count).value);
        total = valor1 + total;
    }
    document.getElementById('costoTotal').value = parseFloat(total).toFixed(2);
}

function imprimirReporte(tipo){
    
    var id = $('#cotizacionId').val();
    if(tipo == 1){
        window.open("../imprimir.php?id="+id+"&archivo=pageCotizacionCliente", '_blank');
    }
    else{
        window.open("../imprimir.php?id="+id+"&archivo=pageCotizacion", '_blank');
    }
    // var semana = $('#asis_semana').val();
    // window.open("../imprimir.php?id="+id+"&archivo=pageCompras", '_blank');
    

       
}