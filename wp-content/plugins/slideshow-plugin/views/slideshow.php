<?php

$slides_ids = get_post_meta($post_id, 'slideshow_slides', true);
$width = get_post_meta($post_id, 'slideshow_width', true);
$height = get_post_meta($post_id, 'slideshow_height', true);
$duration = get_post_meta($post_id, 'slideshow_duration', true);
$slides_ids_array = explode(',', $slides_ids);

foreach($slides_ids_array AS $slide_id) {
$slides_string .= '<img id="image-preview" src="'.wp_get_attachment_url($slide_id).'" style="display: block;">';
}

return "<script src=".plugins_url()."/slideshow-plugin/js/jquery.slides.min.js\"></script><div id=\"slides\">
".$slides_string."
</div><script>
jQuery(function() {
    var width = $width;
    var height = $height;
    var duration = $duration;

    jQuery('#slides').slidesjs({
        width: width,
        height: height,
        play: {
            active: true,
            auto: true,
            interval: duration,
            swap: true
        }
    });
});
</script>";
