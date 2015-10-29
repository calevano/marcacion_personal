<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->idLogin = $this->session->userdata('idUserLogin');
        $this->nameUsuario = $this->session->userdata('userNameUsuario');
    }

    public function listado_personal(){
        $sql_proyecto="SELECT
                            usu.id,
                            per.tbl_proyecto_id
                        FROM
                            tbl_usuario AS usu
                            LEFT JOIN tbl_persona AS per ON usu.tbl_persona_id=per.id
                        WHERE
                            usu.id=".$this->idLogin."
                            AND usu.estado=1;";
        log_message('INFO',"<<<<<<listando proyecto ".$sql_proyecto);
        $query_proyecto=$this->db->query($sql_proyecto);
        if($query_proyecto->num_rows()==1){
            $proyecto_id=$query_proyecto->row_array();
            if($proyecto_id['tbl_proyecto_id']!=NULL){
                $sql="SELECT DISTINCT
                        car.tbl_area_id,
                        are.nombre AS nombre_area
                    FROM
                        tbl_persona AS per
                        LEFT JOIN tbl_cargo AS car ON per.tbl_cargo_id=car.id
                        LEFT JOIN tbl_area AS are ON car.tbl_area_id=are.id
                    WHERE
                        1=1
                        AND per.email IS NOT NULL
                        AND per.tbl_proyecto_id=".$proyecto_id['tbl_proyecto_id']. "  ORDER BY are.nombre";
                log_message('INFO',"<<<<< listando areas ".$sql);
                $query=$this->db->query($sql)->result_array();
                foreach($query as $key => $item){
                    $query[$key]['personal_cargo'] = $this->listar_personal_cargo($proyecto_id['tbl_proyecto_id'],$item['tbl_area_id']);
                }
                return $query;
            }

        }
        return NULL;
    }

    public function listar_personal_cargo($id_proyecto,$id_area){
        $sql="SELECT
                per.id,
                per.tbl_proyecto_id,
                per.nombres_apellidos,
                per.dni,
                per.email
            FROM
                tbl_persona AS per
                LEFT JOIN tbl_cargo AS car ON per.tbl_cargo_id=car.id
                LEFT JOIN tbl_area AS are ON car.tbl_area_id=are.id
            WHERE
                1=1
                AND per.email IS NOT NULL
                AND are.id=".$id_area."
                AND per.tbl_proyecto_id=".$id_proyecto."  ORDER BY per.nombres_apellidos";
        log_message('INFO',"<<<<< listando personal por area  ".$sql);
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function buscar_email_usuario($dni_persona){
        $query=$this->db->where('dni',$dni_persona)->select('nombres_apellidos,email')->get('tbl_persona');
        if($query->num_rows()==1){
            return $query->row_array();
        }
        return NULL;
    }

}