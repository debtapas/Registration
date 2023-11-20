<?php

//Get Listing page data ~~~~~~~~~~~~~   

      if ( is_wp_error( $results ) ) {
         $error_message = $result->get_error_message();
         echo "Something went wrong: $error_message";
      } else {
         $items = $results['result']['filteredList'];
         foreach($items as $key => $item){ 
            $item_id = $item['id'];
            $img_url_arr = [] ;
            if(isset($item['photoList'])){
               $img_list = $item['photoList'];
               $img_url_arr = wp_list_pluck( $img_list, 'imgurl');
            }            
               $default_img_url = PROP_PLUGIN_URL . 'assets/images/img_1_sq.jpg';
            ?>

            <div class="section search-result-wrap">
                <div class="container">
                  
                  <div class="row posts-entry">
                    <div class="col-lg-12">
                      <div class="blog-entry d-flex blog-entry-search-item">
                        <div class="col-lg-4">
                           <?php 
                           if(!empty($img_url_arr)){ ?>

                                <div class="slider">
                                    <a href="#<?php echo $item_id;?>" class="next control">Next</a>
                                    <a href="#<?php echo $item_id;?>" class="prev control">Prev</a>
                                   <ul>
                              <?php foreach($img_url_arr as $img_url){ ?>
                                   <li>
                                        <img src="<?php echo $img_url; ?>" alt="Image" class="img-fluid">
                                    </li>                                      
                              <?php } ?> 
                                    </ul>
                                </div>
                              <?php }else{ ?>
                                 <a target="_blank" href="?page-id=<?php echo $item_id;?>" class="img-link me-4">
                                   <img src="<?php echo $default_img_url; ?>" alt="Image" class="img-fluid">
                                 </a>
                              <?php }?>
                        </div>
                        
                        <div class="col-lg-8">
                          <h2><a target="_blank" href="?page-id=<?php echo $item_id;?>"><?php echo $item['addressWithoutStreeno']; ?></a></h2>
                          <p><?php echo $item['remarks'];?></p>
                          <p><a target="_blank" href="?page-id=<?php echo $item_id;?>" class="btn btn-sm btn-outline-primary">Read More</a></p>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
         <?php }
      }; ?>  