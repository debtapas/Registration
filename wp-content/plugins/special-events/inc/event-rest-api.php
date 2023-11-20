<?php

	//create the REST API endpoints for CRUD operations.

	function register_event_api_routes() {
	    register_rest_route('special-events/v1', '/all-events', array(
	        'methods'  => 'GET',
	        'callback' => 'get_events',
	    ));

	    register_rest_route('special-events/v1', '/event/(?P<id>\d+)', array(
	        'methods'  => 'GET',
	        'callback' => 'get_event',
	    ));

	    register_rest_route('special-events/v1', '/create-event', array(
	        'methods'  => 'POST',
	        'callback' => 'create_event',
	        'permission_callback' => 'create_rest_check_permission'
	    ));

	    register_rest_route('special-events/v1', '/update-event/(?P<id>\d+)', array(
	        'methods'  => 'POST',
	        'callback' => 'update_event',
	    ));

	    register_rest_route('special-events/v1', '/delete-event/(?P<id>\d+)', array(
	        'methods'  => 'DELETE',
	        'callback' => 'delete_event',
	    ));
	}

	add_action('rest_api_init', 'register_event_api_routes');


	/* ========================================
	      Get and show all the event posts
	======================================== */
	function get_events($request) {
	    $args = array(
	        'post_type' => 'event',
	        'posts_per_page' => -1,
	    );
	    $events = get_posts($args);
	    return $events;
	}


	/* ========================================
	         Create the new event post
	======================================== */
	function create_event($request){
		$params = $request->get_params();
		$title = $params['title'];
    	$content = $params['content'];
    	$terms_array = explode(',', sanitize_text_field($params['categories']));
    	

		$args = array(
			'post_title' 	=> $title,
			'post_content'	=> $content,
			'post_type'		=> 'events',
			'post_status'	=> 'publish'
		);
		$post_id = wp_insert_post($args);
				
    		
			foreach( $terms_array as $term){
				$term_id = term_exists( $term, 'events_tax' );

				if (empty($term_id)) {
					$term_id = wp_insert_term( $term, 'events_tax' );
				}

    			// Assign the category to the custom post
			    if (!is_wp_error($term_id) && !has_term($term_id['term_id'], 'events_tax', $post_id)) {
			        wp_set_post_terms($post_id, $term_id['term_id'], 'events_tax', true);
				    }
		    	}
    	if ($post_id) {
    			echo 'Post Create successfully';
    		}else{
    			echo 'Post is unable to create';
    		}
	}

	// Permission callback to check if the user has the necessary permissions
	function create_rest_check_permission($request){
		$authkey 	= $request->get_param('authkey');	
		$option_auth_value = get_option('auth_key_option_value');

		if($option_auth_value == $authkey) {
			return true;
	    } else {
	        return new WP_Error('rest_forbidden', __('You do not have permission to access this resource.'), array('status' => 403));
	    }
	}

	/* ========================================
	            Delete the event post
	======================================== */
	function delete_event($request){
		$post_id = $request->get_param('id');

		//check if post id is valid--
		if( !$post_id || !get_post($post_id) ){
			return new WP_Error('invalid_post_id', 'Invalid post ID', array('status' => 400));
		}

		$deleted = wp_delete_post($post_id, true);

		if ($deleted) {
	        	return array('message' => 'Post deleted successfully');
		    } else {
		        return new WP_Error('delete_failed', 'Failed to delete the post', array('status' => 500));
		    }
	}

	/* ========================================
	             Update the event post
	======================================== */
	function update_event($request){
		$post_id = $request->get_param('id');

		//Check post id is valid -----
			if( !empty($post_id) && is_numeric($post_id) ){
				$title 		= $request->get_param('title');
				$content 	= $request->get_param('content');

			//Update the Post -----
			$updated_post = array(
				'ID'			=>	$post_id,
				'post_title'	=>	$title,
				'post_content'	=>	$content
			);

			$updated_post_id = wp_update_post($updated_post, true);

			if(is_wp_error($updated_post_id)){
				return new WP_Error('update_error', $updated_post_id->get_error_message(), array('status' => 500));
			}else{
				return array('message' => 'Post updated successfully.');
			}

		}else{
			return new WP_Error('invalid_post_id', 'Invalid post ID.', array('status' => 400));
		}

	}