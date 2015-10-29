<?php

if (!defined('BASEPATH'))
exit('ACCESO PROHIBIDO');

class Login {

   private $ci;

   public function __construct() {
      $this->ci = &get_instance();
      !$this->ci->load->library('session') ? $this->ci->load->library('session') : FALSE;
      !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : FALSE;
   }

   public function check_login() {
      if (!$this->ci->session->userdata('idUserLogin') && $this->ci->uri->segment(1) != 'login' && $this->ci->uri->segment(1) != 'logout' ) {
         redirect('login');
      }
   }

}
