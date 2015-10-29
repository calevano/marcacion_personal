<div class="modal-header bgm-blue mi_titulo_handle">
    <h4 class="modal-title text-center text-white "><i class='zmdi zmdi-assignment-account'></i> CANTIDAD DE VISITAS</h4>
</div>

<div class="modal-body">
    <div class="card" id="profile-main">
        <div class="pm-overview c-overflow">
            <div class="pmo-pic">
                <div class="p-relative">
                    <!-- <a href="javascript:;"> -->
                        <img class="img-responsive img-responsive-sm" src="http://iinei.inei.gob.pe/iinei/asistencia/fotos/<?php echo $visitas[0]['dni'] ?>.jpg" onerror="this.src='<?php echo base_url('assets/img/profile-pics/imagen-no-disponible.jpg') ?>'" alt="">
                    <!-- </a> -->
                </div>

                <div class="indigo-900 pmo-stat ">
                    <h2 class="m-0 c-white f-z-20"><i class="zmdi zmdi-account-box-mail"></i> <?php echo $visitas[0]['dni'] ?></h2>
                </div>
            </div>

            <div class="pmo-block pmo-contact hidden-xs">
                <h2 class="text-center">DATOS</h2>

                <ul>
                    <li><i class="zmdi zmdi-account"></i> <?php echo $visitas[0]['nombres_apellidos'] ?></li>
                    <li><i class="zmdi zmdi-balance"></i> <?php echo $visitas[0]['nombre_corto_proyecto'] ?></li>
                    <li><i class="zmdi zmdi-pin"></i> <?php echo $visitas[0]['nombre_sede'] ?></li>
                    <li><i class="zmdi zmdi-layers"></i> <?php echo $visitas[0]['nombre_area'] ?></li>
                    <li><i class="zmdi zmdi-assignment-account"></i> <?php echo $visitas[0]['nombre_cargo'] ?></li>
                </ul>
            </div>
        </div>
        <div class="pm-body clearfix">

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-calendar mdc-text-blue-900"></i> <span class="today" ></span></h2>
                </div>
                <div class="pmbb-body">
                    <div class="pmbb-view">
                        <table id="tablaListado" class="table table-bordered">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase th-head-inputs modalTabla">
                                    <th><i class="zmdi zmdi-timer mdc-text-green-400"></i> INGRESO</th>
                                    <th><i class="zmdi zmdi-timer-off mdc-text-red-A700"></i> ÚLTIMA VISITA</th>
                                </tr>
                            </thead>
                            <tbody class="bodyTablaListado">
                            <?php if(count($visitas)>0): ?>
                            <?php foreach ($visitas as $visita) : ?>
                                <tr>
                                    <td class="text-center <?php echo verifica_hora($visita['hora_ingreso']) ?>"><?php echo $visita['hora_ingreso'] ?></td>
                                    <td class="text-center <?php echo verifica_hora($visita['hora_salida']) ?>"><?php echo $visita['hora_salida'] ?></td>
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

    <div class="text-center">
        <button type="button" class="btn btn-danger waves-effect m-l-10" data-dismiss="modal" >CERRAR</button>
    </div>
</div>
<script>
    $(".today").text(moment("<?php echo $visitas[0]['fecha'] ?>","YYYYMMDD").format('dddd, DD [de] MMMM [del] YYYY'));
</script>