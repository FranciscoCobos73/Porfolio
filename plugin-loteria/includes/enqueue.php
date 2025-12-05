<?php
// Evita el acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Cargar estilos CSS en el frontend
 */
function mi_plugin_personalizado_cargar_estilos() {
    wp_enqueue_style(
        'mi-plugin-personalizado-estilos',
        plugin_dir_url(__FILE__) . '../assets/css/estilos.css'
    );
}
add_action('wp_enqueue_scripts', 'mi_plugin_personalizado_cargar_estilos');

/**
 * Cargar estilos y scripts en la administración
 */
function mi_plugin_personalizado_admin_scripts($hook) {
    if ($hook !== 'toplevel_page_plugin-loteria') {
        return;
    }

    // Estilos en el panel de administración
    wp_enqueue_style(
        'mi-plugin-personalizado-admin-estilos',
        plugin_dir_url(__FILE__) . '../assets/css/estilos.css'
    );

    // Scripts en el panel de administración
    wp_enqueue_script(
        'mi-plugin-personalizado-admin-scripts',
        plugin_dir_url(__FILE__) . '../assets/js/mi-script.js',
        array('jquery'),
        null,
        true
    );

    // Biblioteca de medios de WordPress
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'mi_plugin_personalizado_admin_scripts');

/**
 * Cargar el script del contador en el frontend y pasar datos desde PHP a JS
 */
function mi_plugin_personalizado_scripts() {
    global $wpdb;
    $tabla = $wpdb->prefix . 'mi_plugin_personalizado_juegos';

    // Obtener los juegos activos
    $juegos = $wpdb->get_results("SELECT id, fecha_sorteo FROM $tabla", ARRAY_A);

    // Registrar el script del contador
    wp_enqueue_script(
        'mi-plugin-contador',
        plugin_dir_url(__FILE__) . '../assets/js/contador.js',
        array('jquery'),
        null,
        true
    );

    // Pasar datos al script
    wp_localize_script('mi-plugin-contador', 'miPluginPersonalizadoJuegos', $juegos);
}
add_action('wp_enqueue_scripts', 'mi_plugin_personalizado_scripts');

function mi_plugin_cargar_estilos_y_scripts() {
    // Incluir el CSS de Owl Carousel
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');

    // Incluir el JS de Owl Carousel
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), null, true);

    // Incluir el script personalizado para inicializar el carrusel
    wp_enqueue_script('mi-plugin-carousel-js', plugin_dir_url(__FILE__) . '../assets/js/carrusel.js', array('jquery', 'owl-carousel-js'), null, true);
}
add_action('wp_enqueue_scripts', 'mi_plugin_cargar_estilos_y_scripts');
