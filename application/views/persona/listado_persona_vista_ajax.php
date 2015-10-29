<table width="100%" id="tablaListado" class="table table-bordered table-striped table-hover" >
    <thead class="headTablaListado">
        <tr class="text-uppercase th-head-inputs">
            <th>N°</th>
            <th>DNI</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th>E-MAIL</th>
            <th>TELÉFONO [PERSONAL-INEI]</th>
            <th>FECHA NACIMIENTO</th>
            <th>PROYECTO</th>
            <th>SEDE</th>
            <th>ÁREA</th>
            <th>CARGO</th>
            <th>ACTUALIZADO</th>
            <th>ESTADO</th>
            <th>EDITAR</th>
        </tr>
    </thead>
    <tfoot class="footTablaListado">
        <tr class="text-uppercase">
            <th>N°</th>
            <th>DNI</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th>E-MAIL</th>
            <th>TELEFONO PERSONAL-INEI</th>
            <th>FECHA NACIMIENTO</th>
            <th>PROYECTO</th>
            <th>SEDE</th>
            <th>AREA</th>
            <th>CARGO</th>
            <th>ACTUALIZADO</th>
            <th>ESTADO</th>
            <th>EDITAR</th>
        </tr>
    </tfoot>
    <tbody class="bodyTablaListado">
    <?php $n=1; if(count($total_personas)>0): ?>
    <?php foreach ($total_personas as $persona) : ?>
        <tr>
            <td class="text-center"><?php echo $n++; ?></td>
            <td class="text-center" style="mso-number-format:\@"><?php echo $persona['dni'] ?></td>
            <td><?php echo $persona['nombres_apellidos'] ?></td>
            <td><?php echo $persona['email'] ?></td>
            <td class="text-center">
                <?php
                echo ($persona['telefono_personal']!="") ? "<i class='zmdi zmdi-phone'></i> ".$persona['telefono_personal']."<br>" : "" ;
                echo ($persona['telefono_inei']!="") ? "<i class='zmdi zmdi-smartphone-android'></i> ".$persona['telefono_inei'] : "" ;
                ?>
            </td>
            <td><?php echo $persona['fecha_nacimiento'] ?></td>
            <td><?php echo $persona['nombre_corto_proyecto'] ?></td>
            <td><?php echo $persona['nombre_sede'] ?></td>
            <td><?php echo $persona['nombre_area'] ?></td>
            <td><?php echo $persona['nombre_cargo'] ?></td>
            <td class="text-center"><?php echo $persona['creado_por']?></td>
            <td class="text-center">
                <span data-toggle="tooltip" data-placement="top" title="CAMBIAR ESTADO">
                    <a data-persona-estado="<?php echo $persona['estado'] ?>" data-persona-id="<?php echo $persona['id'] ?>" data-persona-dni="<?php echo $persona['dni'] ?>" data-persona-nombre-apellido="<?php echo $persona['nombres_apellidos'] ?>"  class='cambiar_estado_persona btn <?php echo ($persona['estado']==1)? " bgm-lightgreen " : " bgm-deeporange " ; ?> btn-icon waves-effect command-estado waves-circle waves-float alinear-i' ><?php echo verificar_estado($persona['estado']) ?></a>
                </span>
            </td>
            <td class="text-center">
                <span data-toggle="tooltip" data-placement="top" title="EDITAR">
                    <a data-toggle="modal" href="<?php echo base_url('personal/editar'); ?>?id_persona=<?php echo $persona['id'] ?>" data-target="#editarPersonaModal" class='btn btn-icon btn-success waves-effect waves-circle waves-float abrir_modal_editar alinear-i'><i class='zmdi zmdi-edit '></i></a>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php endif;?>
    </tbody>
</table>
