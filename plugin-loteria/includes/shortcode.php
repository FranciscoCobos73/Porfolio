<?php
// Evita el acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Función que genera el contenido del shortcode [mi_plugin_personalizado_juegos].
 */
/**
 * Función que genera el contenido del shortcode [mi_plugin_personalizado_juegos].
 */
function mi_plugin_personalizado_shortcode() {
    global $wpdb;
    $tabla = $wpdb->prefix . 'mi_plugin_personalizado_juegos';
    $juegos = $wpdb->get_results("SELECT * FROM $tabla");

    if (empty($juegos)) {
        return '<p class="mi-plugin-mensaje">No hay juegos activos disponibles.</p>';
    }

    $output = '<div class="owl-carousel mi-plugin-juegos-container">';
    $juegos_data = [];

    foreach ($juegos as $juego) {
        $output .= '<div class="mi-plugin-juego">';

        // Imagen del juego
        if (!empty($juego->imagen)) {
            $output .= '<img src="' . esc_url($juego->imagen) . '" alt="' . esc_attr($juego->nombre) . '" class="mi-plugin-imagen">';
        }

        // Nombre del juego
        if (!empty($juego->nombre)) {
            $output .= '<h3 class="mi-plugin-nombre">' . esc_html($juego->nombre) . '</h3>';
        }

        // Bote (mostrar solo si es mayor a 0)
        if (!empty($juego->bote) && $juego->bote > 0) {
            $output .= '<p class="mi-plugin-bote">' . mi_plugin_formatear_bote($juego->bote) . '</p>';
        } else {
            $output .= '<p class="mi-plugin-bote-sin">Sin Bote</p>';
        }

        // Contador de tiempo (manteniendo los estilos)
        if (!empty($juego->fecha_sorteo)) {
            $fecha_sorteo_iso = date('c', strtotime($juego->fecha_sorteo));
            $output .= '<div id="contador-' . esc_attr($juego->id) . '" class="mi-plugin-contador">Cargando...</div>';
            $juegos_data[] = [
                'id' => $juego->id,
                'fecha_sorteo' => $fecha_sorteo_iso
            ];
        }

        // Botón de jugar
        if (!empty($juego->enlace)) {
            $texto_boton = !empty($juego->texto_boton) ? esc_html($juego->texto_boton) : 'Jugar';
            $output .= '<a href="' . esc_url($juego->enlace) . '" class="mi-plugin-boton-redirigir" target="_blank">' . $texto_boton . '</a>';
        }

        $output .= '</div>'; // Cierra mi-plugin-juego
    }

    $output .= '</div>'; // Cierra el carrusel

    // Pasar los datos al JavaScript
    wp_enqueue_script('mi-plugin-contador', plugin_dir_url(__FILE__) . 'contador.js', ['jquery'], null, true);
    wp_localize_script('mi-plugin-contador', 'miPluginJuegos', ['juegos' => $juegos_data]);

    return $output;
}

// Función para formatear el bote con estilos personalizados
function mi_plugin_formatear_bote($bote) {
    if ($bote >= 1000000) {
        // Convertir a millones con un decimal (ejemplo: 53.2 Mill.)
        $cantidad = number_format($bote / 1000000, 1, '.', '');
        return '<span class="bote-cantidad">' . esc_html($cantidad) . '</span> <span class="bote-millones">Mill.</span>';
    } else {
        // Mostrar el número completo con puntos como separadores de miles (ejemplo: 60.000€)
        $cantidad = number_format($bote, 0, '', '.'); // Formato: 60.000€
        return '<span class="bote-cantidad">' . esc_html($cantidad) . '</span> <span class="bote-millones">€</span>';
    }
}

// Registrar el shortcode
add_shortcode('mi_plugin_personalizado_juegos', 'mi_plugin_personalizado_shortcode');
