<?php
$hasta      = date('d-m-Y');
$de         = strtotime('-7 day', strtotime($hasta));
$nuevafecha = date('d-m-Y', $de);
?>
<section id="content">
    <div class="container">
        <div class="block-header p-0">
            <ul class="actions right-0">
                <li data-toggle="tooltip" data-placement="bottom" title="DESCARGAR VISITA">
                    <a href="javascript:;" class="exportar_tabla_reporte"><i class="zmdi zmdi-cloud-download mdc-text-green"></i></a>
                </li>
            </ul>
            <form action="<?php echo base_url('ajax-exportar-tabla') ?> " method="post" target="_blank" id="form_exportar_tabla">
                <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                <input type="hidden" name="nombre_archivo" value="<?php echo url_amigable(notildes($titulo)) ?>">
                <input type="hidden" name="nombre_fecha" id="nombre_fecha" value="<?php echo date('Y-m-d') ?>">
            </form>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header" id="format-dates">
                        <h2>Rango de visitas del <i class="zmdi zmdi-time mdc-text-green-A700"></i> <strong>"<span class="today_from"></span>"</strong> hasta el <i class="zmdi zmdi-time mdc-text-red-A700"></i> <strong>"<span class="today_to"></span>"</strong> <small></small></h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="row">
                            <div class="col-sm-12 p-20">

                                <div class="col-sm-2 " >
                                    <div class="form-group">
                                        <div class="fg-line">
                                            <label for="listado_sedes">SEDE</label>
                                            <div class="select">
                                                <select class="selectpicker" data-live-search="true" name="listado_sedes" id="listado_sedes" multiple>
                                                    <?php if(count($listado_sedes)>0) : ?>
                                                    <?php foreach ($listado_sedes as $sede) : ?>
                                                        <option value="<?php echo $sede['id'] ?>"><?php echo $sede['nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 " >
                                    <div class="form-group">
                                        <div class="fg-line">
                                            <label for="listado_area">ÁREA</label>
                                            <div class="select">
                                                <select class="selectpicker" data-live-search="true" name="listado_area" id="listado_area" multiple>
                                                    <?php if(count($listado_areas)>0) : ?>
                                                    <?php foreach ($listado_areas as $areas) : ?>
                                                        <option value="<?php echo $areas['id'] ?>"><?php echo $areas['nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2" >
                                    <div class="form-group">
                                        <div class="fg-line">
                                            <label for="fecha_de">DE</label>
                                            <div class="input-group form-group">
                                                <span class="input-group-addon " ><i class="zmdi zmdi-calendar-alt zmdi-hc-2x"></i></span>
                                                <div class="dtp-container dropdown fg-line">
                                                    <input type="text" id="fecha_de" name="fecha_de" value="<?php echo $nuevafecha ?>" class="form-control input-sm date-picker-span" data-toggle="dropdown"  placeholder="Click aqui...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2" >
                                    <div class="form-group">
                                        <div class="fg-line">
                                            <label for="fecha_hasta">HASTA</label>
                                            <div class="input-group form-group">
                                                <span class="input-group-addon " ><i class="zmdi zmdi-calendar zmdi-hc-2x"></i></span>
                                                <div class="dtp-container dropdown fg-line">
                                                    <input type="text" id="fecha_hasta" name="fecha_hasta" value="<?php echo date('d-m-Y') ?>" class="form-control input-sm date-picker-span" data-toggle="dropdown"  placeholder="Click aqui...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <div class="fg-line">
                                            <button type="button" class="btn btn-success waves-effect btn-icon-text" id="btnFiltrarListadoRango"><i class="zmdi zmdi-filter-list"></i> FILTRAR</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-12 ">
                                <div class="table-responsive row-none" id="resultado_filtro">
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
                                                        <button  class='btn bgm-cyan btn-icon waves-effect waves-circle waves-float alinear-i' ><?php echo $listado['cantidad_visitas'] ?></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="modal animated zoomIn" id="visitasModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
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
    $(".today_from").text(moment().subtract(7,'days').format('dddd, DD [de] MMMM [del] YYYY'));
    $(".today_to").text(moment().format('dddd, DD [de] MMMM [del] YYYY'));
});
</script>
