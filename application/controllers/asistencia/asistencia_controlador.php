<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Asistencia_controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('asistencia/asistencia_model', 'modeloAsistencia');
        $this->load->model('personal/personal_model', 'modeloPersonal');
        $this->id_rol   = $this->session->userdata('userIdRol');
        if ($this->id_rol ==6) {
            redirect('visita', "refresh");
        }
    }

    public function index() {
        $data['titulo']         = "CONTROL DE VISITAS";
        $data['contenido']      = "asistencia/index_asistencia_vista";
        $this->load->view('plantilla', $data);
    }

    public function listado(){
        add_css(array('sweetalert/sweetalert-override.min',
            'datatables/dataTables.bootstrap',
            'bootstrap-select/bootstrap-select.min',
            'datetimepicker/build/css/bootstrap-datetimepicker.min'));
        add_js(array('plugins/sweetalert/sweetalert.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/bootstrap-select/bootstrap-select.min',
            'plugins/bootstrap-select/i18n/defaults-es_CL.min',
            'plugins/datatables/jquery.dataTables.min',
            'plugins/datatables/dataTables.bootstrap.min',
            'plugins/moment/min/moment.min',
            'plugins/moment/locale/es',

            'plugins/datetimepicker/build/js/bootstrap-datetimepicker.min'));
        $data['listado_sedes']  = $this->modeloPersonal->obtener_sedes();
        $data['listado_areas']  = $this->modeloPersonal->obtener_areas();
        $data['listado_visita'] = $this->modeloAsistencia->obtener_listado_visita();
        $data['titulo']         = "LISTADO DE VISITAS";
        $data['contenido']      = "asistencia/listado_asistencia_vista";
        $this->load->view('plantilla', $data);
    }

    public function listado_filtro(){
        if ($this->input->is_ajax_request()) {
            $data['listado_visita'] = $this->modeloAsistencia->obtener_listado_visita($_REQUEST);
            $this->load->view('asistencia/listado_asistencia_vista_ajax', $data);
        }
    }

    public function visita(){
        if($this->input->is_ajax_request()){
            $dni                = $this->input->get('dni');
            $fecha              = $this->input->get('fecha');
            $data['visitas']    = $this->modeloAsistencia->obtener_cantidad_visita($dni,$fecha);
            $this->load->view('asistencia/visita_listado_asistencia_vista',$data);
        }
    }

    public function por_rango(){
        add_css(array('sweetalert/sweetalert-override.min',
            'datatables/dataTables.bootstrap',
            'bootstrap-select/bootstrap-select.min',
            'datetimepicker/build/css/bootstrap-datetimepicker.min'));
        add_js(array('plugins/sweetalert/sweetalert.min',
            'plugins/bootstrap-select/bootstrap-select.min',
            'plugins/bootstrap-select/i18n/defaults-es_CL.min',
            'plugins/datatables/jquery.dataTables.min',
            'plugins/datatables/dataTables.bootstrap.min',
            'plugins/moment/min/moment.min',
            'plugins/moment/locale/es',
            'plugins/datetimepicker/build/js/bootstrap-datetimepicker.min'));
        $data['listado_sedes']  = $this->modeloPersonal->obtener_sedes();
        $data['listado_areas']  = $this->modeloPersonal->obtener_areas();
        $data['listado_visita'] = $this->modeloAsistencia->obtener_listado_rango_visita();
        $data['titulo']         = "ASISTENCIA POR RANGO";
        $data['contenido']      = "asistencia/rango_asistencia_vista";
        $this->load->view('plantilla', $data);
    }

    public function listado_rango(){
        if ($this->input->is_ajax_request()) {
            $data['listado_visita'] = $this->modeloAsistencia->obtener_listado_rango_visita($_REQUEST);
            $this->load->view('asistencia/rango_asistencia_vista_ajax', $data);
        }
    }

    public function persona(){
        add_css(array('sweetalert/sweetalert-override.min',
            'datatables/dataTables.bootstrap',
            'bootstrap-select/bootstrap-select.min',
            'datetimepicker/build/css/bootstrap-datetimepicker.min'));
        add_js(array('plugins/sweetalert/sweetalert.min',
            'plugins/bootstrap-select/bootstrap-select.min',
            'plugins/bootstrap-select/i18n/defaults-es_CL.min',
            'plugins/datatables/jquery.dataTables.min',
            'plugins/datatables/dataTables.bootstrap.min',
            'plugins/moment/min/moment.min',
            'plugins/moment/locale/es',
            'plugins/datetimepicker/build/js/bootstrap-datetimepicker.min'));
        // $data['listado_sedes']  = $this->modeloPersonal->obtener_sedes();
        // $data['listado_areas']  = $this->modeloPersonal->obtener_areas();
//        $data['listado_persona'] = $this->modeloAsistencia->obtener_listado_persona_visita();
        $data['titulo']         = "ASISTENCIA POR PERSONA";
        $data['contenido']      = "asistencia/persona_asistencia_vista";
        $this->load->view('plantilla', $data);
    }

    public function listado_persona(){
        if ($this->input->is_ajax_request()) {
            $data['listado_persona'] = $this->modeloAsistencia->obtener_listado_persona_visita($_REQUEST);
            $this->load->view('asistencia/persona_asistencia_vista_ajax', $data);
        }
    }

}

   /* End of file Usuario_controlador.php */
   /* Location: ./application/controllers/Usuario_controlador.php */