<script type='text/javascript'>
    jQuery(document).ready(function ($) {
        var file_frame;
        // I know this is wrong ...
        var wp_media_post_id = wp.media.model.settings.post.id;
        var set_to_post_id = jQuery('input[name="slideshow_slides"]').val();
        
        jQuery('#upload_image_button').on('click', function (event) {
            event.preventDefault();
            if (file_frame !== undefined) {
                file_frame.uploader.uploader.param('post_id', set_to_post_id);
                file_frame.open();
                return;
            } else {
                wp.media.model.settings.post.id = set_to_post_id;
            }
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select a image to upload',
                button: {
                    text: 'Use this image'
                },
                multiple: true
            });
            file_frame.on('select', function () {
                attachment = file_frame.state().get('selection').toJSON();
                var array = [];
                attachment.forEach(function (item) {
                    //$( '#image-preview' ).attr( 'src', item.url ).css( 'width', 'auto' );
                    $('.image-preview-wrapper').append('<img src="' + item.url + '" style="height: 100px;width: auto;">');
                    array.push(item.id)
                });
                $('#slideshow_slides').val(array.toString());
            });
            file_frame.open();
        });
        jQuery('a.add_media').on('click', function () {
            wp.media.model.settings.post.id = wp_media_post_id;
        });
    });
</script>
