<section id="content">
   <div class="container">
        <div class="block-header p-0">
            <!-- <h2>Lista de usuarios</h2> -->

            <ul class="actions right-0">
                <!-- <li data-toggle="tooltip" data-placement="bottom" title="CREAR USUARIO">
                    <a data-toggle="modal" href="<?php echo base_url('usuario/crear'); ?>" data-target="#agregarUsuarioModal" ><i class="zmdi zmdi-account-add alinear-i"></i></a>
                </li> -->
                <li data-toggle="tooltip" data-placement="bottom" title="DESCARGAR PADRON">
                    <a href="javascript:;" class="exportar_tabla_reporte"><i class="zmdi zmdi-cloud-download mdc-text-green"></i></a>
                </li>
            </ul>

            <form action="<?php echo base_url('ajax-exportar-tabla') ?> " method="post" target="_blank" id="form_exportar_tabla">
                <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                <input type="hidden" name="nombre_archivo" value="<?php echo url_amigable(notildes($titulo)) ?>">
                <input type="hidden" name="nombre_fecha" id="nombre_fecha" value="<?php echo date('Y-m-d') ?>">
            </form>

        </div>


    <div class="card">
      <div class="card-header">
        <h2>Lista de usuarios <small></small></h2>
      </div>

      <div class="table-responsive row-none" id="resultado_filtro">
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
      </div>
      <!-- <div class="fixed-action-btn">
        <a data-toggle="modal" href="<?php echo base_url('usuario/crear'); ?>" data-target="#agregarUsuarioModal" class="btn bgm-cyan btn-float waves-effect"><i class="zmdi zmdi-account-add alinear-i"></i></a>
      </div> -->

        <div class="modal animated zoomIn" id="agregarUsuarioModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content"></div>
            </div>
        </div>

      <div class="modal animated zoomIn" id="editarUsuarioModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<script>
$(function () {
  tablaListadoDataTable();
  $('.modal').draggable({handle: 'div.modal-header'});

});
</script>




