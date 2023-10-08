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
	    ));

	    register_rest_route('special-events/v1', '/update-event/(?P<id>\d+)', array(
	        'methods'  => 'POST',
	        'callback' => 'update_event',
	        // 'permission_callback' => 'rest_check_permission'
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
		$title = $request->get_param( 'title' );
    	$content = $request->get_param( 'content' );

		$title = $request->get_param('title');
		$content = $request->get_param('content');
		$args = array(
			'post_title' 	=> $title,
			'post_content'	=> $content,
			'post_type'		=> 'events',
			'post_status'	=> 'publish'
		);

		$post_id = wp_insert_post($args);

		if(is_wp_error($post_id)){
			return new WP_REST_Response( array( 'error' => 'Could not create post' ), 500 );
		}else{
			return new WP_REST_Response( array( 'message' => 'Post created successfully', 'post_id' => $post_id ), 200 );
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

	// Permission callback to check if the user has the necessary permissions
	// function rest_check_permission(){
	// 	return current_user_can('edit_posts');
	// }