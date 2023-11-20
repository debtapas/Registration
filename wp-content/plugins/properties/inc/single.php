<?php

	$prop_page_id = $_GET['page-id'];
  $single_url = "http://stephen.grumpy.nimbusworx.net/api/mls/anonget?id=$prop_page_id";

  $prop_response = wp_remote_get( $single_url, array(
            'headers' => array(
            'Authorization' => 'consumer_key=0',
            )
         )
      );
  $prop_responseBody = wp_remote_retrieve_body($prop_response);
  $prop_get_results = json_decode( $prop_responseBody, true);    

  if ( is_wp_error( $prop_get_results ) ) {

         $error_message = $result->get_error_message();
         echo "Something went wrong: $error_message";

      } else {

        $prop_results = $prop_get_results['result']['property'];
        $default_img_url = PROP_PLUGIN_URL . 'assets/images/img_1_sq.jpg';
        $img_url_arr = [];

        if(isset($prop_results['photoList'])){
           $img_list = $prop_results['photoList'];
           $img_url_arr = wp_list_pluck( $img_list, 'imgurl');
        } ?>
      <section class="section">
        <div class="container">
          <div class="row blog-entries element-animate">
            <div class="col-md-12 col-lg-12 main-content">
              <div class="post-content-body">
                <div class="row my-4">
                      <div class="col-md-12 mb-4">                        
                        <?php 
                           if(!empty($img_url_arr)){ ?>
                        <div class="slider">
                          <a href="#0" class="next control">Next</a>
                          <a href="#0" class="prev control">Prev</a>
                              <ul>
                            <?php foreach( $img_url_arr as $img_url){ ?>
                              <li><img src="<?php echo $img_url; ?>" alt="Image" class="img-fluid rounded"></li>
                            <?php } ?>
                           </ul>
                        </div>
                        <?php }else{ ?>
                            <img src="<?php echo $default_img_url; ?>" alt="Image placeholder" class="img-fluid rounded">
                           <?php } ?>                        
                      </div>
                </div>
                <p><?php echo $prop_results['remarks']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php }?>