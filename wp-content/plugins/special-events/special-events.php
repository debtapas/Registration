<?php

	//if this file is called directly, abort
	if (!defined('WPINC')) {
		die;
	}

	/**
	 * Plugin Name:       Special Events
	 * Plugin URI:        https:www.special-events.com
	 * Description:       Handle the basics with this plugin.
	 * Version:           1.0.0
	 * Requires at least: 5.2
	 * Requires PHP:      7.2
	 * Author:            Tapas Deb
	 * Author URI:        https://github.com/debtapas/special-events
	 * License:           GPL
	 * Text-domain:		  SpecianEvents
	 */

	if (!defined(('WPSE_PLUGIN_VERSION'))) {
		define('WPSE_PLUGIN_VERSION', '1.0.0');
	}

	if (!defined(('WPSE_PLUGIN_DIR'))) {
		define('WPSE_PLUGIN_DIR', plugin_dir_url(__FILE__)); // Plugin file path		
		//define('WPSE_PLUGIN_DIR', plugin_dir_path( __FILE__ )); // url	
	}
	

	//Activation and Deactivation Hooks~~~~~~
	register_activation_hook(__FILE__, 'register_events_custom_post_type');
	register_deactivation_hook(__FILE__, 'unregister_events_custom_post_type');


	//Associate the Events single page Template ~~~~~~~~~~~~
	function custom_events_single_template($single_template) {
	    global $post;

	    if ($post->post_type == 'events') {
	        $single_template = plugin_dir_path(__FILE__) . 'single-events.php';
	    }
	    return $single_template;
	}
	add_filter('single_template', 'custom_events_single_template');


	//Associate the plug Events Archive page Template ~~~~~~~~~~~~
	function custom_post_type_archive_template($template) {
	    if (is_post_type_archive('events')) {
	        $template = plugin_dir_path(__FILE__) . 'archive-events.php';
	    }
	    return $template;
	}
	add_filter('template_include', 'custom_post_type_archive_template');



	//Adding CSS and JS files ~~~~~~~~~~~~~~~~
	if (!function_exists('wpse_plugin_scripts')) {
		function wpse_plugin_scripts(){

			//plugin Frontend CSS
			wp_enqueue_style('wpse-css', WPSE_PLUGIN_DIR . 'assets/css/events-plugin-style.css');

			//Plugin Frontend JS
			wp_enqueue_script('wpse-js', WPSE_PLUGIN_DIR . 'assets/js/events-main.js', "jquery", '1.0.0', true); // true -- add in footer section
		}
		add_action('wp_enqueue_scripts', 'wpse_plugin_scripts');
	}



	//Register a custom post type for special events
	require plugin_dir_path(__FILE__). 'inc/event-post-type.php';

	//Create the REST API endpoints for CRUD operations
	require plugin_dir_path(__FILE__). 'inc/event-rest-api.php';