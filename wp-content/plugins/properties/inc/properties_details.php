<?php

	//Add shortcode for details and sing page ~~~~~~~~~~
	function prop_details_list_func($atts){
		$atts = shortcode_atts(
	        array(
	        	'source'	=> '0',
	        	'minprice'	=> '50000',
	        	'status'	=> 'ACT,NEW;awtn:NWTN',
	        	'pagesize'	=> '10'
	        ),
	        $atts, 'pro_archive' 
	    );

	    $crit 		= $atts['source'];
	    $minprice	= $atts['minprice'];
	    $status		= $atts['status'];
	    $pagesize	= $atts['pagesize'];


	$url = "http://stephen.grumpy.nimbusworx.net/api/mls/advSearchWoCnt?crit=asrc:$crit;pmin:$minprice;asts:$status&sidx=0&ps=$pagesize";

    $response = wp_remote_get( $url, array(
            'headers' => array(
            'Authorization' => 'consumer_key=0',
            )
         )
      );
    $responseBody = wp_remote_retrieve_body($response);
    $results = json_decode( $responseBody, true);
		
	       if(isset($_GET['page-id'])){      
		      //Include Properties listing page ~~~~~~~~~~~~
		      require PROP_PLUGIN_DIR . 'inc/single.php';      

		    }else{      
		      //Include Properties listing page ~~~~~~~~~~~~
		      require PROP_PLUGIN_DIR . 'inc/archive.php';

		    }
	}
	add_shortcode('pro_archive', 'prop_details_list_func');



	//Redirect to template file ~~~~~~~~~~~
	function properties_template($template) {
	    if (is_page('properties-page')) {
	        $template = PROP_PLUGIN_DIR . 'inc/properties-listing.php';
	    }
	    return $template;
	}
	add_filter('template_include', 'properties_template');


	//Activation Hook ~~~~~~~~~~~~~~~
	function register_properties_details() {
		$page_exist_id = get_page_by_path( 'properties-page' );

			if ( empty($page_exist_id) ) {
				$page_id = wp_insert_post(array(
		        'post_title'    => 'Properties Page',
		        'post_content'  => '[pro_archive]',
		        'post_status'   => 'publish',
		        'post_type'     => 'page',
		        'post_name'		=> 'properties-page'
		    ));
		}    
	}

	//Deactivation Hook ~~~~~~~~~~~~~~~
	function unregister_properties_details() {
		$page_exist_id = get_page_by_path( 'properties-page' );

	    if ($page_exist_id->ID) {
	        wp_delete_post($page_exist_id->ID, true);
	    }
	}