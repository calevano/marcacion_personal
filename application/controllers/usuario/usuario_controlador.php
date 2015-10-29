<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Usuario_controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario/usuario_model', 'modeloUsuario');
        $this->load->helper('string');
        $this->id_rol   = $this->session->userdata('userIdRol');
        $array_valores  = array(1,2);
        if (!in_array($this->id_rol,$array_valores)) {
            redirect('', "refresh");
        }
        // if ($this->id_rol != 1) {
        //     redirect('', "refresh");
        // }
    }

   public function index() {
      add_css(array('sweetalert/sweetalert-override.min',
         'datatables/dataTables.bootstrap'));
      add_js(array('plugins/sweetalert/sweetalert.min',
        'plugins/jquery-ui/jquery-ui.min',
         'plugins/datatables/jquery.dataTables.min',
         'plugins/datatables/dataTables.bootstrap.min',
         'plugins/jqueryvalidation/dist/jquery.validate'));
      $datos['total_usuarios']   = $this->modeloUsuario->todos_los_usuarios();
      $datos['titulo']           = "Lista de usuarios";
      $datos['contenido']        = "usuario/listado_usuario_vista";
      $this->load->view('plantilla', $datos);
   }

   public function listado() {
      if ($this->input->is_ajax_request()) {
        $datos['total_usuarios']    = $this->modeloUsuario->todos_los_usuarios();
        $this->load->view('usuario/listado_usuario_vista_ajax', $datos);
      }
   }

   public function crear() {
         if ($this->input->post('valorUsuario')=='valorCrearUsuario') {
            $_REQUEST['name_usuario_crear']     = $this->security->xss_clean(strip_tags(strtolower(trim($this->input->post('name_usuario_crear')))));
            $_REQUEST['password_usuario_crear'] = $this->security->xss_clean(strip_tags(strtolower(trim(notildes($this->input->post('password_usuario_crear'))))));
            $_REQUEST['email_usuario_crear']    = $this->security->xss_clean(strip_tags(strtolower(trim(notildes($this->input->post('email_usuario_crear'))))));
            $_REQUEST['apellidos_usuario_crear']= $this->security->xss_clean(strip_tags(strtoupper(trim($this->input->post('apellidos_usuario_crear')))));
            // print_r($_REQUEST);
            // exit;
            $status = $this->modeloUsuario->insertar_usuario($_REQUEST);
            $this->estado_accion_resultado($status, 'CREADO');
            //$this->estado_accion($status, 'creado');
         }else{
            if ($this->input->is_ajax_request()) {
                $datos['total_perfil'] = $this->modeloUsuario->todos_los_perfiles();
                $this->load->view('usuario/crear_usuario_vista', $datos);
            }
        }
   }

    private function estado_accion_resultado($status,$accion){
        if ($status) {
            //log_message('INFO', "<============ Usuario {$accion} satisfactoriamente ============>");
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>'El usuario ha sido "'.$accion.'" correctamente','tipo'=>'success','icono'=>'accounts')));
        } else {
            //log_message('ERROR', $status . "Usuario NO pudo ser {$accion}");
            $this->output
                ->set_content_type('application/json;charset=utf-8')
                ->set_output(json_encode(array('mensaje'=>'El usuario NO ha sido "'.$accion.'" correctamente','tipo'=>'warning','icono'=>'mood-bad')));
        }
    }

   public function editar() {
        if ($this->input->post('valorUsuario') == 'valorEditarUsuario') {
            $_REQUEST['name_usuario_editar']       = $this->security->xss_clean(strip_tags(strtolower(trim(notildes($this->input->post('name_usuario_editar'))))));
            $_REQUEST['email_usuario_editar']      = $this->security->xss_clean(strip_tags(strtolower(trim(notildes($this->input->post('email_usuario_editar'))))));
            $_REQUEST['apellidos_usuario_editar']  = $this->security->xss_clean(strip_tags(strtoupper(trim($this->input->post('apellidos_usuario_editar')))));
            $status = $this->modeloUsuario->actualizar_usuario($_REQUEST);
            $this->estado_accion_resultado($status, 'EDITADO');
        }else{
            if ($this->input->is_ajax_request()) {
                add_js(array('plugins/autosize/dist/autosize.min'));
                $id_usuario = $this->input->get('id_user');
                $datos['total_perfil'] = $this->modeloUsuario->todos_los_perfiles();
                $datos['usuario'] = $this->modeloUsuario->seleccionar_usuario($id_usuario);
                $this->load->view('usuario/editar_usuario_vista', $datos);
            }
        }
   }

    public function verificar() {
        if(isset($_REQUEST['user_crear'])){
            $_REQUEST['user_crear'] = $this->input->post('user_crear');
        }elseif (isset($_REQUEST['email_crear'])){
            $_REQUEST['email_crear'] = $this->input->post('email_crear');
        }
        $verificar_usuario = $this->modeloUsuario->verificar_nombre_usuario($_REQUEST);
        if ($verificar_usuario) {
            echo "true";
        }else{
            echo "false";
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
      $status=$this->modeloUsuario->actualizar_accion($_REQUEST);
      $this->accion_actualizado($status,$_REQUEST['estado']);
   }

}

   /* End of file Usuario_controlador.php */
   /* Location: ./application/controllers/Usuario_controlador.php */