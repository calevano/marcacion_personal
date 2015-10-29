<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Asistencia_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->idLogin      = $this->session->userdata('idUserLogin');
        $this->nameUsuario  = $this->session->userdata('userNameUsuario');
    }

    public function obtener_cantidad_visita($dni,$fecha_=NULL){
        ($fecha_ != NULL) ? $where_fecha = " $fecha_ " : $where_fecha = date('Y-m-d');
        $sql    = $this->select_persona();
        $sql   .= $this->from_visita();
        $sql   .= " WHERE
                        1=1
                        AND vis.fecha='{$where_fecha}'
                        AND vis.dni='{$dni}'";
        log_message("INFO", "mostrando listado de cantidad de visitas___ ".$sql);
        $query  = $this->db->query($sql);
        return $query->result_array();
    }

    public function obtener_listado_rango_visita($params=NULL){
        (isset($params['sedes']) && $params['sedes'] != NULL && $params['sedes']!='null') ? $where_sedes = " AND sed.id IN (".$params['sedes'].") " : $where_sedes = " ";
        (isset($params['areas']) && $params['areas'] != NULL && $params['areas']!='null') ? $where_areas = " AND are.id IN (".$params['areas'].") " : $where_areas = " ";
        if (isset($params['fecha_de']) && $params['fecha_de']!= NULL) {
            $where_de = convertirFecha($params['fecha_de'], 'Y-m-d');
        } else {
            $fecha      = date('Y-m-d');
            $fechatras  = strtotime('-7 day', strtotime($fecha));
            $where_de   = date('Y-m-d', $fechatras);
        }
        (isset($params['fecha_hasta']) && $params['fecha_hasta']!= NULL) ? $where_hasta = convertirFecha($params['fecha_hasta'], 'Y-m-d') : $where_hasta = date('Y-m-d');

        $sql    ="SELECT
                    vis.dni,
                    vis.fecha,
                    per.nombres_apellidos,
                    are.nombre AS nombre_area,
                    car.nombre AS nombre_cargo,
                    pro.nombre AS nombre_proyecto,
                    UPPER(pro.nombre_corto) AS nombre_corto_proyecto,
                    sed.nombre AS nombre_sede,
                    GROUP_CONCAT(DISTINCT(DATE_FORMAT(vis.fecha,'%d-%m'))) AS dias_visitas,
                    COUNT(DISTINCT(vis.fecha)) AS cantidad_visitas ";
        $sql   .= $this->from_visita();
        $sql   .= "WHERE
                    1=1
                    AND CASE WHEN  (vis.hora_salida ='00:00:00') THEN vis.hora_ingreso BETWEEN ('19:00:00') AND ('23:59:59') ELSE vis.hora_salida BETWEEN ('19:00:00') AND ('23:59:59')  END
                    AND vis.fecha BETWEEN '{$where_de}' AND '{$where_hasta}' {$where_sedes} {$where_areas}
                    GROUP BY vis.dni
                    ORDER BY per.nombres_apellidos";
                    //AND ((vis.hora_salida BETWEEN ('00:00:01') AND ('03:59:59')) OR  (vis.hora_salida BETWEEN ('19:00:00') AND ('23:59:59')))
        log_message("INFO","<<< OBTENER RANGO  ".$sql);
        $query  = $this->db->query($sql);
        return $query->result_array();
    }

    public function obtener_listado_visita($params=NULL){
        (isset($params['sedes']) && $params['sedes'] != NULL && $params['sedes']!='null') ? $where_sedes = " AND sed.id IN (".$params['sedes'].") " : $where_sedes = " ";
        (isset($params['areas']) && $params['areas'] != NULL && $params['areas']!='null') ? $where_areas = " AND are.id IN (".$params['areas'].") " : $where_areas = " ";
        (isset($params['fecha']) && $params['fecha'] != NULL) ? $where_fecha = convertirFecha($params['fecha'], 'Y-m-d') : $where_fecha = date('Y-m-d');

        $sql    = "SELECT
                    vis.dni,
                    vis.fecha,
                    MIN(vis.hora_ingreso) AS hora_ingreso,
                    (CASE WHEN MIN(vis.hora_salida)='00:00:00' THEN MAX(vis.hora_ingreso) ELSE MAX(vis.hora_salida) END ) AS hora_salida,
                    per.nombres_apellidos,
                    are.nombre AS nombre_area,
                    car.nombre AS nombre_cargo,
                    pro.nombre AS nombre_proyecto,
                    UPPER(pro.nombre_corto) AS nombre_corto_proyecto,
                    sed.nombre AS nombre_sede,
                    SUM(vis.estado) AS visitas ";
        $sql   .= $this->from_visita();
        $sql   .= " WHERE
                    1=1
                    AND vis.fecha='{$where_fecha}' {$where_sedes} {$where_areas}
                    GROUP BY vis.dni
                    ORDER BY per.nombres_apellidos ";

        log_message("INFO","<<< OBTENER LISTADO VISITA ".$sql);
        $query  = $this->db->query($sql);
        return $query->result_array();
    }

    public function obtener_listado_persona_visita($params=NULL){

        $sql    = $this->select_persona();
        $sql   .= ",vis.creado_por AS ingreso_en, vis.modificado_por AS salida_en";
        $sql   .= $this->from_visita();
        $sql   .= "WHERE
                    1=1
                    AND vis.fecha BETWEEN '".convertirFecha($params['fecha_de'], 'Y-m-d')."' AND '".convertirFecha($params['fecha_hasta'], 'Y-m-d')."'
                    AND vis.dni='".$params['dni']."'
                    ORDER BY per.nombres_apellidos";
        log_message("INFO","<<< OBTENER RANGO  ".$sql);
        $query  = $this->db->query($sql);
        return $query->result_array();
    }

    private function select_persona(){
        return " SELECT
                    vis.dni,
                    per.nombres_apellidos,
                    are.nombre AS nombre_area,
                    car.nombre AS nombre_cargo,
                    pro.nombre AS nombre_proyecto,
                    UPPER(pro.nombre_corto) AS nombre_corto_proyecto,
                    sed.nombre AS nombre_sede,
                    vis.fecha,
                    vis.hora_ingreso,
                    vis.hora_salida ";
    }

    private function from_visita(){
        return " FROM
                    tbl_visita AS vis
                    LEFT JOIN tbl_persona AS per ON vis.dni=per.dni
                    LEFT JOIN tbl_sede AS sed ON per.tbl_sede_id=sed.id
                    LEFT JOIN tbl_proyecto AS pro ON per.tbl_proyecto_id=pro.id
                    LEFT JOIN tbl_cargo AS car ON per.tbl_cargo_id=car.id
                    LEFT JOIN tbl_area AS are ON car.tbl_area_id=are.id ";
    }

}