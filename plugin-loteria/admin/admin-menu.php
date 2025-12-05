<?php
if (!defined('ABSPATH')) {
    exit;
}

function mi_plugin_agregar_menu() {
    add_menu_page(
        'Juegos Activos',
        'Plugin Lotería',
        'manage_options',
        'plugin-loteria',
        function () {
            require_once plugin_dir_path(__FILE__) . 'admin-page.php';
        },
        'dashicons-games',
        20
    );
}

add_action('admin_menu', 'mi_plugin_agregar_menu');