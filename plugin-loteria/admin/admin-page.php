<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'game-handler.php';
$handler = new MiPluginPersonalizado_Handler();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_juego'])) {
    $datos = [
        'id'           => $_POST['id_juego'] ?? null,
        'nombre'       => sanitize_text_field($_POST['nombre_juego']),
        'bote'         => floatval($_POST['bote_juego']),
        'imagen'       => esc_url_raw($_POST['imagen_juego']),
        'fecha_sorteo' => sanitize_text_field($_POST['fecha_sorteo']),
        'enlace'       => esc_url_raw($_POST['enlace_juego']),
        'texto_boton'  => sanitize_text_field($_POST['texto_boton'])
    ];
    $handler->guardar_juego($datos);
    wp_safe_redirect(admin_url('admin.php?page=plugin-loteria'));
    exit;
}

if (!empty($_GET['delete'])) {
    $handler->eliminar_juego($_GET['delete']);
    wp_safe_redirect(admin_url('admin.php?page=plugin-loteria'));
    exit;
}

$juego = (!empty($_GET['edit'])) ? $handler->obtener_juego($_GET['edit']) : null;
$juegos = $handler->obtener_juegos();

?>

<div class="wrap">
    <h1><?php echo $juego ? 'Editar Juego' : 'Configuración de Juegos Activos'; ?></h1>
    <form method="post">
        <?php if ($juego): ?>
            <input type="hidden" name="id_juego" value="<?php echo esc_attr($juego->id); ?>">
        <?php endif; ?>
        <table class="form-table">
            <tr>
                <th>Nombre del Juego</th>
                <td><input type="text" name="nombre_juego" value="<?php echo esc_attr($juego->nombre ?? ''); ?>"></td>
            </tr>
            <tr>
                <th>Bote</th>
                <td><input type="number" name="bote_juego" value="<?php echo esc_attr($juego->bote ?? ''); ?>" step="0.01"></td>
            </tr>
            <tr>
                <th>Imagen del Juego</th>
                <td>
                    <input type="text" id="mi_plugin_imagen" name="imagen_juego" value="<?php echo esc_attr($juego->imagen ?? ''); ?>">
                    <button type="button" class="button seleccionar-imagen">Seleccionar Imagen</button>
                    <br><br>
                    <img id="mi_plugin_imagen_preview" src="<?php echo esc_url($juego->imagen ?? ''); ?>" style="max-width: 150px; height: auto; <?php echo ($juego && $juego->imagen) ? '' : 'display:none;'; ?>">
                </td>
            </tr>
            <tr>
                <th>Fecha del Sorteo</th>
                <td><input type="datetime-local" name="fecha_sorteo" value="<?php echo esc_attr($juego->fecha_sorteo ?? ''); ?>"></td>
            </tr>
            <tr>
                <th>Enlace del Juego</th>
                <td><input type="url" name="enlace_juego" value="<?php echo esc_url($juego->enlace ?? ''); ?>"></td>
            </tr>
            <tr>
                <th>Texto del Botón</th>
                <td><input type="text" name="texto_boton" value="<?php echo esc_attr($juego->texto_boton ?? 'Jugar'); ?>"></td>
            </tr>
        </table>
        <?php submit_button($juego ? 'Actualizar Juego' : 'Agregar Juego'); ?>
    </form>

    <h2>Juegos Activos</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Juego</th>
                <th>Bote</th>
                <th>Imagen</th>
                <th>Fecha Sorteo</th>
                <th>Enlace</th>
                <th>Texto Botón</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($juegos as $juego) : ?>
                <tr>
                    <td><?php echo esc_html($juego->nombre); ?></td>
                    <td><?php echo esc_html($juego->bote); ?> €</td>
                    <td><?php if (!empty($juego->imagen)) : ?><img src="<?php echo esc_url($juego->imagen); ?>" style="max-width: 100px;"><?php endif; ?></td>
                    <td><?php echo esc_html($juego->fecha_sorteo); ?></td>
                    <td><?php if (!empty($juego->enlace)) : ?><a href="<?php echo esc_url($juego->enlace); ?>" target="_blank"><?php echo esc_html($juego->enlace); ?></a><?php else: ?><em>Sin enlace</em><?php endif; ?></td>
                    <td><?php echo esc_html($juego->texto_boton); ?></td>
                    <td>
                        <a href="?page=plugin-loteria&edit=<?php echo $juego->id; ?>">Editar</a> |
                        <a href="?page=plugin-loteria&delete=<?php echo $juego->id; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
