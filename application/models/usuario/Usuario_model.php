<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Usuario_model extends CI_Model {

   public function __construct() {
      parent::__construct();
      $this->idLogin = $this->session->userdata('idUserLogin');
      $this->nameUsuario = $this->session->userdata('userNameUsuario');
   }

   public function todos_los_usuarios(){
      $sql="SELECT
                usu.id,
                usu.nombre,
                usu.estado,
                usu.creado_por,
                usu.fecha_creado,
                usu.modificado_por,
                usu.fecha_modificado,
                usu.tbl_perfil_id,
                rol.nombre AS nombre_perfil,
                usu.tbl_persona_id,
                per.nombres_apellidos,
                per.email,
                per.tbl_proyecto_id,
                pro.nombre AS nombre_proyecto,
                pro.nombre_corto AS nombre_corto_proyecto
            FROM
                tbl_usuario AS usu
                LEFT JOIN tbl_perfil AS rol ON usu.tbl_perfil_id=rol.id
                LEFT JOIN tbl_persona AS per ON usu.tbl_persona_id=per.id
                LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
                ORDER BY per.nombres_apellidos";
      $query=$this->db->query($sql);
      return $query->result_array();
   }

    public function todos_los_perfiles() {
        $query = $this->db->select('id,nombre')->get('tbl_perfil');
        if($query->num_rows()>0){
            return $query->result_array();
        }
        return NULL;
    }

    public function actualizar_accion($params){
        if(isset($params['estado'])){
            ($params['estado']==1) ? $estado=0: $estado=1;
            $datos=array(
            'estado'          => $estado,
            'modificado_por'  => $this->nameUsuario,
            'fecha_modificado'=> date("Y-m-d H:i:s")
            );
        }else{
            ($params['clave_activo']==1) ? $clave_activo=0: $clave_activo=1;
            $datos=array(
            'active_key'=>$clave_activo,
            'modificado_por' => $this->nameUsuario,
            'fecha_modificado' => date("Y-m-d H:i:s")
            );
      }
      $this->db->where('id',$params['id_user']);
      return $this->db->update('tbl_usuario',$datos);
    }

    public function seleccionar_usuario($id_usuario){
        $sql="SELECT
                usu.id,
                usu.nombre,
                usu.estado,
                usu.creado_por,
                usu.fecha_creado,
                usu.modificado_por,
                usu.fecha_modificado,
                usu.tbl_perfil_id,
                rol.nombre AS nombre_perfil,
                usu.tbl_persona_id,
                per.nombres_apellidos,
                per.email,
                per.tbl_proyecto_id,
                pro.nombre AS nombre_proyecto,
                pro.nombre_corto AS nombre_corto_proyecto
            FROM
                tbl_usuario AS usu
                LEFT JOIN tbl_perfil AS rol ON usu.tbl_perfil_id=rol.id
                LEFT JOIN tbl_persona AS per ON usu.tbl_persona_id=per.id
                LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
            WHERE
                usu.id='".$id_usuario."'";
        $query=$this->db->query($sql);
        if($query->num_rows()==1){
            return $query->row_array();
        }
        return NULL;
    }

   public function insertar_usuario($params){
      $datos = array(
         'tbl_perfil_id'      => $params['perfil_usuario_crear'],
         'usuario'            => $params['name_usuario_crear'],
         'clave'              => sha1($params['password_usuario_crear']),
         'email'              => $params['email_usuario_crear'],
         'nombres'           => $params['nombres_usuario_crear'],
         'apellidos'          => $params['apellidos_usuario_crear'],
         'creado_por'         => $this->nameUsuario,
         'fecha_creado'       => date("Y-m-d H:i:s")
      );
      return $this->db->insert('tbl_usuario',$datos);
   }

    public function actualizar_usuario($params){
        $datos = array(
            'modificado_por'     => $this->nameUsuario,
            'fecha_modificado'   => date("Y-m-d H:i:s")
        );
        if(isset($params['perfil_usuario_editar'])){
            $this->db->set('tbl_perfil_id',$params['perfil_usuario_editar']);
        }

        if($params['pass_usuario_editar'] != ''){
            $this->db->set('clave',sha1($params['pass_usuario_editar']));
        }

        $this->db->where('id',$params['hidden_id_usuario_editar']);
        return $this->db->update('tbl_usuario',$datos);
    }

    public function verificar_existencia_usuario($id_usuario){
       $sql="SELECT
                usu.id,
                usu.nombre,
                usu.estado,
                usu.tbl_persona_id,
                per.nombres_apellidos,
                per.email,
                per.tbl_proyecto_id,
                pro.nombre AS nombre_proyecto,
                pro.nombre_corto AS nombre_corto_proyecto
            FROM
                tbl_usuario AS usu
                LEFT JOIN tbl_perfil AS rol ON usu.tbl_perfil_id=rol.id
                LEFT JOIN tbl_persona AS per ON usu.tbl_persona_id=per.id
                LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
            WHERE
                usu.id='".$id_usuario."'";
        $query=$this->db->query($sql);
        if($query->num_rows()==1){
            return $query->row_array();
        }else{
            $sql_persona="SELECT
                            per.id AS id_persona,
                            per.nombres_apellidos,
                            per.email,
                            per.tbl_proyecto_id,
                            pro.nombre AS nombre_proyecto,
                            pro.nombre_corto AS nombre_corto_proyecto
                        FROM
                            tbl_persona AS per
                            LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
                        WHERE
                            per.dni='".$id_usuario."'";
            $query_persona=$this->db->query($sql_persona);
            if($query_persona->num_rows()==1){
                return $query_persona->row_array();
            }else{
                return NULL;
            }
        }
    }

    public function verificar_nombre_usuario($params) {
        if(isset($params['user_crear'])):
            $query = $this->db->where('nombre',$params['user_crear'])->select('nombre')->get('tbl_usuario');
        elseif (isset($params['email_crear'])):
            $query = $this->db->where('email',$params['email_crear'])->select('email')->get('tbl_usuario');
        endif;
        if($query->num_rows()==0){
            return TRUE;
        }
        return FALSE;
    }
}