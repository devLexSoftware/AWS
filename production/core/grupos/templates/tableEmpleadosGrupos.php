<table id="tableDetalles" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Empleado</th>            
                                            <th>Seleccionado</th>                                                    
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                $result2 = mysqli_query($con,"select empleados.nombre, grupos_empleados.fk_empleado from grupos_empleados 
                                inner join empleados on grupos_empleados.fk_empleado = empleados.id where grupos_empleados.fk_grupo = '$id';");
                                $detalle = 0;
                                $count = 0;
                                while($elemento2 = mysqli_fetch_array($result2)){                                                                 
                                    echo '
                                    <tr>
                                        <td><button type="button" id="btnBorrar'. $detalle . '" onclick="deleteDetalle(' . $detalle . ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button></td>
                                        <td><select name="detalleEmpleado' . $detalle . '" id="detalleEmpleado' . $detalle . '" class="form-control"> 
                                        <option  value="' . $elemento2[fk_empleado] . '">' . $elemento2[nombre]. '</option>
                                        </select></td>  
                                    </tr>
                                    ';
                                    $detalle++;
                                    $count++;
                                }
                                ?>
                                </tbody>
                            </table>
                            