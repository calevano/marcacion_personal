<div class="modal-header bgm-blue">
    <h4 class="modal-title text-center text-white"><i class='zmdi zmdi-assignment-account'></i> AGREGAR CARGO</h4>
</div>

<div class="modal-body">
    <form class="row padding-top-10 verificando_form" role="form" autocomplete="off" id="form_crear_cargo">
        <div class="col-sm-12">
            <div class="form-group fg-line">
                <label for="area_crear">ÁREA</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-layers zmdi-hc-2x"></i></span>
                    <div class="col-sm-12">
                        <div class="fg-line select">
                            <select class="form-control" id="area_crear" name="area_crear">
                                <?php if(count($lista_areas)>0) : ?>
                                <?php foreach ($lista_areas as $area) : ?>
                                <option value="<?php echo $area['id'] ?>"><?php echo strtoupper($area['nombre_area']) ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group fg-line">
                <label for="cargo_crear">CARGO</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="zmdi zmdi-assignment-account zmdi-hc-2x"></i></span>
                    <div class="fg-line limipiar-error">
                        <textarea id="cargo_crear" name="cargo_crear" class="form-control text-uppercase" placeholder="INGRESE NUEVO CARGO"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 text-center">
            <input name="valorCargo" type="hidden" value="valorCrearCargo"/>
            <button type="button" class="btn btn-success waves-effect m-r-10 disabled" name="crearCargo" id="btnCreateCargo">AGREGAR</button>
            <button type="button" class="btn btn-danger waves-effect m-l-10" data-dismiss="modal" id="cancelarEventoModal">CANCELAR</button>
        </div>
    </form>
</div>
<script>
    $("#cargo_crear").on('keyup',function(){
        if($(this).val().length>5){
            if($(this).val() !="" ){
                $("#btnCreateCargo").removeClass('disabled');
            }else{
                $("#btnCreateCargo").removeClass('disabled').addClass('disabled');
            }
        }else{
            $("#btnCreateCargo").removeClass('disabled').addClass('disabled');
        }
    });
</script>