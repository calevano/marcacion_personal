<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax_controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario/usuario_model','modelUser');
        $this->load->model('personal/personal_model', 'modeloPersonal');
    }

    public function exportar_tabla(){
        $nombre_archivo = $_POST['nombre_archivo']."_".date('d-m-Y_h:i:s');
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename={$nombre_archivo}.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo utf8_decode($_POST['datos_a_enviar']);
    }

    public function verificar_usuario(){
        $dni_usuario = $this->input->post('dni_usuario');
        $status = $this->modelUser->verificar_existencia_usuario($dni_usuario);
        if (!is_null($status)) {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('usuario'=>$status,'mensaje'=>'correcto')));
        } else {
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('usuario'=>'No hay resultados','mensaje'=>'warning')));
        }
    }

    public function listar_cargos(){
        $id_area    = $this->input->post('id_area');
        $status     = $this->modeloPersonal->obtener_cargos($id_area);
        if(!is_null($status)){
            $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode(array('cargos'=>$status)));
        }else{
            $this->output
            ->set_content_type('application/json;charset=utf-8')
            ->set_output(json_encode(array('mensaje'=>'No hay cargos')));
        }
    }

}

/* End of file Home.php */
    /* Location: ./application/controllers/Home.php */
