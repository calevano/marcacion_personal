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

$(".solo_numeros").keypress(function (e) {
    return validarNumero(e);
});

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();

    // Añadiendo cero si el numero es menor a 10
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);

    //Observar si es PM o AM
    //var day_or_night = (h > 11) ? "PM" : "AM";
    var day_or_night = "";

    //convertir 12 horas al sistema.
    // if (h > 12)
    //     h -= 12;

    //Añadiendo tiempo para mostrarlo y actualizar cada 500 milisegundos
    $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
    setTimeout(function () {
        startTime();
    }, 500);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}


function limpiar_() {
    $(".login-content").removeClass('color-persona-success-body color-persona-warning-body color-persona-error-body');
    $("#l-lockscreen").removeClass('color-persona-success-lockscreen color-persona-warning-lockscreen color-persona-error-lockscreen')
    $(".mensaje_usuario").empty();
}

var esconde_alerta;
function esconder() {
    esconde_alerta = setTimeout(function () {
        limpiar_();
        $('.verifica_foto').prop('src', CI.base_url + 'assets/img/profile-pics/imagen-no-disponible.jpg');
    }, 7000);
}

$("#send_dni").on("keyup", function () {
    var dni = $(this).val();
    if (dni.length === 8) {
        $.ajax({
            url: CI.base_url + "visita/registrar",
            type: 'POST',
            data: {send_dni: dni},
            dataType: 'json',
            beforeSend: function () {
                clearTimeout(esconde_alerta);
                $("#send_dni").val("");
                $('.verifica_foto').prop('src', CI.base_url + 'assets/img/profile-pics/imagen-no-disponible.jpg');
                limpiar_();
                $(".mensaje_usuario").html('<div class="text-center"><span class="zmdi zmdi-rotate-right zmdi-hc-spin zmdi-hc-3x"></span></div>');
            },
            success: function (response) {
                $("#send_dni").val("");
                if(!response.error_mensaje){
                    var res     = response.mostrar_mensaje;
                    var tipo    = response.tipo;
                    var tipo_   = "";
                    if(tipo ==='warning'){
                        tipo_ = res.hora_salida;
                    }else{
                        tipo_ = res.hora_ingreso;
                    }

                    $(".login-content").addClass('color-persona-'+tipo+'-body');
                    $("#l-lockscreen").addClass('color-persona-'+tipo+'-lockscreen');
                    $('.verifica_foto').prop('src', 'http://iinei.inei.gob.pe/iinei/asistencia/fotos/'+res.dni+'.jpg');
                    $('.verifica_foto').error(function () {
                        $(this).prop('src', CI.base_url + 'assets/img/profile-pics/imagen-no-disponible.jpg');
                    });
                    $(".mensaje_usuario").html(
                        '<div class="col-sm-12">'+
                            '<label for="" class="col-xs-12 text-center f-s-35">'+res.nombres_apellidos+'</label>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<label for="" class="col-xs-12 text-center f-s-30">'+res.dni+'</label>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<div class="form-group fg-line">'+
                                '<label class="col-xs-3 show_puntos_" for="">PROYECTO</label>'+
                                '<label for="" class="col-xs-9">'+res.nombre_corto_proyecto+'</label>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<div class="form-group fg-line">'+
                                '<label class="col-xs-3 show_puntos_" for="">SEDE</label>'+
                                '<label for="" class="col-xs-9">'+res.nombre_sede+'</label>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<div class="form-group fg-line">'+
                                '<label class="col-xs-3 show_puntos_" for="">AREA</label>'+
                                '<label for="" class="col-xs-9">'+res.nombre_area+'</label>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<div class="form-group fg-line">'+
                                '<label class="col-xs-3 show_puntos_" for="">CARGO</label>'+
                                '<label for="" class="col-xs-9">'+res.nombre_cargo+'</label>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<div class="form-group fg-line">'+
                                '<label class="col-xs-3 show_puntos_" for="">HORA</label>'+
                                '<label for="" class="col-xs-9">'+tipo_+'</label>'+
                            '</div>'+
                        '</div>');
                    esconder();
                }else{
                    $(".login-content").addClass('color-persona-error-body');
                    $("#l-lockscreen").addClass('color-persona-error-lockscreen');
                    $('.verifica_foto').prop('src', CI.base_url + 'assets/img/profile-pics/imagen-no-disponible.jpg');
                    $(".mensaje_usuario").html(
                            '<div class="col-sm-12">'+
                                '<label for="" class="col-xs-12 text-center f-s-40">'+response.error_mensaje+' - '+dni+'</label>'+
                            '</div>');
                    esconder();
                }
//                 $("#send_dni").val("");
//                 if (data === 3) {
//                     $(".mensaje_usuario").html('<div class="callout callout-danger bg-red animated shake">' +
//                             '<h4 class="text-center color-white-messages">DNI "<strong>' + dni + '</strong>" NO EXISTE...</h4>' +
//                             '</div>');
//                 } else {
//                     if (data.asistencia_recien === "si") {
//                         //console.log(data);
//                         $(".mensaje_usuario").html('<div class="callout callout-success alert-success-datos color-white-messages padding-15">' +
//                                 '<h4 class="text-center color-white-messages font-size-28">INGRESO AL LOCAL CORRECTAMENTE</h4>' +
//                                 '<div class="row">' +
//                                     '<div class="col-xs-12 sinpadding">' +
//                                         '<div class="col-xs-3 padding-top-20">' +
//                                             '<div class="img_personal ">' +
//                                                 '<img src="http://iinei.inei.gob.pe/iinei/asistencia/fotos/' + data.dni + '.jpg" class="img-circle verficaFoto" id="" />' +
//                                             '</div>' +
//                                         '</div>' +
//                                         '<div class="col-xs-9 sinpadding font-size-17">' +
//                                             '<p><strong>DNI: </strong>' + data.dni + '</p>' +
//                                             '<p><strong>AREA: </strong>' + data.area + '</p>' +
//                                             '<p><strong>CARGO: </strong>' + data.cargo + '</p>' +
//                                             '<p><strong>NOMBRES: </strong>' + data.nombre_completo + '</p>' +
//                                             '<p><strong>FECHA: </strong>' + data.fecha + ' <strong>HORA: </strong><span class="font-size-25">' + data.hora_ingreso +'</span></p>' +
//                                         '</div>' +
//
//                                     '</div>' +
//                                 '</div>' +
//                             '</div>');
//                         $('.verficaFoto').error(function () {
// //                            $(this).remove();
//                             $(this).prop('src', CI.base_url + 'assets/img/no-disponible.jpg');
//                         });
//                         // esconder();
//                     } else {
//                         //console.log(data);
//                         $(".mensaje_usuario").html('<div class="callout callout-danger bg-red animated shake padding-15">' +
//                                 '<h4 class="text-center color-white-messages font-size-28">SALIDA DEL LOCAL CORRECTAMENTE</h4>' +
//                                 '<div class="row">' +
//                                     '<div class="col-xs-12 sinpadding">' +
//                                         '<div class="col-xs-3 padding-top-20">' +
//                                             '<div class="img_personal ">' +
//                                                 '<img src="http://iinei.inei.gob.pe/iinei/asistencia/fotos/' + data.dni + '.jpg" class="img-circle verficaFoto" id=""  />' +
//                                             '</div>' +
//                                         '</div>' +
//                                         '<div class="col-xs-9 sinpadding font-size-17">' +
//                                             '<p><strong>DNI: </strong>' + data.dni + '</p>' +
//                                             '<p><strong>AREA: </strong>' + data.area + '</p>' +
//                                             '<p><strong>CARGO: </strong>' + data.cargo + '</p>' +
//                                             '<p><strong>NOMBRES: </strong>' + data.nombre_completo + '</p>' +
//                                             '<p><strong>FECHA: </strong>' + data.fecha + ' <strong>HORA: </strong><span class="font-size-25">' + data.hora_salida + '</span></p>' +
//                                         '</div>' +
//                                     '</div>' +
//                                 '</div>' +
//                             '</div>');
//                         $('.verficaFoto').error(function () {
//                             $(this).prop('src', CI.base_url + 'assets/img/no-disponible.jpg');
//                         });
//                         // esconder();
//                     }
//                 }
            }
        });
    }
});
