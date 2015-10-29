//--------------------EXPORTAR------------
$(".exportar_tabla_reporte").on('click',function(event) {
   var cant_registro = $('#tablaListado_length select')
   cant_registro.val(-1);
   cant_registro.trigger('change');

   var tabla_limpia= $("#tablaListado").clone();

   tabla_limpia.find('tfoot').remove();

   tabla_limpia.find('thead tr th').css({
        'border':'1px solid #09486D ',
        'color': '#fff',
        'font-size': '15px',
        'background' : '#3498db ',
        'width': '100%',
        'height':'auto'
   });

   //tabla_limpia.find('tbody tr td').css('border','1px solid #3498db');
   tabla_limpia.find('tbody tr td').css("mso-number-format", "'\@'");
   //tabla_limpia.find('tbody tr td').css("mso-number-format", "'\@'");
   $("#datos_a_enviar").val($("<div>").append(tabla_limpia).html());
   $("#form_exportar_tabla").submit();

   cant_registro.val(10);
   cant_registro.trigger('change');
});

//---------------------FIN EXPORTAR

//------------------listado de funciones------------------------
function validarNumero(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla === 8)
        return true;
    if (tecla === 48)
        return true;
    if (tecla === 49)
        return true;
    if (tecla === 50)
        return true;
    if (tecla === 51)
        return true;
    if (tecla === 52)
        return true;
    if (tecla === 53)
        return true;
    if (tecla === 54)
        return true;
    if (tecla === 55)
        return true;
    if (tecla === 56)
        return true;
    if (tecla === 57)
        return true;
    patron = /1/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

$(".solonumeros").keypress(function (e) {
    return validarNumero(e);
});

//PASANDO PARAMETRO AL DATE-PICKER
if ($('.date-picker-span')[0]) {
    $('.date-picker-span').datetimepicker({
        format: 'DD-MM-YYYY',
        maxDate: moment().format()
    });
}

function tablaListadoDataTable(idTabla) {
    idTabla=idTabla || "#tablaListado";
    $(idTabla).dataTable({
        "oLanguage": {
            "sSearch": "<i class='zmdi zmdi-search mdc-text-cyan-700'></i> Buscar: ",
            "oPaginate": {
                "sFirst": "<i class='zmdi zmdi-more'></i>",
                "sLast": "<i class='zmdi zmdi-more'></i>",
                "sNext": "<i class='zmdi zmdi-chevron-right'></i>",
                "sPrevious": "<i class='zmdi zmdi-chevron-left'></i>"
            },
            "sInfoEmpty": "0 registros que mostrar",
            "sInfoFiltered": " ",
            "sZeroRecords": "<div class='text-center'><i class='zmdi zmdi-mood-bad zmdi-hc-5x'></i><h3>No hay registro que mostrar</h3></div>",
            "sLoadingRecords": "Por favor espere - cargando...",
            "sLengthMenu": 'Mostrando <select class="form-control input-sm">' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
            "sInfo": "Mostrando _START_ de _END_ registros, total _TOTAL_ registros"
        }
    });
    var table = $(idTabla).DataTable();
    $(idTabla+" tfoot th").each(function () {
        var title = $(idTabla+" thead tr.th-head-inputs th").eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="' + title + '" />');
    });
    table.columns().eq(0).each(function (colIdx) {
        $('input', table.column(colIdx).footer()).on('keyup change', function () {
            table.column(colIdx).search(this.value).draw();
        });
    });
}

$(document).on('click','#cancelarEventoModal',function(){
    limpiar_formulario();
});

function notify(from, align, icon, type, mensaje){
    $.growl({
        icon: icon,
        title: ' Atención... ',
        message: mensaje,
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
        timer: 6000,
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
}

function swal_accion_resultado(titutlo,mensaje,tipo,ruta_lista){
    swal({
        title: titutlo,
        text: mensaje,
        type: tipo,
        //timer: 5000,
        showConfirmButton: true,
        html: true
    });
    if(ruta_lista!=null){
        traer_listado_tabla(ruta_lista);
    }
}

function traer_listado_tabla(ruta){
    var url = CI.base_url + ruta;
    $('#resultado_filtro').slideUp('high', function () {
        $('#resultado_filtro').load(url, function () {
            tablaListadoDataTable();
            toogle();
            $('#resultado_filtro').slideDown('slow');
        });
    });
}

function toogle(){
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
}

function limpiar_formulario(){
    $("form.verificando_form")[0].reset();
    $('.fg-line').removeClass('fg-toggled');
    $('.fg-line').find('label.myErrorClass').remove();
    $('.selectpicker').selectpicker('refresh');
    $("#email_personal_dashboard").trigger("chosen:updated");
}

function open_modal_ajax(id_modal){
    event.preventDefault();
    var target = $("a[data-target=#"+id_modal+"]").attr("href");
    $("#"+id_modal+" .modal-content").load(target, function() {
        $("#"+id_modal).modal("show");
    });
}

function traer_resultado_tabla(url,btn){
    $("#resultado_filtro").slideUp('high', function () {
        $(this).load(url, function () {
            tablaListadoDataTable();
            $(this).slideDown('slow');
            $("#"+btn).removeClass('disabled');
        });
    });
}

//------------------Fin listado de funciones------------------------

//--------------------OPCIONES DE ASISTENCIA------------------------
$("#fecha_total").on("dp.change", function(e) {
    $(".today").text(moment("'"+$(this).val()+"'","DDMMYYYY").format('dddd, DD [de] MMMM [del] YYYY'));
});
$("#fecha_de").on("dp.change", function(e) {
    $(".today_from").text(moment("'"+$(this).val()+"'","DDMMYYYY").format('dddd, DD [de] MMMM [del] YYYY'));
});
$("#fecha_hasta").on("dp.change", function(e) {
    $(".today_to").text(moment("'"+$(this).val()+"'","DDMMYYYY").format('dddd, DD [de] MMMM [del] YYYY'));
});

$("#btnFiltrarListado").on('click',function(){
    var areas   = $("#listado_area").val();
    var fecha   = $("#fecha_total").val();
    var sedes   = $("#listado_sedes").val();
    var url     = CI.base_url+'asistencia/listado/filtro?sedes='+sedes+'&areas='+areas+'&fecha='+fecha;
    //console.log(url);
    traer_resultado_tabla(url,'btnFiltrarListado');
});

$("#btnFiltrarListadoRango").on('click',function(){
    var areas       = $("#listado_area").val();
    var fecha_de    = $("#fecha_de").val();
    var fecha_hasta = $("#fecha_hasta").val();
    var sedes       = $("#listado_sedes").val();
    var url         = CI.base_url+'asistencia/por-rango/rango?sedes='+sedes+'&areas='+areas+'&fecha_de='+fecha_de+'&fecha_hasta='+fecha_hasta;
    //console.log(url);
    traer_resultado_tabla(url,'btnFiltrarListadoRango');
});

$("#btnFiltrarDniPersona").on('click',function(){
    var dni         = $("#dni_persona").val();
    var fecha_de    = $("#fecha_de").val();
    var fecha_hasta = $("#fecha_hasta").val();

    if(dni===""){
        swal_accion_resultado('Mensaje...','<p class="f-s-20">Estimado usuario por favor<br><span class="mdc-text-red-A400">INGRESE DNI</span><br>de la persona a buscar</p>','warning');
        return false;
    }else{
        var url         = CI.base_url+'asistencia/listado-persona/filtro?dni='+dni+'&fecha_de='+fecha_de+'&fecha_hasta='+fecha_hasta;
        traer_resultado_tabla(url,'btnFiltrarDniPersona');
    }

});

//--------------------FIN OPCIONES DE ASISTENCIA--------------------

//------------------USUARIOS-----------------------------------------
$(document).on('click','a[data-target=#editarUsuarioModal]',function(event){
    event.preventDefault();
    var target = $(this).attr("href");
    $("#editarUsuarioModal .modal-content").load(target, function() {
        $("#editarUsuarioModal").modal("show");
    });
});

$(document).on('click',"#btnEditarUsuario",function(){
    $("#form_editar_usuario").validate({
        errorClass: 'myErrorClass',
        rules: {
            name_usuario_editar: {
                required: true,
                minlength: 8,
                remote: {
                    url: CI.base_url + "usuario/verificar",
                    type: "POST",
                    data: {
                        user_crear: function () {
                            if($("input[name=name_usuario_editar]").val()!==$("input[name=name_usuario_editar_hidden]").val()){
                                return $("input[name=name_usuario_editar]").val();
                            }
                        }
                    }
                }
            }
        },
        messages: {
            name_usuario_editar: {
                required: "INGRESE NOMBRE USUARIO",
                minlength: "NOMBRE USUARIO MINIMO 8 CARACTERES",
                remote: jQuery.validator.format("ESTE USUARIO YA EXISTE.")
            }
        },
        submitHandler: function (form) {
            $("#btnEditarUsuario").addClass('disabled');
            $.ajax({
                url: CI.base_url+'usuario/editar',
                type: 'POST',
                data: $("#form_editar_usuario").serializeArray(),
                dataType: 'json',
                beforeSend: function(){
                    swal_accion_resultado('Mensaje...','Editando usuario','warning');
                },
                success: function(response){
                    swal_accion_resultado('Mensaje...',response.mensaje,response.tipo,'usuario/listado');
                    $('#editarUsuarioModal').modal('hide');
                },
                error:function(err){
                    console.log(err);
                }
            });
        }

    });
});

$(document).on('click','.cambiar_estado_usuario',function(){
    var nombre_usuario      = $(this).data('usuario-nombre');
    var estado_usuario      = $(this).data('usuario-estado');
    var nombre_apellido     = $(this).data('usuario-nombre-apellido');
    var id_usuario          = $(this).data('usuario-id');
    var data_cambio_estado  = {
        id_user: id_usuario,
        estado: estado_usuario
    };
    swal({
      title: "Mensaje de Acción",
      text: "Está seguro de cambiar el ESTADO en el sistema y en la WebApp, al usuario  \""+nombre_usuario+" - "+nombre_apellido+"\" ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Cambiar",
      cancelButtonText: "Cancelar",
      closeOnConfirm: false
    }, function(){
        $.ajax({
            url: CI.base_url+'usuario/estado',
            type: 'GET',
            data: data_cambio_estado,
            dataType: 'json',
            beforeSend: function(){

            },
            success: function(response){
                //console.log(response);
                if(response.estado==1){
                    swal_accion_resultado('Cambio de Acceso...!','Se reestablecio el ESTADO en el sistema y también en la WebApp, al usuario \"'+nombre_usuario+' - '+nombre_apellido+'\" ','success','usuario/listado');
                }else{
                    swal_accion_resultado('Cambio de Acceso...!','El usuario \"'+nombre_usuario+' - '+nombre_apellido+'\" ya no podrá acceder al sistema, tampoco podra acceder a la WebApp','error','usuario/listado');
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});

//-------------------CARGO-------------------
$(document).on('click','a[data-target=#agregarCargoModal]',function(event){
    //open_modal_ajax('agregarCargoModal');
    event.preventDefault();
    var target = $(this).attr("href");
    $("#agregarCargoModal .modal-content").load(target, function() {
        $("#agregarCargoModal").modal("show");
    });
});
$(document).on('click','a[data-target=#editarCargoModal]',function(event){
    //open_modal_ajax('editarCargoModal');
    event.preventDefault();
    var target = $(this).attr("href");
    $("#editarCargoModal .modal-content").load(target, function() {
        $("#editarCargoModal").modal("show");
    });
});

$(document).on('click',"#btnEditarCargo",function(){

    $("#btnEditarCargo").addClass('disabled');
    $.ajax({
        url     : CI.base_url+'herramientas/editar',
        type    : 'POST',
        data    : $("#form_editar_cargo").serializeArray(),
        dataType: 'json',
        beforeSend: function(){
            swal_accion_resultado('Mensaje...','EDITANDO CARGO','warning');
        },
        success: function(response){
            $('#editarCargoModal').modal('hide');
            swal_accion_resultado('Mensaje...',response.mensaje,response.tipo,'herramientas/listado');
            $("#btnEditarCargo").removeClass('disabled');
            limpiar_formulario();
        },
        error:function(err){
            console.log(err);
        }
    });


});

$(document).on('click',"#btnCreateCargo",function(){
    $("#btnCreateCargo").addClass('disabled');
    $.ajax({
        url: CI.base_url+'herramientas/crear',
        type: 'POST',
        data: $("#form_crear_cargo").serializeArray(),
        dataType: 'json',
        beforeSend: function(){
            swal_accion_resultado('Mensaje...','CREANDO CARGO','warning');
        },
        success: function(response){
            $('#agregarCargoModal').modal('hide');
            swal_accion_resultado('Mensaje...',response.mensaje,response.tipo,'herramientas/listado');
            $("#btnCreateCargo").removeClass('disabled');
            limpiar_formulario();
        },
        error:function(err){
            console.log(err);
        }
    });
});

//------------------------------PERSONA------------------------
$(document).on('click','a[data-target=#agregarPersonaModal]',function(event){
    //open_modal_ajax('agregarPersonaModal');
    event.preventDefault();
    var target = $(this).attr("href");
    $("#agregarPersonaModal .modal-content").load(target, function() {
        $("#agregarPersonaModal").modal("show");
    });
});

$(document).on('click','a[data-target=#editarPersonaModal]',function(event){
    //open_modal_ajax('editarPersonaModal');
    event.preventDefault();
    var target = $(this).attr("href");
    $("#editarPersonaModal .modal-content").load(target, function() {
        $("#editarPersonaModal").modal("show");
    });
});

$(document).on('click','.cambiar_estado_persona',function(){
    var dni_persona         = $(this).data('persona-dni');
    var estado_persona      = $(this).data('persona-estado');
    var nombre_apellido     = $(this).data('persona-nombre-apellido');
    var id_persona          = $(this).data('persona-id');
    var data_cambio_estado  = {
        id_persona: id_persona,
        estado: estado_persona
    };
    swal({
        title: "CAMBIAR ESTADO...",
        text: "Está seguro de cambiar el <span style='color:#DD6B55'>ESTADO</span> del personal<br><span style='color:#000'>\""+dni_persona+" - "+nombre_apellido+"\"</span> ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Cambiar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        html: true
    }, function(){
        $.ajax({
            url: CI.base_url+'personal/estado',
            type: 'GET',
            data: data_cambio_estado,
            dataType: 'json',
            beforeSend: function(){

            },
            success: function(response){
                if(response.estado==1){
                    swal_accion_resultado('CAMBIAR ESTADO...!','Se reestablecio el <span style=\'color:#DD6B55\'>ESTADO</span> en el sistema y también en la WebApp, al persona \"'+dni_persona+' - '+nombre_apellido+'\" ','success','personal/listado');
                }else{
                    swal_accion_resultado('CAMBIAR ESTADO...!','El personal \"'+dni_persona+' - '+nombre_apellido+'\" ya no podrá acceder al sistema, tampoco podra acceder a la WebApp','error','personal/listado');
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});

$(document).on('click','#btnCreatePersona',function(){
    $("#form_crear_persona").validate({
        errorClass: 'myErrorClass',
        rules: {
            dni_crear: {
                required: true,
                number: true,
                minlength: 8,
                remote: {
                    url: CI.base_url + "personal/verificar",
                    type: "POST",
                    data: {
                        dni_crear: function () {
                            return $("input[name=dni_crear]").val();
                        }
                    }
                }
            },
            apellidos_crear:"required",
            email_crear:{
                required:true,
                email:true,
                remote: {
                    url: CI.base_url + "personal/verificar",
                    type: "POST",
                    data: {
                        email_crear: function () {
                            return $("input[name=email_crear]").val();
                        }
                    }
                }
            }
        },
        messages: {
            dni_crear: {
                required: "INGRESE DNI",
                number: "SOLO NÚMEROS",
                minlength: "DNI 8 CARACTERES",
                remote: jQuery.validator.format("D.N.I YA EXISTE")
            },
            apellidos_crear: "INGRESE NOMBRES",
            email_crear:{
                required: "INGRESE E-MAIL",
                email: "INGRESE E-MAIL VALIDO",
                remote: jQuery.validator.format("E-MAIL YA EXISTE")
            }
        },
        submitHandler: function (form) {
            $("#btnCreatePersona").addClass('disabled');
            $.ajax({
                url: CI.base_url+'personal/crear',
                type: 'POST',
                data: $("#form_crear_persona").serializeArray(),
                dataType: 'json',
                beforeSend: function(){
                    swal_accion_resultado('Mensaje...','CREANDO PERSONAL','warning');
                },
                success: function(response){
                    $('#agregarPersonaModal').modal('hide');
                    swal_accion_resultado('Mensaje...',response.mensaje,response.tipo,'personal/listado');
                    $("#btnCreatePersona").removeClass('disabled');
                    limpiar_formulario();
                },
                error:function(err){
                    console.log(err);
                }
            });
        }
    });

});

$(document).on('click','#btnEditarPersona',function(){
    $("#form_editar_persona").validate({
        errorClass: 'myErrorClass',
        rules: {
            dni_editar: {
                required: true,
                number: true,
                minlength: 8,
                remote: {
                    url: CI.base_url + "personal/verificar",
                    type: "POST",
                    data: {
                        dni_crear: function () {
                            return $("input[name=dni_editar]").val();
                            if($("input[name=dni_editar]").val()!==$("input[name=dni_editar_hidden]").val()){
                                return ($("input[name=dni_editar]").val());
                            }
                        }
                    }
                }
            },
            apellidos_editar:"required",
            email_editar:{
                required:true,
                email:true,
                remote: {
                    url: CI.base_url + "personal/verificar",
                    type: "POST",
                    data: {
                        email_crear: function () {
                            if($("input[name=email_editar]").val()!==$("input[name=email_editar_hidden]").val()){
                                return ($("input[name=email_editar]").val());
                            }
                        }
                    }
                }
            }
        },
        messages: {
            dni_editar: {
                required: "INGRESE DNI",
                number: "SOLO NÚMEROS",
                minlength: "DNI 8 CARACTERES",
                remote: jQuery.validator.format("D.N.I YA EXISTE")
            },
            apellidos_editar: "INGRESE NOMBRES",
            email_editar:{
                required: "INGRESE E-MAIL",
                email: "INGRESE E-MAIL VALIDO",
                remote: jQuery.validator.format("E-MAIL YA EXISTE")
            }
        },
        submitHandler: function (form) {
            $("#btnEditarPersona").addClass('disabled');
            $.ajax({
                url: CI.base_url+'personal/editar',
                type: 'POST',
                data: $("#form_editar_persona").serializeArray(),
                dataType: 'json',
                beforeSend: function(){
                    swal_accion_resultado('Mensaje...','EDITANDO PERSONAL','warning');
                },
                success: function(response){
                    $('#editarPersonaModal').modal('hide');
                    $("#btnEditarPersona").removeClass('disabled');
                    limpiar_formulario();
                    swal_accion_resultado('Mensaje...',response.mensaje,response.tipo,'personal/listado');

                },
                error:function(err){
                    console.log(err);
                }
            });
        }
    });

});

$(document).on('click',"#btnEnviarCargos",function(e){
    e.preventDefault();
    var formData = new FormData($("#form_upload_herramienta")[0]);
    $.ajax({
        url: CI.base_url+'herramientas/upload',
        type: 'POST',
        dataType: 'json',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            swal_accion_resultado('CARGANDO...','VERIFICANDO Y CARGANDO LOS CARGOS','warning');
        },
        success: function(response){
            var tipo    = response.tipo;
            var men     = response.mensaje;
            if(tipo ==='warning'){
                swal_accion_resultado('MENSAJE...',men,tipo);
            }else{
                swal_accion_resultado('MENSAJE...',JSON.stringify(response.mensaje),response.tipo);
            }

        },
        error:function(err){
            console.log(err);
        }
    });
});

//------------------------------ENVIAR MENSAJE------------------------
$(document).on('click','#btnEnvioMensaje',function(){
    $("#form_envio_dashboard").validate({
        errorClass: 'myErrorClass',
        rules: {
            "email_personal_dashboard[]":"required",
            asunto_dashboard:"required",
            mensaje_dashboard:"required"
        },
        messages: {
            "email_personal_dashboard[]":"escoger persona",
            asunto_dashboard: "Ingrese asunto",
            mensaje_dashboard:"Ingrese mensaje"
        },
        submitHandler: function (form) {
            $("#btnEnvioMensaje").addClass('disabled');
            $.ajax({
                url: CI.base_url+'dashboard/envio',
                type: 'POST',
                data: $("#form_envio_dashboard").serializeArray(),
                dataType: 'json',
                beforeSend: function(){
                    swal_accion_resultado('Mensaje...','ENVIANDO MENSAJE','warning');
                },
                success: function(response){
                    $("#btnEnvioMensaje").removeClass('disabled');
                    limpiar_formulario();
                    swal_accion_resultado('Mensaje...',response.mensaje,response.tipo);
                },
                error:function(err){
                    console.log(err);
                }
            });
        }
    });

});

//-----------------------MOSTRAR MODAL VISITA-------------------
$(document).on('click','a[data-target=#visitasModal]',function(event){
    event.preventDefault();
    var target = $(this).attr("href");
    $("#visitasModal .modal-content").load(target, function() {
        $("#visitasModal").modal("show");
    });
});
