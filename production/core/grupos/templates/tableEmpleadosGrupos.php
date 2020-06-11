<table id="tableDetalles" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Empleado</th>            
            <th>Seleccionado</th>                                                    
        </tr>
    </thead>
    <tbody>
    <?php
        $result01 = mysqli_query($con,"select empleados.nombre, grupos_empleados.fk_empleado from grupos_empleados 
        inner join empleados on grupos_empleados.fk_empleado = empleados.id where grupos_empleados.fk_grupo = '$id';");
        $detalle01 = 0;
        $count01 = 0;
        while($elemento01 = mysqli_fetch_array($result01)){                                                                 
            echo '
            <tr>
                <td>
                    <button type="button" id="btnBorrar'. $detalle01 . '" onclick="deleteDetalle(0,' . $detalle01 . ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button>
                </td>
                <td>
                    <select name="detalleEmpleado' . $detalle01 . '" id="detalleEmpleado' . $detalle01. '" class="form-control"> 
                    <option  value="' . $elemento01[fk_empleado] . '">' . $elemento01[nombre]. '</option>
                    </select>
                </td>  
            </tr>
            ';
            $detalle01++;
            $count01++;
        }
        ?>
    </tbody>
</table>

<input type="hidden" id="countEmpleados" name="countEmpleados" value="<?php echo $count01;  ?>">
 