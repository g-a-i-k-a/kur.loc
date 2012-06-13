$(document).ready(function(){
			$('#reg_send').click(function(e){
				
				//stop the form from being submitted
				e.preventDefault();
				
				/* declare the variables, var error is the variable that we use on the end
				to determine if there was an error or not */
				var error = false;
				var login = $('#reg_form #login').val();
				var pw1 = $('#reg_form #pw1').val();
				var pw2 = $('#reg_form #pw2').val();
				var fio = $('#reg_form #fio').val();
				var adr = $('#reg_form #adr').val();
				
				/* in the next section we do the checking by using VARIABLE.length
				where VARIABLE is the variable we are checking (like name, email),
				length is a javascript function to get the number of characters.
				And as you can see if the num of characters is 0 we set the error
				variable to true and show the name_error div with the fadeIn effect. 
				if it's not 0 then we fadeOut the div( that's if the div is shown and
				the error is fixed it fadesOut. 
				
				The only difference from these checks is the email checking, we have
				email.indexOf('@') which checks if there is @ in the email input field.
				This javascript function will return -1 if no occurence have been found.*/
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
					//disable the submit button to avoid spamming
					//and change the button text to Sending...
					$('#reg_send').attr({'disabled' : 'true', 'value' : '...' });
					
					/* using the jquery's post(ajax) function and a lifesaver
					function serialize() which gets all the data from the form
					we submit it to send_email.php */
					$.post("ajax.php", $("#reg_form").serialize(),function(result){
						//and after the ajax request ends we check the text returned
						if(result == 'success'){
							//if the mail is sent remove the submit paragraph
							$('#reg_form').remove();
							//and show the mail success div with fadeIn
							$('#reg_success').fadeIn(500);
						}else{
							//show the mail failed div
							$('#reg_fail').fadeIn(500);
							//reenable the submit button by removing attribute disabled and change the text back to Send The Message
							$('#reg_send').removeAttr('disabled').attr('value', 'Зарегистрироваться');
						}
					});
				}
			});    
		});