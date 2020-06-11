<table id="tableDetalles2" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Contratista</th>            
            <th>Seleccionado</th>                                                    
        </tr>
    </thead>
    <tbody>
    <?php
        $result02 = mysqli_query($con,"select c.identificador, gc.fk_contratista from grupos_contratistas gc
        inner join contratistas c on gc.fk_contratista = c.id where gc.fk_grupo = '$id';");
        $detalle02 = 0;
        $count02 = 0;
        while($elemento02 = mysqli_fetch_array($result02)){
            echo '
            <tr>
                <td>
                    <button type="button" id="btnBorrar'. $detalle02 . '" onclick="deleteDetalle(1,' . $detalle02 . ')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button>
                </td>
                <td>
                    <select name="detalleContratista' . $detalle02 . '" id="detalleContratista' . $detalle02 . '" class="form-control"> 
                    <option  value="' . $elemento02[fk_contratista] . '">' . $elemento02[identificador]. '</option>
                    </select>
                </td>  
            </tr>
            ';
            $detalle02++;
            $count02++;
        }
        ?>
    </tbody>
</table>

<input type="hidden" id="countContratistas" name="countContratistas" value="<?php echo $count02;  ?>">
