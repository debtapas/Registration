<?php
    /*
        Template Name: Registration
    */

        if( is_user_logged_in() ){
            header( 'Location:' . home_url('dashboard') );
        };

        get_header();?>

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="" class="register-form" id="registerForm">
                            <div class="form-group">
                                <label for="firstName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="first_name" id="firstName" placeholder="Your First Name"/>
                            </div>
                            <div class="form-group">
                                <label for="lastName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="last_name" id="lastName" placeholder="Your Last Name"/>
                            </div>
                            <div class="form-group">
                                <label for="userName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="user_name" id="userName" placeholder="User Name"/>
                            </div>                            
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="phone_number" id="phone" placeholder="Your Phone"/>
                            </div>
                            <div class="form-group">
                                <label for="addInfo"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="additional_information" id="addInfo" placeholder="Additional Information"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                        <div id="registration-message"></div>
                    </div>
                    <div class="signup-image">
                        <figure><img src="<?php echo get_template_directory_uri(). '/images/signup-image.jpg' ?>"></figure>
                        <a href="<?php echo home_url('login'); ?>" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

<?php get_footer(); ?>