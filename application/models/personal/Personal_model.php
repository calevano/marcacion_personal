<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Personal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->idLogin = $this->session->userdata('idUserLogin');
        $this->nameUsuario = $this->session->userdata('userNameUsuario');
    }

    public function obtener_proyectos(){
        $sql="SELECT id,nombre,nombre_corto FROM tbl_proyecto WHERE estado=1 ORDER BY nombre_corto";
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function obtener_sedes(){
        $sql="SELECT id,nombre FROM tbl_sede WHERE estado=1 ORDER BY nombre";
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function obtener_areas(){
        $sql="SELECT id,nombre FROM tbl_area WHERE estado=1 ORDER BY nombre";
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function obtener_cargos($id_area=NULL){
        if($id_area!=NULL){
            $where_area = " AND car.tbl_area_id={$id_area} ";
        }else{
            $where_area = "";
        }
        $sql="SELECT
                car.id,
                car.tbl_area_id,
                car.nombre
            FROM
                tbl_area AS are
                LEFT JOIN tbl_cargo AS car ON are.id=car.tbl_area_id
            WHERE
                1=1 ".$where_area." ORDER BY car.nombre";
        //log_message('INFO',"<<<<<<<<<----- obteniendo cargos para persona ".$sql);
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function obtener_personas(){
        $sql="SELECT
               per.*,
               car.tbl_area_id,
               are.nombre AS nombre_area,
               car.nombre AS nombre_cargo,
               pro.nombre AS nombre_proyecto,
               pro.nombre_corto AS nombre_corto_proyecto,
               sed.nombre AS nombre_sede,
               sed.nombre_corto AS nombre_corto_sede
            FROM
               tbl_persona AS per
               LEFT JOIN tbl_sede AS sed ON per.tbl_sede_id=sed.id
               LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
               LEFT JOIN tbl_cargo AS car ON per.tbl_cargo_id=car.id
               LEFT JOIN tbl_area AS are ON car.tbl_area_id=are.id
            WHERE
               1=1 ORDER BY per.nombres_apellidos";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    public function actualizar_accion($params){
        ($params['estado']==1) ? $estado=0: $estado=1;
        $datos=array(
            'estado'          => $estado,
            'modificado_por'  => $this->nameUsuario,
            'fecha_modificado'=> date("Y-m-d H:i:s")
        );
        $this->db->where('id',$params['id_persona']);
        return $this->db->update('tbl_persona',$datos);
    }

    public function seleccionar_persona($id_persona){
        $sql="SELECT
                per.*,
                are.id AS tbl_area_id
            FROM
                tbl_persona AS per
                LEFT JOIN tbl_cargo AS car ON per.tbl_cargo_id=car.id
                LEFT JOIN tbl_area AS are ON car.tbl_area_id=are.id
            WHERE
                per.id=".$id_persona;
        $query=$this->db->query($sql);
        if($query->num_rows()==1){
            return $query->row_array();
        }
        return NULL;
    }

    public function insert_personal_csv($params){
        foreach ($params as $row) {
            $insert_data=array(
                'tbl_proyecto_id'   => $row['proyecto'],
                'tbl_cargo_id'      => $row['cargo'],
                'tbl_sede_id'       => $row['sede'],
                'nombres_apellidos' => strtoupper(tildesMayuscula(trim($row['nombre_apellidos']))),
                'nombres_cadena'    => url_amigable(trim($row['nombre_apellidos'])),
                'dni'               => str_pad(trim($row['dni']), 8, "0", STR_PAD_LEFT),
                'creado_por'        => $this->nameUsuario
            );
            $persona_ok = $this->db->insert('tbl_persona',$insert_data);
            $ultimo_id  = $this->db->insert_id();
            if($persona_ok){
                $dato_user = array(
                    'tbl_persona_id'    => $ultimo_id,
                    'tbl_perfil_id'     => 5,
                    'nombre'            => $row['dni'],
                    'clave'             => sha1($row['dni']),
                    'creado_por'        => $this->nameUsuario
                );
                $this->db->insert('tbl_usuario',$dato_user);
            }
        }
    }

    public function insertar_persona($params){
        $datos = array(
            'tbl_proyecto_id'   => $params['proyecto_crear'],
            'tbl_cargo_id'      => $params['cargo_crear'],
            'tbl_sede_id'       => $params['sede_crear'],
            'nombres_apellidos' => $params['apellidos_crear'],
            'nombres_cadena'    => url_amigable($params['apellidos_crear']),
            'fecha_nacimiento'  => NULL,
            'dni'               => $params['dni_crear'],
            'email'             => $params['email_crear'],
            'telefono_personal' => $params['tel_personal_crear'],
            'telefono_inei'     => $params['tel_inei_crear'],
            'creado_por'        => $this->nameUsuario
        );
        $persona_ok = $this->db->insert('tbl_persona',$datos);
        $ultimo_id  = $this->db->insert_id();
        if($persona_ok){
            $dato_user = array(
                'tbl_persona_id'    => $ultimo_id,
                'tbl_perfil_id'     => 5,
                'nombre'            => $params['dni_crear'],
                'clave'             => sha1($params['dni_crear']),
                'creado_por'        => $this->nameUsuario
            );
            $this->db->insert('tbl_usuario',$dato_user);
        }
        return $persona_ok;
    }

    public function actualizar_persona($params){
        $datos = array(
            'tbl_proyecto_id'   => $params['proyecto_editar'],
            'tbl_cargo_id'      => $params['cargo_editar'],
            'tbl_sede_id'       => $params['sede_editar'],
            'nombres_apellidos' => $params['apellidos_editar'],
            'nombres_cadena'    => url_amigable($params['apellidos_editar']),
            'fecha_nacimiento'  => NULL,
            'dni'               => $params['dni_editar'],
            'email'             => $params['email_editar'],
            'telefono_personal' => $params['tel_personal_editar'],
            'telefono_inei'     => $params['tel_inei_editar'],
            'modificado_por'    => $this->nameUsuario,
            'fecha_modificado'  => date("Y-m-d H:i:s")
        );
        $this->db->where('id',$params['hidden_id_persona_editar']);
        return $this->db->update('tbl_persona',$datos);
    }

    public function verificar_opcion_personal($params) {
        if(isset($_REQUEST['dni_crear'])){
            $query = $this->db->where('dni',$params['dni_crear'])->select('dni')->get('tbl_persona');
        }elseif (isset($_REQUEST['email_crear'])){
            $query = $this->db->where('email',$params['email_crear'])->select('email')->get('tbl_persona');
        }
        if($query->num_rows()==0){
            return TRUE;
        }
        return FALSE;
    }

}