<table width="100%" id="tablaListado" class="table table-bordered table-striped table-hover" >
    <thead class="headTablaListado">
        <tr class="text-uppercase th-head-inputs">
            <th>N°</th>
            <th>NOMBRE ÁREA</th>
            <th>NOMBRE CARGO</th>
            <th>ACTUALIZADO</th>
            <th>EDITAR</th>
        </tr>
    </thead>
    <tfoot class="footTablaListado">
        <tr class="text-uppercase">
            <th>N°</th>
            <th>NOMBRE ÁREA</th>
            <th>NOMBRE CARGO</th>
            <th>ACTUALIZADO</th>
            <th>EDITAR</th>
        </tr>
    </tfoot>
    <tbody class="bodyTablaListado">
    <?php $n=1;
    if(count($listado_cargos)>0):
    foreach ($listado_cargos as $cargos) : ?>
        <tr>
            <td class="text-center"><?php echo $n++; ?></td>
            <td><?php echo $cargos['nombre_area'] ?></td>
            <td><?php echo $cargos['nombre_cargo'] ?></td>
            <td class="text-center" style="mso-number-format:\@"><?php echo $cargos['creado_por']?></td>
            <td class="text-center">
                <span data-toggle="tooltip" data-placement="top" title="Editar">
                    <a data-toggle="modal" href="<?php echo base_url('herramientas/editar'); ?>?id_cargo=<?php echo $cargos['id_cargo'] ?>" data-target="#editarCargoModal" class='btn btn-icon btn-success waves-effect waves-circle waves-float'><i class='zmdi zmdi-edit alinear-i-table'></i></a>
                </span>
            </td>
        </tr>
     <?php endforeach; ?>
    <?php endif;?>
    </tbody>
</table>