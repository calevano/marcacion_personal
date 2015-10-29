<table id="tablaListado" class="table table-bordered table-striped table-hover width-100" >
  <thead class="headTablaListado">

    <tr class="text-uppercase text-center th-head-inputs">
        <th>N°</th>
        <th>PERFIL</th>
        <th>USUARIO</th>
        <th>APELLIDOS Y NOMBRES</th>
        <th>PROYECTO</th>
        <th>EMAIL</th>
        <th>ACTUALIZADO</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
    </tr>
  </thead>
  <tfoot class="footTablaListado">
    <tr class="text-uppercase">
        <th>N°</th>
        <th>PERFIL</th>
        <th>USUARIO</th>
        <th>APELLIDOS Y NOMBRES</th>
        <th>PROYECTO</th>
        <th>EMAIL</th>
        <th>ACTUALIZADO</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
    </tr>
  </tfoot>
  <tbody class="bodyTablaListado">
  <?php $n=1;
  foreach ($total_usuarios as $usuario) : ?>
    <tr>
      <td class="text-center"><?php echo $n++; ?></td>
      <td><?php echo $usuario['nombre_perfil'] ?></td>
      <td style="mso-number-format:\@"><?php echo $usuario['nombre'] ?></td>
      <td><?php echo $usuario['nombres_apellidos']?></td>
      <td><?php echo $usuario['nombre_corto_proyecto'] ?></td>
      <td class="text-lowercase"><?php echo $usuario['email'] ?></td>
      <td class="text-center" style="mso-number-format:\@"><?php echo $usuario['creado_por'] ?></td>
      <td class="text-center">
        <span data-toggle="tooltip" data-placement="top" title="Cambiar estado">
          <a data-usuario-estado="<?php echo $usuario['estado'] ?>" data-usuario-id="<?php echo $usuario['id'] ?>" data-usuario-nombre="<?php echo $usuario['nombre'] ?>"  data-usuario-nombre-apellido="<?php echo $usuario['nombres_apellidos'] ?>" class='cambiar_estado_usuario btn <?php echo ($usuario['estado']==1)? " bgm-lightgreen " : " bgm-deeporange " ; ?>  waves-effect command-estado btn-icon alinear-i waves-circle waves-float'><?php echo verificar_estado($usuario['estado']) ?></a>
        </span>
      </td>
      <td class="text-center">
        <span data-toggle="tooltip" data-placement="top" title="Editar">
            <a data-toggle="modal" href="<?php echo base_url('usuario/editar'); ?>?id_user=<?php echo $usuario['id'] ?>" data-target="#editarUsuarioModal" class='btn btn-icon alinear-i btn-success waves-effect waves-circle waves-float abrir_modal_editar'><i class='zmdi zmdi-edit '></i></a>
        </span>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
