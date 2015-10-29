
<div class="modal-header bgm-blue">
    <h4 class="modal-title text-center text-white"><i class='zmdi zmdi-edit'></i> EDITAR PERSONAL</h4>
</div>
<div class="modal-body">
    <form id="form_editar_persona" autocomplete="off" class="row padding-top-10 verificando_form" >
        <input type="hidden" name="hidden_id_persona_editar" value="<?php echo $persona['id'] ?>">
        <div class="col-sm-12 no-padding">

            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="proyecto_editar">PROYECTO</label>
                    <select class="selectpicker " data-live-search="true" name="proyecto_editar" id="proyecto_editar" >
                        <?php if(count($lista_proyecto)>0):?>
                        <?php foreach ($lista_proyecto as $proyecto) : ?>
                        <option value="<?php echo $proyecto['id'] ?>" <?php echo ($proyecto['id']==$persona['tbl_proyecto_id'])? " selected ": ""; ?> ><?php echo strtoupper($proyecto['nombre_corto']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="sede_editar">SEDE</label>
                    <select class="selectpicker" data-live-search="true" name="sede_editar" id="sede_editar">
                        <?php if(count($lista_sede)>0):?>
                        <?php foreach ($lista_sede as $sede) : ?>
                        <option value="<?php echo $sede['id'] ?>" <?php echo ($sede['id']==$persona['tbl_sede_id'])? " selected ": ""; ?> ><?php echo strtoupper($sede['nombre']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="form-group fg-line">
                    <label for="area_editar">AREA</label>
                    <select class="selectpicker" data-live-search="true" name="area_editar" id="area_editar">
                        <?php if(count($lista_area)>0):?>
                        <?php foreach ($lista_area as $area) : ?>
                        <option value="<?php echo $area['id'] ?>" <?php echo ($area['id']==$persona['tbl_area_id'])? " selected ": ""; ?> ><?php echo strtoupper($area['nombre']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

        </div>

        <div class="col-sm-12 no-padding">

            <div class="col-md-6 col-sm-8">
                <div class="form-group fg-line">
                    <label for="cargo_editar" >CARGO <span class="label_cargo_editar"></span></label>
                    <select class="selectpicker" data-live-search="true" name="cargo_editar" id="cargo_editar">
                        <?php if(count($lista_cargo)>0):?>
                        <?php foreach ($lista_cargo as $cargo) : ?>
                        <option value="<?php echo $cargo['id'] ?>" <?php echo ($cargo['id']==$persona['tbl_cargo_id'])? " selected ": ""; ?> ><?php echo strtoupper($cargo['nombre']) ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group fg-line">
                    <label for="apellidos_editar">APELLIDOS Y NOMBRES</label>
                    <input type="text" name="apellidos_editar" class="form-control text-center text-uppercase input-sm " value="<?php echo $persona['nombres_apellidos'] ?>" id="apellidos_editar" placeholder="APELLIDOS Y NOMBRES">
                </div>
            </div>

        </div>

        <div class="col-sm-12 no-padding">

            <div class="col-md-2 col-sm-2">
                <div class="form-group fg-line">
                    <label for="dni_editar">DNI</label>
                    <input type="text" name="dni_editar" class="form-control text-center text-uppercase input-sm solonumeros" value="<?php echo $persona['dni'] ?>" id="dni_editar" readonly="readonly" placeholder="DNI" maxlength="8" >
                    <input type="hidden" name="dni_editar_hidden" value="<?php echo $persona['dni'] ?>">
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="email_editar">E-MAIL</label>
                    <input type="text" name="email_editar" class="form-control text-center input-sm " id="email_editar" value="<?php echo $persona['email'] ?>" placeholder="E-MAIL" >
                    <input type="hidden" name="email_editar_hidden" value="<?php echo $persona['email'] ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="form-group fg-line">
                    <label for="tel_personal_editar">TELEFONO-PERSONAL</label>
                    <input type="text" name="tel_personal_editar" class="form-control text-center text-uppercase input-sm  solonumeros" value="<?php echo $persona['telefono_personal'] ?>" id="tel_personal_editar" placeholder="TELEFONO-PERSONAL" maxlength="10" >
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group fg-line">
                    <label for="tel_inei_editar">TELEFONO-INEI</label>
                    <input type="text" name="tel_inei_editar" class="form-control text-center text-uppercase input-sm " value="<?php echo $persona['telefono_inei'] ?>" id="tel_inei_editar" placeholder="TELEFONO-INEI" maxlength="10" >
                </div>
            </div>

        </div>

        <div class="col-sm-12 no-padding">
            <div class="col-sm-12 text-center">
                <input name="valorPersona" type="hidden" value="valorEditarPersona"/>
                <button type="submit" class="btn btn-success waves-effect m-r-10" name="editarPersona"  id="btnEditarPersona">EDITAR</button>
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
    $("#area_editar").on('change',function(){
        //console.log("cambiando valor: "+$(this).val());
        $.ajax({
            url:CI.base_url+'ajax-listar-cargos',
            type:'POST',
            data:{id_area:$(this).val()},
            dataType:'json',
            beforeSend:function(){
                $(".label_cargo_editar").html('<i class="zmdi zmdi-settings zmdi-hc-spin mdc-text-amber"></i>');
            },
            success:function(response){
                $(".label_cargo_editar").html('');
                if(!response.error){
                    var options = "";
                    $.each(response.cargos,function(i,item){
                        options +='<option value="'+item.id+'">'+item.nombre+'</option>';
                    });
                    $("#cargo_editar").html(options);
                    $('#cargo_editar').selectpicker('refresh');
                }else{
                    //console.log("aqui si hay un error");
                    $("#cargo_editar").html('');
                }
            },
            error:function(err){
                console.log(err);
            }
        });
    });
});
</script>
