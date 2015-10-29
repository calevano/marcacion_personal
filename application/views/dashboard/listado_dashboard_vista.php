<?php
$id_rol = $this->session->userdata('userIdRol');
?>
<section id="content">
   <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6  ">
                <div class="card">
                    <a href="<?php echo base_url('personal') ?>">
                        <div class="card-header ch-alt bgm-cyan">
                            <h2>PERSONAL <small></small></h2>
                            <button class="btn bgm-deeppurple btn-float waves-effect"><i class="zmdi zmdi-face alinear-i"></i></button>
                        </div>

                        <div class="card-body card-padding">
                            <p class="c-black">Módulo para ver la lista de las personas que prestan servicios para el INEI en difrerentes sedes.</p>

                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="card ">
                    <a href="<?php echo base_url('asistencia') ?>">
                        <div class="card-header ch-alt bgm-deeppurple">
                            <h2>ASISTENCIA <small></small></h2>
                            <button class="btn bgm-cyan btn-float waves-effect"><i class="zmdi zmdi-assignment alinear-i"></i></button>
                        </div>

                        <div class="card-body card-padding">
                            <p class="c-black">Módulo para ver la asistencia del personal, pódra ver un lista diaria o pódra tener una lista en determindas fechas.</p>

                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="card">
                    <a href="<?php echo base_url('herramientas') ?>">
                        <div class="card-header ch-alt bgm-teal">
                            <h2>HERRAMIENTAS <small></small></h2>
                            <button class="btn bgm-lightgreen btn-float waves-effect"><i class="zmdi zmdi-settings alinear-i zmdi-hc-spin"></i></button>
                        </div>

                        <div class="card-body card-padding">
                            <p class="c-black">Módulo para gestionar las áreas y cargos.</p>


                        </div>
                    </a>
                </div>
            </div>

            <?php if ($id_rol<=2) : ?>
            <div class="col-md-6 col-sm-6">
                <div class="card">
                    <a href="<?php echo base_url('usuarios') ?>">
                        <div class="card-header ch-alt bgm-lightgreen">
                            <h2>USUARIOS <small></small></h2>
                            <button class="btn bgm-teal btn-float waves-effect"><i class="zmdi zmdi-accounts alinear-i"></i></button>
                        </div>

                        <div class="card-body card-padding">
                            <p class="c-black">Módulo para ver la lista de usuarios que tienen acceso al sistema de marcación y tambien el listado de las personas que aparecen en la APP creada para los SmartPhone con sistema operativo "Android ( <i class="zmdi zmdi-android mdc-text-green-700"></i> )" </p>
                        </div>
                    </a>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>