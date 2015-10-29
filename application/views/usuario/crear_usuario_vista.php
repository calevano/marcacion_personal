<div class="modal-header bgm-blue">
  <h4 class="modal-title text-center text-white"><i class='zmdi zmdi-account-add'></i> AGREGAR USUARIO</h4>
</div>

<div class="modal-body">

  <form class="row padding-top-10 verificando_form" role="form" autocomplete="off" id="form_crear_usuario"  action="<?php echo base_url('usuario/crear') ?>" method="post">

    <div class="col-sm-6">
        <div class="form-group fg-line">
            <label for="perfil_usuario_crear">PERFIL</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-graduation-cap zmdi-hc-2x"></i></span>
                <div class="fg-line select">
                    <select class="form-control" id="perfil_usuario_crear" name="perfil_usuario_crear">
                    <?php foreach ($total_perfil as $perfil) : ?>
                        <option value="<?php echo $perfil['id'] ?>"><?php echo strtoupper($perfil['nombre']) ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group fg-line">
            <label for="name_usuario_crear">USUARIO</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-account-circle zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <input type="text" id="name_usuario_crear" name="name_usuario_crear" class="form-control solonumeros" placeholder="INGRESE USUARIO" maxlength="8">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group fg-line">
            <label for="password_usuario_crear">CONTRASEÑA</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="zmdi zmdi-lock zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <input type="password" id="password_usuario_crear" name="password_usuario_crear" class="form-control" placeholder="INGRESE CONTRASEÑA">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group fg-line">
            <label for="email_usuario_crear">EMAIL</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="zmdi zmdi-email zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <input type="email" id="email_usuario_crear" name="email_usuario_crear" class="form-control" placeholder="EMAIL" readonly="readonly">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group fg-line">
            <label for="apellidos_usuario_crear" class="text-center">APELLIDOS Y NOMBRES</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="zmdi zmdi-account zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <input type="text" id="apellidos_usuario_crear" name="apellidos_usuario_crear" class="form-control text-uppercase" placeholder="APELLIDOS Y NOMBRES" readonly="readonly">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group fg-line">
            <label for="proyecto_usuario_crear" class="text-center">PROYECTO</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="zmdi zmdi-account zmdi-hc-2x"></i></span>
                <div class="fg-line limipiar-error">
                    <input type="text" id="proyecto_usuario_crear" name="proyecto_usuario_crear" class="form-control text-uppercase" placeholder="PROYECTO" readonly="readonly">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 text-center">
        <input name="valorUsuario" type="hidden" value="valorCrearUsuario"/>
        <button type="submit" class="btn btn-success waves-effect disabled" name="crearUsuario" id="btnCreateUsuario">AGREGAR</button>
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cancelarEventoModal">CANCELAR</button>
    </div>

  </form>
</div>
<script>
$(function(){
    autosize($('.auto-size'));
    $(".solonumeros").keypress(function (e) {
        return validarNumero(e);
    });

    $("#name_usuario_crear").on('change',function(){
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
                        $("#email_usuario_crear").val(usu.email);
                        $("#apellidos_usuario_crear").val(usu.nombres_apellidos);
                        $("#proyecto_usuario_crear").val(usu.nombre_proyecto);
                        $("#btnCreateUsuario").removeClass('disabled');
                    }
                    else{
                        $("#email_usuario_crear").val("");
                        $("#apellidos_usuario_crear").val("");
                        $("#proyecto_usuario_crear").val("");
                        $("#btnCreateUsuario").removeClass('disabled').addClass('disabled');
                    }
                },
                error:function(erro){

                }
            });
        }

    });
});
</script>