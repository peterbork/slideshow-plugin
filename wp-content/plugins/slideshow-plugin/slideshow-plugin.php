<?php

/*
  * Plugin Name: Slideshow Plugin
  * Description: A slideshow plugin, that can be used from both shortcode and widget
  * Author: Peter Bork
  * Version: 0.1
  */

class SlideshowPlugin {
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
	}
	
	public function set_cpt_slideshows() {
		register_post_type('slideshow', [
			'label'    => 'Slideshows',
			'public'   => true,
			'supports' => [
				'title',
				'editor',
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
		//$slides   = get_post_meta($data->ID, 'slideshow_slides', true);
		require_once 'views/slideshow-fields.php';
	}
	
	public function save_custom_post_type($post_id) {
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
	}
	
}

new SlideshowPlugin();
