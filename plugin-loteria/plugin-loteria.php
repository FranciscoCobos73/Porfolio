<?php
/*
Plugin Name: Plugin Loteria V 2.0
Description: Plugin para gestionar juegos activos y sus botes.
Version: 1.0
Author: Fran
*/

/**
 * Definimos la constante `MI_PLUGIN_DIR` que almacena la ruta absoluta
 * del directorio del plugin. Esto facilita la inclusión de archivos sin
 * necesidad de escribir la ruta completa en cada `require_once`.
 */
define('MI_PLUGIN_DIR', plugin_dir_path(__FILE__));

/**
 * Incluimos varios archivos que contienen diferentes funcionalidades del plugin.
 * Esto ayuda a mantener el código modular y organizado.
 */

// Archivo que se encarga de encolar (agregar) los estilos CSS y scripts JS necesarios.
require_once MI_PLUGIN_DIR . 'includes/enqueue.php';

// Archivo que maneja la creación y manipulación de la base de datos del plugin.
require_once MI_PLUGIN_DIR . 'includes/database.php';

// Archivo que agrega un menú en el panel de administración de WordPress.
require_once MI_PLUGIN_DIR . 'admin/admin-menu.php';

// Archivo que define el shortcode para mostrar los juegos en el frontend.
require_once MI_PLUGIN_DIR . 'includes/shortcode.php';
