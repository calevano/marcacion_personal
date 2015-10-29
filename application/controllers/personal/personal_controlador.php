<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Personal_controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('personal/personal_model', 'modeloPersonal');
        $this->load->library('csvimport');
        $this->load->library('upload');
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', -1);
        $this->nameUsuario = $this->session->userdata('userNameUsuario');
        $this->id_rol       = $this->session->userdata('userIdRol');
        if ($this->id_rol == 6) {
            redirect('visita', "refresh");
        }
    }

    public function index() {
        add_css(array('sweetalert/sweetalert-override.min',
            'datatables/dataTables.bootstrap',
            'bootstrap-select/bootstrap-select.min'));
        add_js(array('plugins/sweetalert/sweetalert.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/bootstrap-select/bootstrap-select.min',
            'plugins/bootstrap-select/i18n/defaults-es_CL.min',
            'plugins/datatables/jquery.dataTables.min',
            'plugins/datatables/dataTables.bootstrap.min',
            'plugins/jqueryvalidation/dist/jquery.validate'));
        $datos['total_personas']    = $this->modeloPersonal->obtener_personas();
        $datos['titulo']            = "Lista de Personas";
        $datos['contenido']         = 'persona/listado_persona_vista';
        $this->load->view('plantilla', $datos);
    }

    public function crear() {
        if ($this->input->post('valorPersona')=='valorCrearPersona') {
            $_REQUEST['apellidos_crear']    = $this->security->xss_clean(strip_tags(strtoupper(tildesMayuscula(trim($this->input->post('apellidos_crear'))))));
            $_REQUEST['email_crear']        = $this->security->xss_clean(strip_tags(strtolower(trim(notildes($this->input->post('email_crear'))))));
            $status                         = $this->modeloPersonal->insertar_persona($_REQUEST);
            $this->estado_accion_resultado($status, 'CREADO');
        }else{
            if ($this->input->is_ajax_request()) {
                $datos['lista_proyecto']    = $this->modeloPersonal->obtener_proyectos();
                $datos['lista_sede']        = $this->modeloPersonal->obtener_sedes();
                $datos['lista_area']        = $this->modeloPersonal->obtener_areas();
                $datos['lista_cargo']       = $this->modeloPersonal->obtener_cargos($datos['lista_area'][0]['id']);
                $this->load->view('persona/crear_persona_vista', $datos);
            }
        }
    }

    public function listado() {
        if ($this->input->is_ajax_request()) {
            $datos['total_personas']            = $this->modeloPersonal->obtener_personas();
            $this->load->view('persona/listado_persona_vista_ajax', $datos);
        }
    }

    public function editar() {
        if ($this->input->post('valorPersona')=='valorEditarPersona') {
            $_REQUEST['apellidos_editar']   = $this->security->xss_clean(strip_tags(strtoupper(tildesMayuscula(trim($this->input->post('apellidos_editar'))))));
            $_REQUEST['email_editar']       = $this->security->xss_clean(strip_tags(strtolower(trim(notildes($this->input->post('email_editar'))))));
            $status                         = $this->modeloPersonal->actualizar_persona($_REQUEST);
            $this->estado_accion_resultado($status, 'EDITADO');
        }else{
            if ($this->input->is_ajax_request()) {
                $id_persona                 = $this->input->get('id_persona');
                $datos['persona']           = $this->modeloPersonal->seleccionar_persona($id_persona);
                $datos['lista_proyecto']    = $this->modeloPersonal->obtener_proyectos();
                $datos['lista_sede']        = $this->modeloPersonal->obtener_sedes();
                $datos['lista_area']        = $this->modeloPersonal->obtener_areas();
                $datos['lista_cargo']       = $this->modeloPersonal->obtener_cargos($datos['persona']['tbl_area_id']);
                $this->load->view('persona/editar_persona_vista', $datos);
            }
        }
    }

    private function estado_accion_resultado($status,$accion,$motivo=NULL){
        ($motivo!=NULL)? $motivo=$motivo : $motivo="PERSONAL";
        if ($status) {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>$motivo.' ha sido '.$accion.' correctamente','tipo'=>'success','icono'=>'accounts')));
        } else {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>$motivo.' NO ha sido '.$accion.'','tipo'=>'warning','icono'=>'mood-bad')));
        }
    }

    private function accion_actualizado($status,$key) {
        if ($status) {
            ($key==1)? $key=0 : $key=1 ;
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('tipo'=>'success','estado'=>$key)));
        } else {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>'Se produjo un error al cambiar el estado','tipo'=>'warning')));
        }
    }

    public function estado() {
        $status                             = $this->modeloPersonal->actualizar_accion($_REQUEST);
        $this->accion_actualizado($status,$_REQUEST['estado']);
    }

    public function upload(){
        if ($this->input->post('valorPersonas')=='valorCrearPersonas') {
            if(isset($_FILES['upload_personal']['name']) and $_FILES['upload_personal']['name']!== ""){
                $config['upload_path']      = './assets/uploads/';
                $config['allowed_types']    = 'csv';
                $config['max_size']         = 0;
                $config['overwrite']        = TRUE;
                $this->upload->initialize($config);
                $filename                   = "upload_personal";
                if (!$this->upload->do_upload($filename)) {
                    $this->estado_accion_resultado(false, 'CREADO_UPLOAD','ARCHIVO_PERSONAL');
                } else {
                    $file_data              = $this->upload->data();
                    $file_path              = './assets/uploads/' . $file_data['file_name'];
                    if ($this->csvimport->get_array($file_path)) {
                        $csv_array          = $this->csvimport->get_array($file_path);
                        $status             = $this->modeloPersonal->insert_personal_csv($csv_array);
                        redirect('personal','refresh');
                    } else {
                        $this->estado_accion_resultado(false, 'CREADO_DATA','ARCHIVO_PERSONAL');
                    }
                }
            }
        }
    }

    public function verificar() {
        if(isset($_REQUEST['dni_crear'])){
            $_REQUEST['dni_crear']          = $this->input->post('dni_crear');
        }elseif (isset($_REQUEST['email_crear'])){
            $_REQUEST['email_crear']        = $this->input->post('email_crear');
        }
        $verificar_docente                  = $this->modeloPersonal->verificar_opcion_personal($_REQUEST);
        if ($verificar_docente){
            echo "true";
        }else{
            echo "false";
        }
    }

}

   /* End of file Usuario_controlador.php */
   /* Location: ./application/controllers/Usuario_controlador.php */