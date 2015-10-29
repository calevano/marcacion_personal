<?php
$id_rol=$this->session->userdata('userIdRol');
?>
<section id="content">
    <div class="container">
        <div class="block-header p-0">
            <ul class="actions right-0">
                <li data-toggle="tooltip" data-placement="bottom" title="CREAR PERSONA">
                    <a data-toggle="modal" href="<?php echo base_url('personal/crear'); ?>" data-target="#agregarPersonaModal" ><i class="zmdi zmdi-face alinear-i"></i></a>
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

                            <form class="row" role="form" method="post" action="<?php echo base_url('personal/upload') ?>" enctype="multipart/form-data">
                                <div class="col-sm-6">
                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                        <span class="btn btn-info btn-file cursor-pointer">
                                            <span class="fileinput-new ">SELECCIONAR ARCHIVO <i class="zmdi zmdi-cloud-upload "></i></span>
                                            <span class="fileinput-exists" >CAMBIAR</span>
                                            <input type="file" name="upload_personal" accept=".csv">
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <input type="hidden" name="valorPersonas" value="valorCrearPersonas" />
                                    <button type="submit" name="" class="btn btn-primary btn-sm " id="btnEnviarPersonas">ENVIAR</button>
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
                        <h2>Listado total de personas
                            <!-- <small>
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            <i class="input-helper"></i>
                                            Marcar todos
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6 text-right "><span class="">Para los elementos que están marcados:</span></div>
                                    <div class="col-sm-3"><button class="btn btn-success btn-icon-text waves-effect"><i class="zmdi zmdi-edit"></i> EDITAR</button></div>
                                    <div class="col-sm-3"><button class="btn bgm-orange btn-icon-text waves-effect"><i class="zmdi zmdi-alert-circle"></i> CAMBIAR ESTADO</button></div>
                                </div>
                            </small> -->
                        </h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="table-responsive row-none" id="resultado_filtro">
                            <table width="100%" id="tablaListado" class="table table-bordered table-striped table-hover" >
                                <thead class="headTablaListado">
                                    <tr class="text-uppercase th-head-inputs">
                                        <!-- <th>CHECK</th> -->
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
                                        <!-- <th>CHECK</th> -->
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
                                        <!-- <td class="text-center">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        </td> -->
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="fixed-action-btn">
                <a data-toggle="modal" href="<?php echo base_url('personal/crear'); ?>" data-target="#agregarPersonaModal" class="btn bgm-cyan btn-float waves-effect"><i class="zmdi zmdi-face alinear-i"></i></a>
            </div>
            <div class="modal animated zoomIn" id="agregarPersonaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xg">
                    <div class="modal-content"></div>
                </div>
            </div>

            <div class="modal animated zoomIn" id="editarPersonaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xg">
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
