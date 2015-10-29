<section id="content">
   <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <a href="<?php echo base_url('asistencia/listado') ?>">
                        <div class="card-header ch-alt">
                            <h2>LISTADO DE VISITA DIARIA <small>Filtrar por proyecto, sede, area, cargo, dni</small></h2>
                            <button class="btn bgm-teal btn-float waves-effect"><i class="zmdi zmdi-time zmdi-hc-spin alinear-i"></i></button>
                        </div>

                        <div class="card-body card-padding">
                            <p class="c-black">En esta sección podrá encontrar lo siguiente:</p>

                            <ul class="clist clist-check">
                                <li>Listado de visitas diarías</li>
                                <li>Seleccionar fecha de visita</li>
                                <li>Descargar el listado de visita por día</li>
                                <li>Descargar la selección de la visita por fecha</li>
                                <li>Ver la cantidad de entrada y salida de la visita</li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="card ">
                    <a href="<?php echo base_url('asistencia/por-rango') ?>">
                        <div class="card-header ch-alt">
                            <h2>VISITA POR RANGO <small>Filtrar por proyecto, sede, area, cargo, dni</small></h2>
                            <button class="btn bgm-lightgreen btn-float waves-effect"><i class="zmdi zmdi-calendar-note alinear-i"></i></button>
                        </div>

                        <div class="card-body card-padding">
                            <p class="c-black">En esta sección podrá encontrar lo siguiente:</p>

                            <ul class="clist clist-check">
                                <li>Lista de visita por rango a partir de las 20:00</li>
                                <li>Seleccionar rango de fecha de visitas</li>
                                <li>Descargar rango de fecha de visitas</li>
                                <li>Descargar la selección de rango de fecha de la visitas</li>
                                <li>Ver la cantidad de días de la visita a partir de las 20:00</li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <a href="<?php echo base_url('asistencia/listado-persona') ?>">
                        <div class="card-header ch-alt">
                            <h2>LISTADO DE VISITA POR PERSONA <small>Filtrar por dni, fecha desde, fecha hasta</small></h2>
                            <button class="btn bgm-lightgreen btn-float waves-effect"><i class="zmdi zmdi-face alinear-i"></i></button>
                        </div>

                        <div class="card-body card-padding">
                            <p class="c-black">En esta sección podrá encontrar lo siguiente:</p>

                            <ul class="clist clist-check">
                                <li>Listado de visita de la persona por rango de fechas</li>
                                <li>Seleccionar rango de fecha de visita desde - hasta</li>
                                <li>Descargar el listado de visita por DNI</li>
                                <li>Descargar la selección de la visita por fecha desde - hasta</li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>