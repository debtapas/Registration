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

	//Create a CPT Taxonomy when the plugin is activated ~~~~~~~~~~~
	    $labels = array(
	    	'name'              => _x( 'Events', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Event', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Events', 'textdomain' ),
			'all_items'         => __( 'All Events', 'textdomain' ),
			'view_item'         => __( 'View Event', 'textdomain' ),
			'parent_item'       => __( 'Parent Event', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Event:', 'textdomain' ),
			'edit_item'         => __( 'Edit Event', 'textdomain' ),
			'update_item'       => __( 'Update Event', 'textdomain' ),
			'add_new_item'      => __( 'Add New Event', 'textdomain' ),
			'new_item_name'     => __( 'New Event Name', 'textdomain' ),
			'not_found'         => __( 'No Events Found', 'textdomain' ),
			'back_to_items'     => __( 'Back to Events', 'textdomain' ),
			'menu_name'         => __( 'Event Category', 'textdomain' ),
	    );

	    $args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'event' ),
			'show_in_rest'      => true,
	    );

	    register_taxonomy('events_tax', 'events', $args);

	//Register a Setting Menu page that will be executed when the plugin is activated ~~~~~~~~~~~
	   	function register_events_setting_menu_page(){
			add_menu_page( 
				//'edit.php?post_type=events',// Parent menu slug
				('Event Setting'), 			// String $page_title
				'API Permission', 			// String $menu_title
				'manage_options', 			// String $capability
				'event_post_permission', 	// String $menu_slug
				'event_api_permission', 	// Callable $callback = ''
				//plugins_url( 'myplugin/images/icon.png' ), //string $icon_url = ''
				6 							//int|float $position = null
			); 
		}
		add_action( 'admin_menu', 'register_events_setting_menu_page' );

		//Create a Table that will be executed when the plugin is activated ~~~~~~~~~~~
	    global $wpdb;
	    $charset_collate = $wpdb->get_charset_collate();
	    $auth_key_tb = $wpdb->prefix . 'event_auth_key';

	    $sql = "CREATE TABLE $auth_key_tb (
		        id mediumint(9) NOT NULL AUTO_INCREMENT,
		        auth_key VARCHAR(100) NOT NULL,		        
		        PRIMARY KEY (id)
		    ) $charset_collate;";

	    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	    dbDelta($sql);    

		function event_api_permission(){
			$option_auth_value = get_option('auth_key_option_value') ? get_option('auth_key_option_value') : '';
			
			echo "<div class='api-field'>
			<h3>Generate a API Key</h3>
			<form method='POST'>
			<label>Event API authentication key</label>
			<input name='auth_key_value' type='text' value='".$option_auth_value."' placeholder=''>
			<input name='btn_auth_key' value='Submit' type='submit'>
			</div>";

	    	if (isset($_POST['btn_auth_key'])) {
	    		$auth_key_value = isset($_POST['auth_key_value']) ? $_POST['auth_key_value'] : '';
	    		update_option('auth_key_option_value', $auth_key_value);

	    		// $wpdb->insert( $auth_key_tb, array("auth_key" => $auth_key_value) );
	    	}
			
		}


	
	}

	add_action('init', 'register_events_custom_post_type');


	/*============================================
	   Deactivation / Post unregister Function
	============================================*/
	function unregister_events_custom_post_type(){
		unregister_post_type('events');
		unregister_taxonomy('events_tax');


	//remove the custom table when the plugin is deactivated----
		global $wpdb;
	    $table_name = $wpdb->prefix . 'event_auth_key';
		$wpdb->query("DROP TABLE IF EXISTS $table_name");
	}