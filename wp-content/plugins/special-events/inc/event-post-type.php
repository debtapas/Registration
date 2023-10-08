<?php

	/*============================================
	        Create Event custom post type
	============================================*/
	function register_events_custom_post_type() {
	    $supports = array(
	        'title', // post title
	        'editor', // post content
	        'author', // post author
	        'thumbnail', // featured images
	        'excerpt', // post excerpt
	        'custom-fields', // custom fields
	        'comments', // post comments
	        'revisions', // post revisions
	        'post-formats', // post formats
	    );
	    $labels = array(
	        'name' => _x('Events', 'plural'),
	        'singular_name' => _x('Event', 'singular'),
	        'menu_name' => _x('Events', 'admin menu'),
	        'name_admin_bar' => _x('Event', 'admin bar'),
	        'add_new' => _x('Add New', 'add new'),
	        'add_new_item' => __('Add New events'),
	        'new_item' => __('New Event'),
	        'edit_item' => __('Edit Event'),
	        'view_item' => __('View Event'),
	        'all_items' => __('All Events'),
	        'search_items' => __('Search Events'),
	        'not_found' => __('No Events found.'),
	    );
	    $args = array(
	        'supports' => $supports,
	        'labels' => $labels,
	        'public' => true,
	        'query_var' => true,
	        'rewrite' => array('slug' => 'events'),
	        'show_in_rest'  =>  true,
	        'has_archive' => true,
	        'hierarchical' => false,
	    );
	    register_post_type('events', $args);	

	//Create a Table that will be executed when the plugin is activated --
	    global $wpdb;
	    $charset_collate = $wpdb->get_charset_collate();
	    $table_name = $wpdb->prefix . 'event_auth_key';

	    $sql = "CREATE TABLE $table_name (
		        id mediumint(9) NOT NULL AUTO_INCREMENT,
		        auth_key VARCHAR(100) NOT NULL,		        
		        PRIMARY KEY (id)
		    ) $charset_collate;";

	    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	    dbDelta($sql);    
	}

	add_action('init', 'register_events_custom_post_type');


	/*============================================
	   Deactivation / Post unregister Function
	============================================*/
	function unregister_events_custom_post_type(){
		unregister_post_type('events');


	//remove the custom table when the plugin is deactivated----
		global $wpdb;
	    $table_name = $wpdb->prefix . 'event_auth_key';
		$wpdb->query("DROP TABLE IF EXISTS $table_name");
	}