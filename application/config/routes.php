<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']             = "dashboard_controlador";
$route['404_override']                   = "error_404";
$route['translate_uri_dashes']           = FALSE;

$route['login']                          = "acceso/acceso/login";
$route['logout']                         = "acceso/acceso/logout";

//-------------PORTADA------------------
$route['dashboard/envio']                = "dashboard_controlador/envio";

//--ASISTENCIA
$route['visita']                         = "visita/visita_controlador";
$route['visita/registrar']               = "visita/visita_controlador/registrar";

//--VISITA
$route['asistencia']                     = "asistencia/asistencia_controlador";
$route['asistencia/listado']             = "asistencia/asistencia_controlador/listado";
$route['asistencia/listado/visita']      = "asistencia/asistencia_controlador/visita";
$route['asistencia/listado/filtro']      = "asistencia/asistencia_controlador/listado_filtro";
$route['asistencia/por-rango']           = "asistencia/asistencia_controlador/por_rango";
$route['asistencia/por-rango/rango']     = "asistencia/asistencia_controlador/listado_rango";
$route['asistencia/listado-persona']             = "asistencia/asistencia_controlador/persona";
$route['asistencia/listado-persona/filtro']      = "asistencia/asistencia_controlador/listado_persona";

//--PERSONAS
$route['personal']                       = "personal/personal_controlador";
$route['personal/crear']                 = "personal/personal_controlador/crear";
$route['personal/editar']                = "personal/personal_controlador/editar";
$route['personal/estado']                = "personal/personal_controlador/estado";
$route['personal/upload']                = "personal/personal_controlador/upload";
$route['personal/verificar']             = "personal/personal_controlador/verificar";
$route['personal/listado']               = "personal/personal_controlador/listado";

//--HERRAMIENTA
$route['herramientas']                    = "herramienta/herramienta_controlador";
$route['herramientas/crear']              = "herramienta/herramienta_controlador/crear";
$route['herramientas/editar']             = "herramienta/herramienta_controlador/editar";
$route['herramientas/verificar']          = "herramienta/herramienta_controlador/verificar";
$route['herramientas/upload']             = "herramienta/herramienta_controlador/upload";
$route['herramientas/listado']            = "herramienta/herramienta_controlador/listado";

//--USUARIOS
$route['usuarios']                       = "usuario/usuario_controlador";
$route['usuario/crear']                  = "usuario/usuario_controlador/crear";
$route['usuario/editar']                 = "usuario/usuario_controlador/editar";
$route['usuario/estado']                 = "usuario/usuario_controlador/estado";
$route['usuario/acceso']                 = "usuario/usuario_controlador/acceso";
$route['usuario/verificar']              = "usuario/usuario_controlador/verificar";
$route['usuario/listado']                = "usuario/usuario_controlador/listado";

//----AJAX
$route['ajax-exportar-tabla']            = "ajax/ajax_controlador/exportar_tabla";
$route['ajax-verificar-usuario']         = "ajax/ajax_controlador/verificar_usuario";
$route['ajax-listar-cargos']             = "ajax/ajax_controlador/listar_cargos";


/* End of file routes.php */
/* Location: ./application/config/routes.php */