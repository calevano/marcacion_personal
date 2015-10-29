<table width="100%" id="tablaListado" class="table table-bordered table-striped table-hover" >
    <thead class="headTablaListado">
        <tr class="text-uppercase th-head-inputs">
            <th>N°</th>
            <th>PROYECTO</th>
            <th>SEDE</th>
            <th>AREA</th>
            <th>CARGO</th>
            <th>DNI</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th>DÍAS-FECHA</th>
            <th>CANTIDAD-DÍAS</th>
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
            <th>DIAS-FECHA</th>
            <th>CANTIDAD-DÍAS</th>
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
                <td class="text-center" style="mso-number-format:\@"><?php echo $listado['dias_visitas'] ?></td>
                <td class="text-center">
                    <button class='btn bgm-cyan btn-icon waves-effect waves-circle waves-float alinear-i' ><?php echo $listado['cantidad_visitas'] ?></button>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
