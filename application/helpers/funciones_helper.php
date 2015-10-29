<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('convertir_mes_letras')) {

    function convertir_mes_letras($mes) {
        switch ($mes) {
            case '1':
                $texto = "Enero";
                break;
            case '2':
                $texto = "Febrero";
                break;
            case '3':
                $texto = "Marzo";
                break;
            case '4':
                $texto = "Abril";
                break;
            case '5':
                $texto = "Mayo";
                break;
            case '6':
                $texto = "Junio";
                break;
            case '7':
                $texto = "Julio";
                break;
            case '8':
                $texto = "Agosto";
                break;
            case '9':
                $texto = "Setiembre";
                break;
            case '10':
                $texto = "Octubre";
                break;
            case '11':
                $texto = "Noviembre";
                break;
            case '12':
                $texto = "Diciembre";
                break;
        }
        return $texto;
    }

}

if (!function_exists('verifica_hora')) {

    function verifica_hora($horaInicio) {
        $inicioValores  = explode(":", $horaInicio);
        $inicioMinutos  = $inicioValores[0] * 60 + $inicioValores[1];
        $finValores     = explode(":", '03:59:59');
        $finMinutos     = $finValores[0] * 60 + $finValores[1];
        if ($horaInicio == '00:00:00') {
            $res        = 'no_marco';
        } else if ($inicioMinutos < $finMinutos) {
            $res        = 'paso_hora';
        } else {
            $res        = '';
        }
        return $res;
    }

}

if (!function_exists('verificar_estado')) {

    function verificar_estado($estado) {
        if ($estado == 1) {
            $res = "<i class='zmdi zmdi-check'></i>";
        }else{
            $res = "<i class='zmdi zmdi-close'></i>";
        }
        return $res;
    }

}

if (!function_exists('notildes')) {

    function notildes($nombre) {
        $find           = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'á', 'é', 'í', 'ó', 'ú', 'ñ');
        $repl           = array('A', 'E', 'I', 'O', 'U', 'N', 'a', 'e', 'i', 'o', 'u', 'n');
        $nombreLimpio   = str_replace($find, $repl, $nombre);
        return $nombreLimpio;
    }

}

if (!function_exists('tildesMayuscula')) {

    function tildesMayuscula($nombre) {
        $find           = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $repl           = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ');
        $nombreLimpio   = str_replace($find, $repl, $nombre);
        return $nombreLimpio;
    }

}


if (!function_exists('cerosIzquierda')) {

    function cerosIzquierda($valor, $longitud) {
        $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
        return $res;
    }

}

if (!function_exists('utf8_mayusculas')) {

    function utf8_mayusculas($item) {
        return strtoupper(utf8_decode(trim($item)));
    }
}

if (!function_exists('limpia_datos')) {

    function limpia_datos($params) {
        return array_map('utf8_mayusculas', html_escape($params));
    }
}

if(!function_exists('nombre_sede')){

    function nombre_sede($nombre_sede){
        if(is_null($nombre_sede)){
            $nombre_sede    = "---";
        }else{
            $nombre_sede    = explode("_", $nombre_sede);
            $nombre_sede    = strtoupper($nombre_sede[0]).' '.strtoupper($nombre_sede[1]);
        }


        return $nombre_sede;
    }

}

if(!function_exists('url_amigable')){

    function url_amigable($url) {
      $urlMinuscula     = strtolower($url);
      $buscarLetra      = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
      $reemplazar       = array('a', 'e', 'i', 'o', 'u', 'n');
      $urlNueva         = str_replace($buscarLetra, $reemplazar, $urlMinuscula);
      $buscarCaracteres = array(' ', '&', '\r\n', '\n', '+');
      $urlAceptable     = str_replace($buscarCaracteres, '-', $urlNueva);
      $find             = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
      $repl             = array('', '-', '');
      $urlRetornar      = preg_replace($find, $repl, $urlAceptable);
      return $urlRetornar;
    }
}

if (!function_exists('show')) {

    function show($var, $item = null) {

        if (is_array($var) && $item) {
            echo (isset($var[$item]) ? $var[$item] : '' );
            return;
        }

        echo (isset($var) ? $var : '' );
    }
}

if (!function_exists('convertirFecha')) {

    function convertirFecha($varFecha, $format = null) {
        if (!is_null($format)) {
            return date($format, strtotime($varFecha));
        }
        return date("d-m-Y H:i:s", strtotime($varFecha));
    }

}

//Añade dinamicamente archivos personalizados js en el pie de la pagina
if (!function_exists('add_js')) {

    function add_js($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_js = $ci->config->item('header_js');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js', $header_js);
        } else {
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js', $header_js);
        }
    }

}

//Añade dinamicamente archivos js en el pie de la pagina
if (!function_exists('put_headersJs')) {

    function put_headersJs() {
        $str = '';
        $ci = &get_instance();
        $header_js = $ci->config->item('header_js');

        foreach ($header_js AS $item) {
            $str .= '<script src="' . base_url() . 'assets/js/' . $item . '.js"></script>' . "\n";
        }

        return $str;
    }

}


//añadir js al inicio tamare
if (!function_exists('add_js_')) {

   function add_js_($file = '') {
      $str = '';
      $ci = &get_instance();
      $header_js_ = $ci->config->item('header_js_');

      if (empty($file)) {
         return;
      }

      if (is_array($file)) {
         if (!is_array($file) && count($file) <= 0) {
            return;
         }
         foreach ($file AS $item) {
            $header_js_[] = $item;
         }
         $ci->config->set_item('header_js_', $header_js_);
      } else {
         $str = $file;
         $header_js_[] = $str;
         $ci->config->set_item('header_js_', $header_js_);
      }
   }

}

if (!function_exists('put_headersJs_')) {

    function put_headersJs_() {
        $str = '';
        $ci = &get_instance();
        $header_js = $ci->config->item('header_js_');

        foreach ($header_js AS $item) {
            $str .= '<script src="' . base_url() . 'assets/js/' . $item . '.js"></script>' . "\n";
        }

        return $str;
    }

}

//Añade dinamicamente archivos personalizados css en el header de la pagina
if (!function_exists('add_css_')) {

    function add_css_($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_css_ = $ci->config->item('header_css_');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $header_css_[] = $item;
            }
            $ci->config->set_item('header_css_', $header_css_);
        } else {
            $str = $file;
            $header_css_[] = $str;
            $ci->config->set_item('header_css_', $header_css_);
        }
    }

}

//Añade dinamicamente archivos css en el header de la pagina
if (!function_exists('put_headersCss_')) {

    function put_headersCss_() {
        $str = '';
        $ci = &get_instance();
        $header_css_ = $ci->config->item('header_css_');

        foreach ($header_css_ AS $item) {
            $str .= '<link rel="stylesheet" href="' . base_url() . 'assets/css/' . $item . '.css"  />' . "\n";
        }

        return $str;
    }

}

//Añade dinamicamente archivos personalizados css en el header de la pagina
if (!function_exists('add_css')) {

    function add_css($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css', $header_css);
        } else {
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css', $header_css);
        }
    }

}

//Añade dinamicamente archivos css en el header de la pagina
if (!function_exists('put_headersCss')) {

    function put_headersCss() {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        foreach ($header_css AS $item) {
            $str .= '<link rel="stylesheet" href="' . base_url() . 'assets/css/' . $item . '.css"  />' . "\n";
        }

        return $str;
    }

}

