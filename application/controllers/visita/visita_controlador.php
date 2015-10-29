<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Visita_controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('visita/visita_model', 'modeloVisita');
        $this->id_rol   = $this->session->userdata('userIdRol');
        if ($this->id_rol !=6) {
            redirect('', "refresh");
        }
    }

    public function index() {
        add_js_(array('today_hour'));
        $data['titulo']     = "CONTROL DE VISITAS";
        $data['contenido']  = "visita/index_visita_vista";
        $data['sidebar']    = FALSE;
        $this->load->view('plantilla', $data);
    }

    public function registrar(){
        if ($this->input->is_ajax_request()) {
            $dni_persona    = $this->input->post('send_dni');
            $persona_ok     = $this->modeloVisita->registrar_visita($dni_persona);
            if (!is_null($persona_ok)) {
                if($persona_ok['recien']==1){
                    $this->estado_accion_resultado($persona_ok,'success');
                }else{
                    $this->estado_accion_resultado($persona_ok,'warning');
                }
            } else {
                $this->estado_accion_resultado($persona_ok);
            }
        }
    }

    private function estado_accion_resultado($show_array,$accion=NULL){
        if (!is_null($show_array)) {
            $this->tipo_resultado($show_array,$accion);
        } else {
            $this->tipo_resultado('DNI NO EXISTE','danger','error');
        }
    }

    private function tipo_resultado($array,$tipo,$tipo_mensaje=NULL){
        ($tipo_mensaje!=NULL)? $mensaje=$tipo_mensaje: $mensaje='mostrar' ;
        $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode(array($mensaje.'_mensaje'=>$array,'tipo'=>$tipo)));
    }

}

   /* End of file Usuario_controlador.php */
   /* Location: ./application/controllers/Usuario_controlador.php */
