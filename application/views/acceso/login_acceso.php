<!-- LOGIN -->
<div class="lc-block toggled" id="l-login">
    <form action="<?php echo base_url('login') ?>" method="POST" id="form_login_usuario" autocomplete="off">
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account zmdi-hc-2x"></i></span>
            <div class="fg-line">
                <input type="text" class="form-control text-lowercase" placeholder="Usuario" name="sendUser">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-key zmdi-hc-2x"></i></span>
            <div class="fg-line">
                <input type="password" class="form-control" placeholder="Contraseña" name="sendPass">
            </div>
        </div>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-login btn-danger btn-float" ><i class="zmdi zmdi-arrow-right margin-top-7"></i></button>
    </form>
</div>

<!-- REGISTRAR -->
<!-- <div class="lc-block" id="l-register">
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-account zmdi-hc-2x"></i></span>
        <div class="fg-line">
            <input type="text" class="form-control" placeholder="Usuario">
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-email zmdi-hc-2x"></i></span>
        <div class="fg-line">
            <input type="text" class="form-control" placeholder="Email Address">
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-key zmdi-hc-2x"></i></span>
        <div class="fg-line">
            <input type="password" class="form-control" placeholder="Contraseña">
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="checkbox">
        <label>
            <input type="checkbox" value="">
            <i class="input-helper"></i>
            Acepta la licencia
        </label>
    </div>

    <a href="" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-right margin-top-7"></i></a>

    <ul class="login-navigation">
        <li data-block="#l-login" class="bgm-green">LOGIN</li>
        <li data-block="#l-forget-password" class="bgm-orange">RECUPERAR CONTRASEÑA</li>
    </ul>
</div> -->

<!-- RECUPERAR CONTRASEÑA -->
<!-- <div class="lc-block" id="l-forget-password">
    <p class="text-left">Para poder recuperar tu contraseña, por favor ingresa el correo con el cual te registrarte en está página.</p>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-email zmdi-hc-2x"></i></span>
        <div class="fg-line">
            <input type="email" class="form-control" placeholder="Email Address">
        </div>
    </div>

    <a href="" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-right margin-top-7"></i></a>

    <ul class="login-navigation">
        <li data-block="#l-login" class="bgm-green">LOGIN</li>
        <li data-block="#l-register" class="bgm-red">REGISTRAR</li>
    </ul>
</div> -->
<?php
$usuario_incorrecto = $this->session->flashdata('usuario_incorrecto');
if ($usuario_incorrecto) : ?>
<script type="text/javascript">
    $(function () {
        notify('top','center','mood-bad','danger');
    });
    function notify(from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: ' Atención... ',
            message: '<?php echo $usuario_incorrecto ?>',
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 20,
                y: 85
            },
            spacing: 10,
            z_index: 1031,
            delay: 2500,
            timer: 5000,
            url_target: '_blank',
            mouse_over: false,

            icon_type: 'class',
            template: '<div data-growl="container" class="alert centrar-bloque-growl" role="alert">' +
                            '<button type="button" class="close" data-growl="dismiss">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<span data-growl="icon"><i class="zmdi zmdi-'+icon+'"></i></span>' +
                            '<span data-growl="title"></span>' +
                            '<span data-growl="message"></span>' +
                            '<a href="#" data-growl="url"></a>' +
                        '</div>'
        });
    };
</script>
<?php endif;?>