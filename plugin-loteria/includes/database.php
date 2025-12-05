<?php
// Evita el acceso directo al archivo para mayor seguridad
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Función que gestiona la creación de la tabla y la adición de columnas necesarias.
 * Se ejecuta cuando el plugin se activa.
 */
function mi_plugin_personalizado_instalar() {
    global $wpdb;
    $tabla = $wpdb->prefix . 'mi_plugin_personalizado_juegos';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $tabla (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(255) NOT NULL,
        bote float DEFAULT 0 NOT NULL,
        imagen varchar(255) DEFAULT '' NOT NULL,
        fecha_sorteo DATETIME NOT NULL,
        enlace varchar(255) DEFAULT '' NOT NULL,
        texto_boton varchar(255) DEFAULT 'Jugar' NOT NULL, -- Nueva columna para personalizar el botón
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Registra la función para ejecutarse al activar el plugin
register_activation_hook(__FILE__, 'mi_plugin_personalizado_instalar');