<div class="modal-header bgm-blue">
    <h4 class="modal-title text-center text-white"><i class='zmdi zmdi-face'></i> CREAR PERSONAL</h4>
</div>
<div class="modal-body">
    <form id="form_crear_persona" autocomplete="off" class="row padding-top-10 verificando_form" >

        <div class="col-sm-12 no-padding">

            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="proyecto_crear">PROYECTO</label>
                    <select class="selectpicker " data-live-search="true" name="proyecto_crear" id="proyecto_crear" >
                        <?php if(count($lista_proyecto)>0):?>
                        <?php foreach ($lista_proyecto as $proyecto) : ?>
                        <option value="<?php echo $proyecto['id'] ?>"><?php echo strtoupper($proyecto['nombre_corto']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="sede_crear">SEDE</label>
                    <select class="selectpicker" data-live-search="true" name="sede_crear" id="sede_crear">
                        <?php if(count($lista_sede)>0):?>
                        <?php foreach ($lista_sede as $sede) : ?>
                        <option value="<?php echo $sede['id'] ?>"><?php echo strtoupper($sede['nombre']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="form-group fg-line">
                    <label for="area_crear">AREA</label>
                    <select class="selectpicker" data-live-search="true" name="area_crear" id="area_crear">
                        <?php if(count($lista_area)>0):?>
                        <?php foreach ($lista_area as $area) : ?>
                        <option value="<?php echo $area['id'] ?>"><?php echo strtoupper($area['nombre']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

        </div>

        <div class="col-sm-12 no-padding">

            <div class="col-md-6 col-sm-8">
                <div class="form-group fg-line">
                    <label for="cargo_crear" >CARGO <span class="label_cargo_crear"></span></label>
                    <select class="selectpicker" data-live-search="true" name="cargo_crear" id="cargo_crear">
                        <?php if(count($lista_cargo)>0):?>
                        <?php foreach ($lista_cargo as $cargo) : ?>
                        <option value="<?php echo $cargo['id'] ?>"><?php echo strtoupper($cargo['nombre']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group fg-line">
                    <label for="apellidos_crear">APELLIDOS Y NOMBRES</label>
                    <input type="text" name="apellidos_crear" class="form-control text-center text-uppercase input-sm " id="apellidos_crear" placeholder="APELLIDOS Y NOMBRES">
                </div>
            </div>

        </div>

        <div class="col-sm-12 no-padding">

            <div class="col-md-2 col-sm-2">
                <div class="form-group fg-line">
                    <label for="dni_crear">DNI</label>
                    <input type="text" name="dni_crear" class="form-control text-center text-uppercase input-sm solonumeros" id="dni_crear" placeholder="DNI" maxlength="8" >
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="email_crear">E-MAIL</label>
                    <input type="text" name="email_crear" class="form-control text-center input-sm " id="email_crear" placeholder="E-MAIL" >
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="tel_personal_crear">TELEFONO-PERSONAL</label>
                    <input type="text" name="tel_personal_crear" class="form-control text-center text-uppercase input-sm  solonumeros" id="tel_personal_crear" placeholder="TELEFONO-PERSONAL" maxlength="10" >
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group fg-line">
                    <label for="tel_inei_crear">TELEFONO-INEI</label>
                    <input type="text" name="tel_inei_crear" class="form-control text-center text-uppercase input-sm " id="tel_inei_crear" placeholder="TELEFONO-INEI" maxlength="10" >
                </div>
            </div>

        </div>

        <div class="col-sm-12 no-padding">
            <div class="col-sm-12 text-center">
                <input name="valorPersona" type="hidden" value="valorCrearPersona"/>
                <button type="submit" class="btn btn-success waves-effect m-r-10" name="crearPersona"  id="btnCreatePersona">CREAR</button>
                <button type="button" class="btn btn-danger waves-effect m-l-10" data-dismiss="modal" id="cancelarEventoModal">CANCELAR</button>
            </div>
        </div>

    </form>
</div>
<script>
$(function(){
    $('.selectpicker').selectpicker();
    $(".solonumeros").keypress(function (e) {
        return validarNumero(e);
    });

    //Select dinamico area-cargo
    $("#area_crear").on('change',function(){
        //console.log("cambiando valor: "+$(this).val());
        $.ajax({
            url:CI.base_url+'ajax-listar-cargos',
            type:'POST',
            data:{id_area:$(this).val()},
            dataType:'json',
            beforeSend:function(){
                $(".label_cargo_crear").html('<i class="zmdi zmdi-settings zmdi-hc-spin mdc-text-amber"></i>');
            },
            success:function(response){
                $(".label_cargo_crear").html('');
                if(!response.error){
                    //console.log(response);
                    var options = "";
                    $.each(response.cargos,function(i,item){
                        options +='<option value="'+item.id+'">'+item.nombre+'</option>';
                    });
                    $("#cargo_crear").html(options);
                    $('#cargo_crear').selectpicker('refresh');
                }else{
                    console.log("aqui si hay un error");
                    $("#cargo_crear").html('');
                }
            },
            error:function(err){
                console.log(err);
            }
        });
    });
});
</script>
