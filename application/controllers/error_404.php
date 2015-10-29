<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Error_404 extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->id_rol       = $this->session->userdata('userIdRol');
        if ($this->id_rol == 6) {
            redirect('visita', "refresh");
        }
    }

    public function index(){
        $this->output->set_status_header('404');
        $datos['titulo']            = "Error 404";
        $datos['contenido']         = "errors/personalizado/error_404";
        $this->load->view('plantilla', $datos);
    }
}
?>