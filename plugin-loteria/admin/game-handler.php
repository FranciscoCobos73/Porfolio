<?php
if (!defined('ABSPATH')) {
    exit;
}

class MiPluginPersonalizado_Handler {
    private $tabla;

    public function __construct() {
        global $wpdb;
        $this->tabla = $wpdb->prefix . 'mi_plugin_personalizado_juegos';
    }

    public function guardar_juego($datos) {
        global $wpdb;
        if (!empty($datos['id'])) {
            return $wpdb->update($this->tabla, $datos, ['id' => intval($datos['id'])]);
        } else {
            return $wpdb->insert($this->tabla, $datos);
        }
    }

    public function eliminar_juego($id) {
        global $wpdb;
        return $wpdb->delete($this->tabla, ['id' => intval($id)]);
    }

    public function obtener_juego($id) {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM $this->tabla WHERE id = " . intval($id));
    }

    public function obtener_juegos() {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM $this->tabla");
    }
}

