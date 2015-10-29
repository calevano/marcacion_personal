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
            <th><i class="zmdi zmdi-calendar mdc-text-blue-700"></i> FECHA</th>
            <th>SEDE INGRESO</th>
            <th><i class="zmdi zmdi-timer mdc-text-green-400"></i> HORA INGRESO</th>
            <th>SEDE SALIDA</th>
            <th><i class="zmdi zmdi-timer-off mdc-text-red-A700"></i> HORA SALIDA</th>
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
            <th>FECHA</th>
            <th>SEDE INGRESO</th>
            <th>HORA INGRESO</th>
            <th>SEDE SALIDA</th>
            <th>HORA SALIDA</th>
        </tr>
    </tfoot>
    <tbody class="bodyTablaListado">
        <?php $n=1; if(count($listado_persona)>0 ) : ?>
        <?php foreach ($listado_persona as $persona) : ?>
            <tr>
                <td class="text-center"><?php echo $n++; ?></td>
                <td class="text-center"><?php echo $persona['nombre_corto_proyecto'] ?></td>
                <td><?php echo $persona['nombre_sede'] ?></td>
                <td><?php echo $persona['nombre_area'] ?></td>
                <td><?php echo $persona['nombre_cargo'] ?></td>
                <td class="text-center" style="mso-number-format:\@"><?php echo $persona['dni'] ?></td>
                <td><?php echo $persona['nombres_apellidos'] ?></td>
                <td class="text-center"><?php echo $persona['fecha'] ?></td>
                <td class="text-center <?php echo verifica_hora($persona['hora_ingreso']) ?>"><?php echo nombre_sede($persona['ingreso_en']) ?></td>
                <td class="text-center <?php echo verifica_hora($persona['hora_ingreso']) ?>"><?php echo $persona['hora_ingreso'] ?></td>
                <td class="text-center <?php echo verifica_hora($persona['hora_salida']) ?>"><?php echo nombre_sede($persona['salida_en']) ?></td>
                <td class="text-center <?php echo verifica_hora($persona['hora_salida']) ?>"><?php echo $persona['hora_salida'] ?></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
