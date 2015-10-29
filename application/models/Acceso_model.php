<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acceso_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function logearme($user, $pass) {
        $sql    = "SELECT
                        usu.*,
                        rol.nombre AS nombre_perfil,
                        per.nombres_apellidos
                    FROM
                        tbl_usuario AS usu
                        LEFT JOIN tbl_perfil AS rol ON usu.tbl_perfil_id=rol.id
                        LEFT JOIN tbl_persona AS per ON usu.tbl_persona_id=per.id
                    WHERE
                        usu.nombre='".$user."'
                        AND usu.clave='".sha1($pass)."'
                        AND usu.estado=1
                        AND rol.id<5";
                        //AND rol.id IN(1,2)";
        log_message('INFO', "<<<============ Logearme {$sql}============>>>");
        $query  = $this->db->query($sql);
        if($query->num_rows()==1) {
            return $query->row_array();
        }
        return NULL;
    }

    public function logearme_sede($user,$pass){
        $sql    = "SELECT
                        used.*,
                        rol.nombre AS nombre_perfil
                    FROM
                        tbl_usuario_sede AS used
                        LEFT JOIN tbl_perfil AS rol ON used.tbl_perfil_id=rol.id
                    WHERE
                        used.nombre='".$user."'
                        AND used.clave='".sha1($pass)."'
                        AND used.estado=1
                        AND rol.id=6";
        log_message('INFO', "<<<============ Logearme {$sql}============>>>");
        $query  = $this->db->query($sql);
        if($query->num_rows()==1) {
            return $query->row_array();
        }
        return NULL;
    }
}
