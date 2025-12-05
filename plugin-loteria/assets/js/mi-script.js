jQuery(document).ready(function($) {
    function openMediaUploader(targetInput, targetPreview) {
        let mediaUploader;
        targetInput.next('button').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media({
                title: 'Seleccionar Imagen',
                button: { text: 'Usar esta imagen' },
                multiple: false
            });
            mediaUploader.on('select', function() {
                let attachment = mediaUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                targetPreview.attr('src', attachment.url).show();
            });
            mediaUploader.open();
        });
    }
    openMediaUploader($('#mi_plugin_imagen'), $('#mi_plugin_imagen_preview'));
});
