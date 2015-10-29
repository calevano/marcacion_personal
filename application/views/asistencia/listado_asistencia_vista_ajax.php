<table width="100%" id="tablaListado" class="table table-bordered table-striped table-hover" >
    <thead class="headTablaListado">
        <tr class="text-uppercase th-head-inputs">
            <th>N°</th>
            <th>PROYECTO</th>
            <th>SEDE</th>
            <th>ÁREA</th>
            <th>CARGO</th>
            <th>DNI</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th><i class="zmdi zmdi-timer mdc-text-green-400"></i> INGRESO</th>
            <th><i class="zmdi zmdi-timer-off mdc-text-red-A700"></i> ÚLTIMA VISITA</th>
            <th><i class="zmdi zmdi-assignment-account mdc-text-blue-800"></i> VISITAS</th>
        </tr>
    </thead>
    <tfoot class="footTablaListado">
        <tr class="text-uppercase">
            <th>N°</th>
            <th>PROYECTO</th>
            <th>SEDE</th>
            <th>AREA</th>
            <th>CARGO</th>
            <th>DNI</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th>INGRESO</th>
            <th>ÚLTIMA VISITA</th>
            <th>VISITAS</th>
        </tr>
    </tfoot>
    <tbody class="bodyTablaListado">
        <?php $n=1; if(count($listado_visita)>0 ) : ?>
        <?php foreach ($listado_visita as $listado) : ?>
            <tr>
                <td class="text-center"><?php echo $n++; ?></td>
                <td class="text-center"><?php echo $listado['nombre_corto_proyecto'] ?></td>
                <td><?php echo $listado['nombre_sede'] ?></td>
                <td><?php echo $listado['nombre_area'] ?></td>
                <td><?php echo $listado['nombre_cargo'] ?></td>
                <td class="text-center" style="mso-number-format:\@"><?php echo $listado['dni'] ?></td>
                <td><?php echo $listado['nombres_apellidos'] ?></td>
                <td class="text-center <?php echo verifica_hora($listado['hora_ingreso']) ?>"><?php echo $listado['hora_ingreso'] ?></td>
                <td class="text-center <?php echo verifica_hora($listado['hora_salida']) ?>"><?php echo $listado['hora_salida'] ?></td>
                <td class="text-center" >
                    <a data-toggle="modal"  href="<?php echo base_url('asistencia/listado/visita?dni='.$listado["dni"].'&fecha='.$listado["fecha"].'') ?>" data-target="#visitasModal" class='btn bgm-cyan btn-icon waves-effect waves-circle waves-float alinear-i' ><?php echo $listado['visitas'] ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
