jQuery(document).ready(function(){

	//Ajax for Registration form ==================
	jQuery("#registerForm").submit(function(e){
		e.preventDefault();
		// var regFormData = jQuery(this).serialize();

		var regFormData = new FormData(jQuery('#registerForm')[0]);
		var file_data = jQuery('#avatar-file').prop('files')[0];
		regFormData.append('avatar_file', file_data);
    	regFormData.append('action', 'custom_registration');
    	//regFormData.append('security', registration_vars.avatar_nonce);

    	// console.log(regFormData);
    	// return false;


		jQuery.ajax({
			type: 'post',
			dataType: 'json',
			url: registration_vars.ajax_url,
			data: regFormData,
			processData: false,
            contentType: false,			

			/*data: {
				action: 'custom_registration',
				'reg_form_data': regFormData,
			},*/

	        success: function(response) {
	        	console.log(response);
	        	if(response.flag == false){
	        		jQuery('#registration-message').html(response.message);
	        	}else{
	        		jQuery('#registration-message').html(response.message);
	        		jQuery('#registerForm')[0].reset();
	        	}
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