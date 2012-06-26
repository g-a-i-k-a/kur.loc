$(document).ready(function(){
			$('#reg_send').click(function(e){
				
				//stop the form from being submitted
				e.preventDefault();
								
				var error = false;
				var login = $('#reg_form #login').val();
				var pw1 = $('#reg_form #pw1').val();
				var pw2 = $('#reg_form #pw2').val();
				var fio = $('#reg_form #fio').val();
				var adr = $('#reg_form #adr').val();
				
				if(login.length == 0){
					var error = true;
					$('#login_error').fadeIn(500);
				}else{
					$('#login_error').fadeOut(500);
				}
				if(pw1.length == 0){
					var error = true;
					$('#pw1_error').fadeIn(500);
				}else{
					$('#pw1_error').fadeOut(500);
				}
				if(pw1 != pw2){
					var error = true;
					$('#pw2_error').fadeIn(500);
				}else{
					$('#pw2_error').fadeOut(500);
				}
				if(fio.length == 0){
					var error = true;
					$('#fio_error').fadeIn(500);
				}else{
					$('#fio_error').fadeOut(500);
				}
				if(adr.length == 0){
					var error = true;
					$('#adr_error').fadeIn(500);
				}else{
					$('#adr_error').fadeOut(500);
				}
				
				//now when the validation is done we check if the error variable is false (no errors)
				if(error == false){
									
					$.post("ajax.php", $("#reg_form").serialize(),function(result){
						//and after the ajax request ends we check the text returned
						if(result == 'success'){
							$('#reg_form').remove();
							$('#reg_success').fadeIn(500);
						}else{
							$('#reg_fail').fadeIn(500);
						}
					});
				}
			});    
		});