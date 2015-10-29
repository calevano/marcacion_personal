<?php
$nombre_sede    = $this->session->userdata('userNameUsuario');
?>
<div class="text-center nombre_sede_actual">REGISTRO DE VISITAS<br>"<?php echo nombre_sede($nombre_sede); ?>"</div>
<div class="text-center timeRegister" id="time"></div>
<div class="lc-block lcb-alt toggled lc-block-visita " id="l-lockscreen">

    <div>
        <img class="lcb-user verifica_foto " src="<?php echo base_url('assets/img/profile-pics/imagen-no-disponible.jpg');?>" alt=""  />
        <div class="fg-line">
            <input type="text" class="form-control text-center solo_numeros" placeholder="INGRESE DNI" id="send_dni" autofocus >
        </div>
    </div>
    <div class="row mensaje_usuario"></div>
</div>
<script type="text/javascript">
    $(function(){
        startTime();
    });
</script>
