$(document).ready(function(){


		$('#signupform').validate({
	    rules: {
	       email: {
	        required: true,
	        remail:true
	      },
		  
		 password: {
	        minlength: 8,
	        required: true
	      },
		  
		  confirm_password: {
				required: true,
				minlength: 8,
				equalTo:"#password"
			},
			first_name: {
				required: true,
				required:true
			},
		  
	      last_name: {
	        required: true,
	        required:true
	      },
		  
	     
		   role: {
	      	required: true
	      },
		  
		  agree: "required"
		  
	    },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready