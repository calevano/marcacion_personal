<?php
$id_login       = $this->session->userdata('idUserLogin');
$nombre_usuario = $this->session->userdata('userNameUsuario');
$id_rol         = $this->session->userdata('userIdRol');
$nombre_rol     = $this->session->userdata('userNombreRol');
#$array_valores  = array(5,6);
?>
<?php #!in_array($id_rol,$array_valores)) ?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title><?php echo (isset($titulo) and $titulo != "") ? $titulo . " | " : ""; ?>INEI</title>
        <?php echo put_headersCss_() ?>
        <?php echo put_headersCss() ?>
        <link href="<?php echo base_url('assets/css/app.min.1.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/app.min.2.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/global.css') ?>" rel="stylesheet">
        <script type="text/javascript">
        var CI = {
            'base_url' : '<?php echo base_url(); ?>',
            'site_url' : '<?php echo site_url(); ?>'
        };
        </script>
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" ></script>
        <?php echo put_headersJs_() ?>
        <?php if ($this->session->userdata('idUserLogin')) { ?>
        <script type="text/javascript">
            $(document).on('ready', function () {
                var url         = window.location;
                var rutaMain    = $('#sidebar a[href="' + url + '"]');
                rutaMain.parent().addClass('active');
                $('#sidebar a').filter(function () {
                    return this.href === url;
                }).parent().addClass('active');
            });
        </script>
        <?php } ?>
    </head>
    <body class="<?php echo ($this->uri->segment(1)=='login' || $this->uri->segment(1)=='visita' )? 'login-content' : ''?> ">
        <?php if ($id_login && $id_rol!=6) : ?>
        <header id="header">
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">
                    <a href="<?php echo base_url() ?>">MARCACIÓN</a>
                </li>

                <li class="pull-right">
                    <ul class="top-menu">
                        <li id="toggle-width">
                            <div class="toggle-switch">
                                <input id="tw-switch" type="checkbox" hidden="hidden">
                                <label for="tw-switch" class="ts-helper"></label>
                            </div>
                        </li>
                        <li id="top-search1">
                            <a data-action="fullscreen" href="javascript:;" class="text-center"><i class="zmdi zmdi-fullscreen zmdi-hc-2x text-white alinear-i"></i> </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>

        <section id="main">
        <?php endif;
