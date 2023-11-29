<?php
    /*
        Template Name: Dashboard
    */

        if( !is_user_logged_in() ){
            header( 'Location:' . home_url('login') );
        }
        
        get_header();?>

        <section class="signup">
            <div class="container">
                <div class="dashboard-content">
                <h1>Dashboard</h1>
                <?php
                    global $wpdb;
                    $current_user = wp_get_current_user();
                    $user_id = $current_user->data->ID;
                    $user_email = $current_user->data->user_email;
                    $user_nicename = $current_user->data->user_nicename;

                    $user_meta = get_user_meta($user_id);

                    $add_infornations_tb = $wpdb->prefix . 'additional_information';
                    $add_infos = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $add_infornations_tb WHERE user_id=%d", $user_id ), ARRAY_A);
                ?>

                <a href="<?php echo esc_url( wp_logout_url('login') ); ?>" class="btn-logout"> Log Out</a>
                <img class="profile-img" src="<?php echo $user_meta['avatar_path'][0]; ?>">
                <p><strong>User First Name: </strong><?php echo $user_meta['first_name'][0]; ?></p>
                <p><strong>User Last Name: </strong><?php echo $user_meta['last_name'][0]; ?></p>
                <p><strong>User Phone Number: </strong><?php echo $user_meta['phone_number'][0]; ?></p>
                <p><strong>User Name: </strong><?php echo $user_nicename; ?></p>
                <p><strong>User Mail Address: </strong><?php echo $user_email; ?></p>
                <p><strong>User Additional Informations: </strong><?php echo $add_infos[0]['add_info']; ?></p>
                </div>
            </div>
        </section>





<?php get_footer(); ?>