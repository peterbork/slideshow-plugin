<?php

/*
  * Plugin Name: Slideshow Plugin
  * Description: A slideshow plugin, that can be used from both shortcode and widget
  * Author: Peter Bork
  * Version: 0.1
  */

class SlideshowPlugin extends WP_Widget {
	public function __construct() {
		add_action('init', [
			$this,
			'set_cpt_slideshows'
		]);
		add_action('add_meta_boxes', [
			$this,
			'set_meta_boxes'
		]);
		add_action('save_post', [
			$this,
			'save_custom_post_type'
		]);
		add_action('admin_footer', [
			$this,
			'media_selector_print_scripts'
		]);
		add_shortcode('slideshow', [
			$this,
			'sc_slideshow'
		]);
		
		$id = 'slideshow';
		$title = 'Slideshow';
		$args = [
			'description' => 'Slide',
			'classname'   => 'slideshow_widget'
		];
		parent::__construct($id, $title, $args);
		add_action('widgets_init', function() {
			register_widget('SlideshowPlugin');
		});
	}
	
	public function sc_slideshow($atts) {
		$a = shortcode_atts([
			'id' => 'default',
		], $atts);
		$post_id = $a[ 'id' ];
		
		$slides_ids = get_post_meta($post_id, 'slideshow_slides', true);
		$width = get_post_meta($post_id, 'slideshow_width', true);
		$height = get_post_meta($post_id, 'slideshow_height', true);
		$duration = get_post_meta($post_id, 'slideshow_duration', true);
		$slides_ids_array = explode(',', $slides_ids);
		$slides_string = "";
		foreach($slides_ids_array AS $slide_id) {
			$slides_string .= '<img id="image-preview" src="'.wp_get_attachment_url($slide_id).'" style="display: block;">';
		}
		// todo: move to separate file
        // todo: include slides.min.js in wp footer scripts
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
                    active: false,
                    auto: true,
                    interval: duration,
                    swap: true
                },
                navigation: {
                    active: false
                },
                pagination: {
                    active: false
                }
            });
        });
        </script>";
	}
	
	public function set_cpt_slideshows() {
		register_post_type('slideshow', [
			'label'    => 'Slideshows',
			'public'   => true,
			'supports' => [
				'title',
				//'editor',
				'author'
			]
		]);
	}
	
	public function set_meta_boxes() {
		add_meta_box('slideshow_fields', 'Slideshow Fields', [
			$this,
			'set_data_view'
		], 'slideshow', 'advanced', 'default');
	}
	
	public function set_data_view($data) {
		$width = get_post_meta($data->ID, 'slideshow_width', true);
		$height = get_post_meta($data->ID, 'slideshow_height', true);
		$duration = get_post_meta($data->ID, 'slideshow_duration', true);
		$slides = get_post_meta($data->ID, 'slideshow_slides', true);
		require_once 'views/slideshow-fields.php';
	}
	
	public function save_custom_post_type($post_id) {
		if($_POST) {
			/*var_dump($_POST);
			die();*/
		}
		if(!isset($_POST[ 'slideshow_width' ]) && !empty($_POST[ 'slideshow_width' ])) {
			return;
		}
		else {
			update_post_meta($post_id, 'slideshow_width', esc_html($_POST[ 'slideshow_width' ]));
		}
		
		if(!isset($_POST[ 'slideshow_height' ]) && !empty($_POST[ 'slideshow_height' ])) {
			return;
		}
		else {
			update_post_meta($post_id, 'slideshow_height', esc_html($_POST[ 'slideshow_height' ]));
		}
		
		if(!isset($_POST[ 'slideshow_duration' ]) && !empty($_POST[ 'slideshow_duration' ])) {
			return;
		}
		else {
			update_post_meta($post_id, 'slideshow_duration', esc_html($_POST[ 'slideshow_duration' ]));
		}
		if(!isset($_POST[ 'slideshow_duration' ]) && !empty($_POST[ 'slideshow_duration' ])) {
			return;
		}
		else {
			update_post_meta($post_id, 'slideshow_duration', esc_html($_POST[ 'slideshow_duration' ]));
		}
		if(!isset($_POST[ 'slideshow_slides' ]) && !empty($_POST[ 'slideshow_slides' ])) {
			return;
		}
		else {
			update_post_meta($post_id, 'slideshow_slides', $_POST[ 'slideshow_slides' ]);
		}
		wp_enqueue_media();
	}
	
	function media_selector_print_scripts() {
		
		?>
        <script type='text/javascript'>
            jQuery(document).ready(function ($) {
                var file_frame;
                // I know this is wrong ...
                var set_to_post_id =  wp.media.model.settings.post.id;
                var wp_media_post_id = wp.media.model.settings.post.id;
                console.log(wp_media_post_id);
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
        </script><?php
		wp_enqueue_media();
	}
	
	public function widget($args, $instance) {
		$post_id = $instance[ 'title' ];
		
		$slides_ids = get_post_meta($post_id, 'slideshow_slides', true);
		$width = get_post_meta($post_id, 'slideshow_width', true);
		$height = get_post_meta($post_id, 'slideshow_height', true);
		$duration = get_post_meta($post_id, 'slideshow_duration', true);
		$slides_ids_array = explode(',', $slides_ids);
		$slides_string = "";
		foreach($slides_ids_array AS $slide_id) {
			$slides_string .= '<img id="image-preview" src="'.wp_get_attachment_url($slide_id). '" data-title="'.wp_get_attachment_caption($slide_id).'" style="display: block;">';
		}
		// todo: move to separate file
        // todo: include slides.min.js in wp footer scripts
        
		$slideshow_string = "<script src=".plugins_url('/slideshow-plugin/js')."/jquery.slides.min.js\"></script><div id=\"slides\">
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
                    active: false,
                    auto: true,
                    interval: duration,
                    swap: true
                },
                navigation: {
                    active: false
                },
                pagination: {
                    active: false
                }
            });
        });
        </script>";
		
		echo $args[ 'before_widget' ];
		echo $slideshow_string;
		echo $args[ 'after_widget' ];
	}
	
	public function form($instance) {
	    // todo: change title to slideshow_id
		$title = (!empty($instance[ 'title' ]) ? $instance[ 'title' ] : 'id');
		
		?>
        <div>
            <p>Slideshow ID:</p>
            <input type="text" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $title; ?>"
                   title="title">
        </div>
		<?php
	}
	
	public function update($new_instance, $old_instance) {
		$instance = [];
		$instance[ 'title' ] = $new_instance[ 'title' ];
		
		return $instance;
	}
	
}

new SlideshowPlugin();
