<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Herramienta_controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('herramienta/herramienta_model', 'modeloHerramienta');
        $this->load->library('csvimport');
        $this->load->library('upload');
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', -1);
        $this->nameUsuario  = $this->session->userdata('userNameUsuario');
        $this->id_rol       = $this->session->userdata('userIdRol');
        if ($this->id_rol == 6) {
            redirect('visita', "refresh");
        }
    }

    public function index() {
        add_css(array('sweetalert/sweetalert-override.min',
            'datatables/dataTables.bootstrap'));
        add_js(array('plugins/sweetalert/sweetalert.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/datatables/jquery.dataTables.min',
            'plugins/datatables/dataTables.bootstrap.min',
            'plugins/file-input/fileinput.min'));
        $datos['listado_cargos']    = $this->modeloHerramienta->obtener_cargos();
        $datos['titulo']            = "Lista de areas y cargos";
        $datos['contenido']         = 'herramienta/listado_herramienta_vista';
        $this->load->view('plantilla', $datos);
    }

    public function crear() {
        if ($this->input->post('valorCargo')=='valorCrearCargo') {
            $_REQUEST['cargo_crear']    = $this->security->xss_clean(strip_tags(strtoupper(tildesMayuscula(trim($this->input->post('cargo_crear'))))));
            $status                     = $this->modeloHerramienta->insertar_cargo($_REQUEST);
            $this->estado_accion_resultado($status, 'CREADO');
        }else{
            if ($this->input->is_ajax_request()) {
                $datos['lista_areas'] = $this->modeloHerramienta->obtener_areas();
                $this->load->view('herramienta/crear_herramienta_vista', $datos);
            }
        }
    }

    public function editar() {
        if ($this->input->post('valorCargo') == 'valorEditarCargo') {
            $_REQUEST['cargo_editar']   = $this->security->xss_clean(strip_tags(strtoupper(tildesMayuscula(trim($this->input->post('cargo_editar'))))));
            $status                     = $this->modeloHerramienta->actualizar_cargo($_REQUEST);
            $this->estado_accion_resultado($status, 'EDITADO');
        }else{
            if ($this->input->is_ajax_request()) {
                $id_cargo               = $this->input->get('id_cargo');
                $datos['cargo']         = $this->modeloHerramienta->seleccionar_cargo($id_cargo);
                $datos['lista_areas']   = $this->modeloHerramienta->obtener_areas();
                $this->load->view('herramienta/editar_herramienta_vista', $datos);
            }
        }
    }

    public function listado() {
        if ($this->input->is_ajax_request()) {
            $datos['listado_cargos'] = $this->modeloHerramienta->obtener_cargos();
            $this->load->view('herramienta/listado_herramienta_vista_ajax', $datos);
        }
    }

    private function estado_accion_resultado($status,$accion,$motivo=NULL){
        ($motivo!=NULL)? $motivo=$motivo : $motivo="CARGO" ;
        if ($status) {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>'El '.$motivo.' ha sido '.$accion.' correctamente','tipo'=>'success','icono'=>'accounts')));
        } else {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>'El '.$motivo.' NO ha sido '.$accion.'','tipo'=>'warning','icono'=>'mood-bad')));
        }
    }

    private function estado_accion_resultado_upload($status,$accion=NULL){
        if (!is_null($status)) {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>$status,'tipo'=>'success')));
        } else {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>'LOS CARGOS YA TIENEN ASIGNADO AREAS...','tipo'=>'warning')));
        }
    }

    public function upload(){
        if ($this->input->post('valorCargos')=='valorCrearCargos') {
            if(isset($_FILES['upload_cargo']['name']) && $_FILES['upload_cargo']['name']!== ""){
                $config['upload_path']      = './assets/uploads/';
                $config['allowed_types']    = 'csv';
                $config['max_size']         = 0;
                $config['overwrite']        = TRUE;
                $this->upload->initialize($config);
                $filename                   = "upload_cargo";
                if (!$this->upload->do_upload($filename)) {
                    $this->estado_accion_resultado(false, 'CREADO_UPLOAD','ARCHIVO');
                } else {
                    $file_data              = $this->upload->data();
                    $file_path              = './assets/uploads/' . $file_data['file_name'];
                    if ($this->csvimport->get_array($file_path)) {
                        $csv_array          = $this->csvimport->get_array($file_path);
                        $status             = $this->modeloHerramienta->insert_cargo_csv($csv_array);
                        $this->estado_accion_resultado_upload($status);
                        //redirect('herramientas','refresh');
                    } else {
                        $this->estado_accion_resultado(false, 'CREADO_DATA','ARCHIVO');
                    }
                }
            }
        }
    }

}