jQuery(document).ready(function(){

	//Ajax for Registration form ==================
	jQuery("#registerForm").submit(function(e){
		e.preventDefault();

		var regFormData = jQuery(this).serialize();

		jQuery.ajax({
			type: 'post',
			dataType: 'json',
			url: registration_vars.ajax_url,
			data: {
				action: 'custom_registration',
				'reg_form_data': regFormData,
			},
	        success: function(response) {
	            jQuery('#registration-message').html(response);
	            jQuery('#registerForm')[0].reset();
	        }
        });

	});



	//Ajax for login form ==================
	jQuery("#loginForm").submit(function(e){
		e.preventDefault();

		var loginFormData = jQuery(this).serialize();

		jQuery.ajax({
			type: 'post',
			dataType: 'json',
			url: registration_vars.ajax_url,
			data: {
				action: 'custom_login',
				'login_form_data': loginFormData,
			},
	        success: function(response) {
	        	if(response == 'success'){
	        		window.location.href = 'dashboard';
	        	}else{
	        		alert(response);
	        	}
	            
	        }
        });

	})






})