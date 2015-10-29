<?php
$id_rol         = $this->session->userdata('userIdRol');
$name_usuario   = $this->session->userdata('userNameUsuario');
$nombre_usuario = ($this->session->userdata('userNombres')==NULL)? $name_usuario : $this->session->userdata('userNombres') ;
if (!isset($sidebar)) : ?>
<aside id="sidebar">
    <div class="sidebar-inner c-overflow">
        <div class="profile-menu">
            <a href="javascript:;">
                <div class="profile-pic text-center">
                    <img src="http://iinei.inei.gob.pe/iinei/asistencia/fotos/<?php echo $name_usuario;?>.jpg" class="img-circle " onerror="this.src='<?php echo base_url('assets/img/profile-pics/imagen-no-disponible.jpg');?>'" alt="<?php echo $name_usuario;?>" />
                </div>
                <div class="profile-info">
                    <?php echo $nombre_usuario;?>
                    <i class="zmdi zmdi-caret-down-circle"></i>
                </div>
            </a>
            <ul class="main-menu m-t-40">
                <li>
                    <a href="javascript:;"><i class="zmdi zmdi-lock mdc-text-deep-orange-700"></i> Cambiar Password</a>
                </li>
                <li>
                    <a href="<?php echo base_url('logout') ?>"><i class="zmdi zmdi-power mdc-text-red-700"></i> Cerrar Sesion</a>
                </li>
            </ul>
        </div>

        <ul class="main-menu m-t-40">
            <?php if ($id_rol<4) : ?>
            <li ><a href="<?php echo base_url() ?>"><i class="zmdi zmdi-home mdc-text-brown-700"></i> PORTADA</a></li>
            <?php endif; ?>
            <li ><a href="<?php echo base_url('asistencia') ?>"><i class="zmdi zmdi-assignment mdc-text-deep-purple-700"></i> ASISTENCIA</a></li>
            <?php if ($id_rol<4) : ?>
            <li ><a href="<?php echo base_url('personal') ?>"><i class="zmdi zmdi-face mdc-text-light-blue-700"></i> PERSONAL</a></li>
            <li ><a href="<?php echo base_url('herramientas') ?>"><i class="zmdi zmdi-settings  mdc-text-teal-700"></i> HERRAMIENTAS</a></li>
            <?php endif; ?>
            <?php if ($id_rol<=2) : ?>
            <li ><a href="<?php echo base_url('usuarios') ?>"><i class="zmdi zmdi-accounts mdc-text-green-700"></i> USUARIOS</a></li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<?php endif;