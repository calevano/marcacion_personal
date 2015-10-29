<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acceso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('acceso_model', 'modeloAcceso');
    }

    public function login() {
        if (!$this->session->userdata('idUserLogin')) {
            $usuario        = $this->security->xss_clean(strip_tags($this->input->post('sendUser', TRUE)));
            $pass           = $this->security->xss_clean(strip_tags($this->input->post('sendPass', TRUE)));
            if ($usuario and $pass) {
                // print_r($_REQUEST);
                // exit;
                $sede       = "sede_";
                $verificar_logeo = strpos($usuario, $sede);
                if($verificar_logeo!==FALSE){
                    $res   = $this->modeloAcceso->logearme_sede($usuario, $pass);
                    if(!is_null($res)) {

                        $dato_usuario = array(
                            'idUserLogin'       => $res['id'],
                            'userNameUsuario'   => $res['nombre'],
                            'userIdRol'         => $res['tbl_perfil_id'],
                            'userNombreRol'     => $res['nombre_perfil']
                        );
                        $this->session->set_userdata($dato_usuario);
                        redirect('visita', 'refresh');

                    }else{
                        $this->session->set_flashdata('usuario_incorrecto', 'DATOS INGRESADOS SON INCORRECTOS...');
                        redirect('login', 'refresh');
                    }
                }else{
                    $response   = $this->modeloAcceso->logearme($usuario, $pass);
                    if(!is_null($response)) {

                        $dato_usuario = array(
                            'idUserLogin'       => $response['id'],
                            'userNameUsuario'   => $response['nombre'],
                            'userIdRol'         => $response['tbl_perfil_id'],
                            'userNombreRol'     => $response['nombre_perfil'],
                            'userNombres'       => $response['nombres_apellidos']
                        );
                        $this->session->set_userdata($dato_usuario);
                        redirect('', 'refresh');

                    }else{
                        $this->session->set_flashdata('usuario_incorrecto', 'DATOS INGRESADOS SON INCORRECTOS...');
                        redirect('login', 'refresh');
                    }
                }

            }else{
                $data['titulo']             = "Acceso al sistema";
                $data['contenido']          = "acceso/login_acceso";
                $data['sidebar']            = FALSE;
                $this->load->view('plantilla', $data);
            }
        }else{
            redirect('', 'refresh');
        }
    }

    public function logout() {
        $this->session->unset_userdata('idUserLogin');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

}

/* End of file Home.php */
    /* Location: ./application/controllers/Home.php */
