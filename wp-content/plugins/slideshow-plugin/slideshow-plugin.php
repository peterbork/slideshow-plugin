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
		
		include 'views/slideshow.php';
		
		return $slideshow;
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
		include_once 'js/media-selector.php';
		wp_enqueue_media();
	}
	
	public function widget($args, $instance) {
		$post_id = $instance[ 'title' ];
		echo $args[ 'before_widget' ];
		include 'views/slideshow.php';
		echo $slideshow;
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
