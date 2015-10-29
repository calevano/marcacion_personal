<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard/dashboard_model', 'modeloDashboard');
        $this->load->library('EmailSender.php');
        $this->id_rol       = $this->session->userdata('userIdRol');
        $this->userName     = $this->session->userdata('userNameUsuario');
        if ($this->id_rol == 6) {
            redirect('visita', "refresh");
        }
    }

    public function index() {
        //redirect('asistencia','refresh');
        add_css(array('sweetalert/sweetalert-override.min',
            'chosen/chosen.min'));
        add_js(array('plugins/sweetalert/sweetalert.min',
            'plugins/chosen/chosen.jquery.min',
            'plugins/autosize/dist/autosize.min',
            'plugins/jqueryvalidation/dist/jquery.validate'));
        $datos['lista_personal']    = $this->modeloDashboard->listado_personal();
        $datos['titulo']            = "PORTADA";
        $datos['contenido']         = "dashboard/listado_dashboard_vista";
        $this->load->view('plantilla', $datos);

    }

    // public function envio(){

    //     if ($this->input->post('valorDashboard')=='valorEnvioDashboard') {
    //         if(isset($_REQUEST['email_personal_dashboard']) && count($_REQUEST['email_personal_dashboard'])>0){
    //             $email = $this->modeloDashboard->buscar_email_usuario($this->userName);
    //             if(!is_null($email)){
    //                 foreach ($_REQUEST['email_personal_dashboard'] as $item) {
    //                     $this->emailsender->send($email['email'],$email['nombres_apellidos'],$item,$_REQUEST['asunto_dashboard'],$_REQUEST['mensaje_dashboard']);
    //                 }
    //                 $this->estado_accion_resultado(TRUE, 'CORREOS ENVIADOS CORECTAMENTE A LOS DESTINATARIOS');
    //             }else{
    //                 $this->estado_accion_resultado(FALSE, 'NO TIENES UN CORREO ASOCIADO PARA PODER ENVIAR MENSAJES');
    //             }
    //         }else{
    //             $this->estado_accion_resultado(FALSE, 'SELECCIONA AL MENOS UN CORREO PARA ENVIARLE EL MENSAJE');
    //         }
    //         //send($from_,$to_,$subject_,$message_)
    //     }else{
    //         echo "POR AQUÍ NO....!!!!! NO SEAS VIVO";
    //     }
    // }

    // private function estado_accion_resultado($status,$mensaje){
    //     if ($status) {
    //         $this->output
    //             ->set_content_type('application/json;charset=utf-8')
    //             ->set_output(json_encode(array('mensaje'=>$mensaje,'tipo'=>'success','icono'=>'accounts')));
    //     } else {
    //         $this->output
    //             ->set_content_type('application/json;charset=utf-8')
    //             ->set_output(json_encode(array('mensaje'=>$mensaje,'tipo'=>'warning','icono'=>'mood-bad')));
    //     }
    // }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */