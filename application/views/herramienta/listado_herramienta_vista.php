<?php
$id_rol=$this->session->userdata('userIdRol');
?>
<section id="content">
   <div class="container">
        <div class="block-header p-0">
            <ul class="actions right-0">
                <li data-toggle="tooltip" data-placement="bottom" title="CREAR CARGO">
                    <a data-toggle="modal" href="<?php echo base_url('herramientas/crear'); ?>" data-target="#agregarCargoModal" ><i class="zmdi zmdi-assignment-account alinear-i"></i></a>
                </li>
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
        <?php if ($id_rol==1) : ?>
        <div class="row  ">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body card-padding">
                        <!-- <form class="row" role="form" id="form_upload_herramienta" method="post" action="<?php #echo base_url('herramientas/upload') ?>" enctype="multipart/form-data"> -->
                        <form class="row" role="form" id="form_upload_herramienta" enctype="multipart/form-data">
                            <div class="col-sm-6">
                                <!-- <p class="f-500 c-black m-b-20">Seleccionar Archivo</p> -->
                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                    <span class="btn btn-info btn-file cursor-pointer">
                                        <span class="fileinput-new ">SELECCIONAR ARCHIVO <i class="zmdi zmdi-cloud-upload "></i></span>
                                        <span class="fileinput-exists" >CAMBIAR</span>
                                        <input type="file" name="upload_cargo" accept=".csv">
                                    </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="hidden" name="valorCargos" value="valorCrearCargos" />
                                <button type="button" name="" class="btn btn-primary btn-sm " id="btnEnviarCargos">ENVIAR</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Listado de áreas y cargos </h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="table-responsive row-none" id="resultado_filtro">
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
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="fixed-action-btn">
                <a data-toggle="modal" href="<?php echo base_url('herramientas/crear'); ?>" data-target="#agregarCargoModal" class="btn bgm-cyan btn-float waves-effect"><i class="zmdi zmdi-assignment-account alinear-i"></i></a>
            </div>

            <div class="modal animated zoomIn" id="agregarCargoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content"></div>
                </div>
            </div>

            <div class="modal animated zoomIn" id="editarCargoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content"></div>
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
