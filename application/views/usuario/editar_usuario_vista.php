<div class="modal-header bgm-blue">
    <h4 class="modal-title text-center text-white"><i class='zmdi zmdi-edit'></i> EDITAR USUARIO</h4>
</div>

<div class="modal-body">
  <form id="form_editar_usuario" autocomplete="off" class="row padding-top-10 verificando_form" role="form">
    <input type="hidden" name="hidden_id_usuario_editar" value="<?php echo $usuario['id'] ?>">
    <div class="col-sm-6">
      <div class="form-group fg-line">
        <label for="perfil_usuario_editar">ROL</label>
         <div class="input-group">
            <span class="input-group-addon"><i class="zmdi zmdi-graduation-cap zmdi-hc-2x"></i></span>
            <div class="fg-line select">
             <select class="form-control" name="perfil_usuario_editar" id="perfil_usuario_editar" >
                <?php foreach ($total_perfil as $perfil) : ?>
                <option value="<?php echo $perfil['id'] ?>" <?php echo ($perfil['id']==$usuario['tbl_perfil_id'])? "selected":"" ;?>><?php echo strtoupper($perfil['nombre']) ?></option>
                <?php endforeach; ?>
             </select>
            </div>
         </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group fg-line">
        <label for="name_usuario_editar">USUARIO</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="zmdi zmdi-account-circle zmdi-hc-2x"></i></span>
          <div class="fg-line limipiar-error">
            <input type="text" id="name_usuario_editar" name="name_usuario_editar"  value="<?php echo $usuario['nombre'] ?>" class="form-control solonumeros" placeholder="INGRESE NOMBRE" maxlength="8">
            <input type="hidden" name="name_usuario_editar_hidden" value="<?php echo $usuario['nombre'] ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group fg-line">
        <label for="pass_usuario_editar">CONTRASEÑA</label>
        <div class="input-group ">
          <span class="input-group-addon"><i class="zmdi zmdi-lock zmdi-hc-2x"></i></span>
          <div class="fg-line limipiar-error">
            <input type="password" id="pass_usuario_editar" name="pass_usuario_editar" class="form-control" placeholder="INGRESE CONTRASEÑA">
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group fg-line">
        <label for="email_usuario_editar">EMAIL</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-email zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <input type="email" id="email_usuario_editar" name="email_usuario_editar" readonly="readonly" value="<?php echo $usuario['email'] ?>" class="form-control" placeholder="INGRESE EMAIL ">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group fg-line">
            <label for="apellidos_usuario_editar" class="text-center">APELLIDOS Y NOMBRES</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="zmdi zmdi-account zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <input type="text" id="apellidos_usuario_editar" name="apellidos_usuario_editar" value="<?php echo $usuario['nombres_apellidos'] ?>" class="form-control text-uppercase" placeholder="INGRESE APELLIDOS Y NOMBRES" readonly="readonly">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group fg-line">
            <label for="proyecto_usuario_editar" class="text-center">PROYECTO</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="zmdi zmdi-balance zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <textarea id="proyecto_usuario_editar" name="proyecto_usuario_editar" class="form-control text-uppercase" placeholder="PROYECTO" readonly="readonly"><?php echo $usuario['nombre_proyecto'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 text-center">
      <input name="valorUsuario" type="hidden"  value="valorEditarUsuario"/>
      <button type="submit" class="btn btn-success waves-effect m-r-10" name="editarUsuario" id="btnEditarUsuario">EDITAR</button>
      <button type="button" class="btn btn-danger waves-effect m-l-10" data-dismiss="modal" id="cancelarEventoModal">CANCELAR</button>
    </div>
  </form>
</div>
<script>
$(function(){
    //autosize($('.auto-size'));
    $(".solonumeros").keypress(function (e) {
        return validarNumero(e);
    });

    $("#name_usuario_editar").on('change',function(){
        if($(this).val()!="" && $(this).val().length==8){
            //console.log("cargando data siguiente: ", $(this).val());
            $.ajax({
                url:CI.base_url+'ajax-verificar-usuario',
                type:'POST',
                data:{dni_usuario:$(this).val()},
                dataType:'json',
                beforeSend: function(){

                },
                success: function(response){
                    console.log(response);
                    var men = response.mensaje;
                    var usu = response.usuario;
                    if(men=='correcto'){
                        $("#email_usuario_editar").val(usu.email);
                        $("#apellidos_usuario_editar").val(usu.nombres_apellidos);
                        $("#proyecto_usuario_editar").val(usu.nombre_proyecto);
                        $("#btnEditarUsuario").removeClass('disabled');
                    }
                    else{
                        $("#email_usuario_editar").val("");
                        $("#apellidos_usuario_editar").val("");
                        $("#proyecto_usuario_editar").val("");
                        $("#btnEditarUsuario").removeClass('disabled').addClass('disabled');
                    }
                },
                error:function(erro){

                }
            });
        }

    });
});
</script>