<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Herramienta_model extends CI_Model {

   public function __construct() {
      parent::__construct();
      $this->idLogin = $this->session->userdata('idUserLogin');
      $this->nameUsuario = $this->session->userdata('userNameUsuario');
   }

    public function obtener_areas(){
        $sql="SELECT
                are.id,
                are.nombre AS nombre_area
            FROM
                tbl_area AS are
            WHERE
                1=1
                AND are.estado=1 ORDER BY are.nombre";
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function seleccionar_cargo($id_cargo){
        $sql="SELECT
                car.id,
                car.tbl_area_id,
                car.nombre AS nombre_cargo
            FROM
                tbl_area AS are
                LEFT JOIN tbl_cargo AS car ON are.id=car.tbl_area_id
            WHERE
                1=1 AND car.id=".$id_cargo;
        //log_message('INFO',"<<<<<< SQL cargo editar:".$sql);
        $query=$this->db->query($sql);
        return $query->row_array();
    }

    public function obtener_cargos(){
        $sql="SELECT
                are.id,
                are.nombre AS nombre_area,
                are.estado AS estado_area,
                car.id AS id_cargo,
                car.tbl_area_id,
                car.nombre AS nombre_cargo,
                car.estado AS estado_cargo,
                car.creado_por,
                car.fecha_creado,
                car.modificado_por,
                car.fecha_modificado
            FROM
                tbl_area AS are
                LEFT JOIN tbl_cargo AS car ON are.id=car.tbl_area_id
            WHERE
                1=1 ";
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
      $this->db->where('id',$params['id_estudiante']);
      return $this->db->update('tbl_cargo',$datos);
   }

    public function seleccionar_estudiante($id_estudiante){
        $query=$this->db->where('id',$id_estudiante)->select('*')->get('tbl_estudiante');
        if($query->num_rows()==1){
            return $query->row_array();
        }
        return NULL;
    }

    public function verificar_existe_cargo($params){
        $sql = "SELECT tbl_area_id,nombre FROM tbl_cargo WHERE tbl_area_id=".$params['area_id']." AND nombre='".$params['cargo']."' ";
        $query=$this->db->query($sql);
        if($query->num_rows()==1){
            return $query->row_array();
        }
        return NULL;

    }

    public function insert_cargo_csv($params){
        $array_cargo = array();
        foreach ($params as $row) {
            $existe_cargo = $this->verificar_existe_cargo($row);
            if(is_null($existe_cargo)){
                $insert_data  = array(
                    'tbl_area_id'   => $row['area_id'],
                    'nombre'        => strtoupper(tildesMayuscula(trim($row['cargo']))),
                    'creado_por'    => $this->nameUsuario
                );
                $this->db->insert('tbl_cargo',$insert_data);
            }else{
                $array_cargo[] = $existe_cargo;
            }

        }

        return (is_null($array_cargo)) ? NULL : $array_cargo ;
        //return $this->db->insert_batch('tbl_cargo', $params);
    }

    public function insertar_cargo($params){
        $datos = array(
            'tbl_area_id'   => $params['area_crear'],
            'nombre'        => $params['cargo_crear'],
            'creado_por'    => $this->nameUsuario
        );
        return $this->db->insert('tbl_cargo',$datos);
   }

    public function actualizar_cargo($params){
        $datos = array(
            'tbl_area_id'       => $params['area_editar'],
            'nombre'            => $params['cargo_editar'],
            'modificado_por'    => $this->nameUsuario
        );
        $this->db->where('id',$params['hidden_id_cargo_editar']);
        return $this->db->update('tbl_cargo',$datos);
    }

   public function verificar_opcion_estudiante($params) {
      if(isset($_REQUEST['dni_crear'])):
         $query = $this->db->where('dni',$params['dni_crear'])->select('dni')->get('tbl_estudiante');
      elseif (isset($_REQUEST['codigo_crear'])):
         $query = $this->db->where('codigo',$params['codigo_crear'])->select('codigo')->get('tbl_estudiante');
      elseif (isset($_REQUEST['email_crear'])):
         $query = $this->db->where('email',$params['email_crear'])->select('email')->get('tbl_estudiante');
      endif;
      if($query->num_rows()==0){
         return TRUE;
      }
      return FALSE;
   }

   public function verificar_imagen_estudiante($id_estudiante){
      $query = $this->db->where('id',$id_estudiante)->select('id,foto')->get('tbl_estudiante');
      if($query->num_rows() == 1):
         return $query->row_array();
      endif;
      return NULL;
   }

}