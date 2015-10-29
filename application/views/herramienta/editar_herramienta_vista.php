<div class="modal-header bgm-blue">
    <h4 class="modal-title text-center text-white"><i class='zmdi zmdi-edit'></i> EDITAR CARGO</h4>
</div>

<div class="modal-body">
    <form class="row padding-top-10 verificando_form" role="form" autocomplete="off" id="form_editar_cargo">
        <input type="hidden" name="hidden_id_cargo_editar" value="<?php echo $cargo['id'] ?>">
        <div class="col-sm-12">
            <div class="form-group fg-line">
                <label for="area_editar">ÁREA</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-layers zmdi-hc-2x"></i></span>
                    <div class="col-sm-12">
                        <div class="fg-line select">
                            <select class="form-control" id="area_editar" name="area_editar">
                                <?php if(count($lista_areas)>0) : ?>
                                <?php foreach ($lista_areas as $area) : ?>
                                <option value="<?php echo $area['id'] ?>" <?php echo ($area['id']==$cargo['tbl_area_id'])? " selected " : "" ; ?>><?php echo strtoupper($area['nombre_area']) ?></option>
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
                <label for="cargo_editar">CARGO</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="zmdi zmdi-assignment-account zmdi-hc-2x"></i></span>
                    <div class="fg-line limipiar-error">
                        <textarea id="cargo_editar" name="cargo_editar" class="form-control text-uppercase" placeholder="INGRESE NUEVO CARGO"><?php echo $cargo['nombre_cargo'] ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 text-center">
            <input name="valorCargo" type="hidden" value="valorEditarCargo"/>
            <button type="button" class="btn btn-success waves-effect m-r-10 " name="editarCargo" id="btnEditarCargo">EDITAR</button>
            <button type="button" class="btn btn-danger waves-effect m-l-10" data-dismiss="modal" id="cancelarEventoModal">CANCELAR</button>
        </div>
    </form>
</div>