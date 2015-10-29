<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Visita_model extends CI_Model {

   public function __construct() {
      parent::__construct();
      $this->idLogin        = $this->session->userdata('idUserLogin');
      $this->nameUsuario    = $this->session->userdata('userNameUsuario');
   }

    public function registrar_visita($dni){
        $sql                    = "SELECT dni FROM tbl_persona WHERE dni='{$dni}'";
        $query                  = $this->db->query($sql);
        if($query->num_rows()==1){

            $sql_asistencia     = "SELECT
                                        *
                                    FROM
                                        tbl_visita
                                    WHERE 1=1
                                        AND dni='{$dni}' AND fecha='".date('Y-m-d')."'
                                        AND hora_ingreso !='00:00:00' AND estado=1
                                        AND id=(SELECT max(id) AS max_id FROM tbl_visita WHERE dni='{$dni}') ";
            log_message("INFO","seleccionando para actualizar --- {$sql_asistencia}");
            $query_asistencia   = $this->db->query($sql_asistencia);

            if($query_asistencia->num_rows()>=1){

                $sql_id_max     = "SELECT max(id) AS max_id FROM tbl_visita WHERE dni='".$dni."'";
                log_message("INFO","SELECCIONAR MAX DNI PARA ACTUALIZAR --- {$sql_id_max}");
                $query_id_max   =  $this->db->query($sql_id_max)->row_array();

                $data_hora_fin  = array(
                        'estado'            => 2,
                        'hora_salida'       => date('H:i:s'),
                        'modificado_por'    => $this->nameUsuario,
                        'fecha_modificado'  => date("Y-m-d H:i:s")
                    );
                //$sql_where      = " dni='".$dni."' AND id=".$query_id_max['max_id']." ";
                $this->db->where('dni',$dni);
                $this->db->where('id',$query_id_max['max_id']);
                $this->db->update('tbl_visita',$data_hora_fin);

                $sql_lista      = $this->select_visita();
                $sql_lista     .= " WHERE vis.dni='".$dni."' AND vis.id=".$query_id_max['max_id']." ";
                log_message("INFO","DEVOLVIENDO RESULTADO ACTUALIZADO --- {$sql_lista}");
                $query_persona  = $this->db->query($sql_lista)->row_array();
                $query_persona['recien'] = 2;

            }else{

                $data_hora_inicio = array(
                    'dni'           => $dni,
                    'fecha'         => date('Y-m-d'),
                    'hora_ingreso'  => date('H:i:s'),
                    'hora_salida'   => '00:00:00',
                    'creado_por'    => $this->nameUsuario
                    );

                $this->db->insert('tbl_visita',$data_hora_inicio);
                $ultimo_id      = $this->db->insert_id();

                $sql_lista      = $this->select_visita();
                $sql_lista     .= " WHERE vis.dni={$dni} AND vis.id={$ultimo_id}";
                $query_persona  = $this->db->query($sql_lista)->row_array();
                $query_persona['recien'] = 1;

            }

            return $query_persona;
        }
        return NULL;
    }

    public function select_visita(){
        return "SELECT
                    per.dni,
                    per.nombres_apellidos,
                    are.nombre AS nombre_area,
                    car.nombre AS nombre_cargo,
                    pro.nombre AS nombre_proyecto,
                    UPPER(pro.nombre_corto) AS nombre_corto_proyecto,
                    sed.nombre AS nombre_sede,
                    vis.hora_ingreso,
                    vis.hora_salida
                FROM
                    tbl_visita AS vis
                    LEFT JOIN tbl_persona AS per ON vis.dni=per.dni
                    LEFT JOIN tbl_sede AS sed ON per.tbl_sede_id=sed.id
                    LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
                    LEFT JOIN tbl_cargo AS car ON per.tbl_cargo_id=car.id
                    LEFT JOIN tbl_area AS are ON car.tbl_area_id=are.id ";
    }

    // public function select_asistencia(){
    //     return "";
    // }

    // public function select(){
    //     return "SELECT
    //                per.dni,
    //                per.nombres_apellidos,
    //                are.nombre AS nombre_area,
    //                car.nombre AS nombre_cargo,
    //                pro.nombre AS nombre_proyecto,
    //                UPPER(pro.nombre_corto) AS nombre_corto_proyecto,
    //                sed.nombre AS nombre_sede
    //             FROM
    //                tbl_persona AS per
    //                LEFT JOIN tbl_sede AS sed ON per.tbl_sede_id=sed.id
    //                LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
    //                LEFT JOIN tbl_cargo AS car ON per.tbl_cargo_id=car.id
    //                LEFT JOIN tbl_area AS are ON car.tbl_area_id=are.id ";
    // }

}
