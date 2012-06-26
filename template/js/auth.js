$(document).ready(function(){
			$('#auth_send').click(function(e){
				
				//stop the form from being submitted
				e.preventDefault();
								
				var error = false;
				var login = $('#auth_form #login').val();
				var pw = $('#auth_form #pw').val();
				
				//$('#auth_form p.error').attr();

				if(login.length == 0){
					var error = true;
					$('#login_error').fadeIn(500);
					$('#login_field').css('float', 'left');
				}else{
					$('#login_error').fadeOut(500);
				}
				if(pw.length == 0){
					var error = true;
					$('#pw_error').fadeIn(500);
					$('#pw_field').css('float', 'left');

				}else{
					$('#pw_error').fadeOut(500);
				}
								
				//now when the validation is done we check if the error variable is false (no errors)
				if(error == false){

					$.post("/auth/ajax.php", $("#auth_form").serialize(),function(result){
						//and after the ajax request ends we check the text returned
						if(result == 'success'){
							$('#auth_form').remove();
							$('#profile_link').fadeIn(500);
							//$('#auth_success').fadeIn(500);
						}else{
							$('#auth_fail').css('display', 'inline');
							$('#auth_fail').css('margin-left', '20px');
							$('#auth_fail').fadeIn(500);
						}
					});
				}
			});    
		});