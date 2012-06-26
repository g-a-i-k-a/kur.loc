$(document).ready(function(){
			$('#order_send').click(function(e){
				
				//stop the form from being submitted
				e.preventDefault();
								
				var error = false;	
							
				if ($('input:checkbox:checked').val())	{				
					$('#check_error').fadeOut(500);
				}else{
					var error = true;
					$('#check_error').fadeIn(500);
				}								
				//now when the validation is done we check if the error variable is false (no errors)
				if(error == false){

					$.post("/order/add.php", $("#order_form").serialize(),function(result){
						//and after the ajax request ends we check the text returned
						if(result == 'success'){
							$('#order_form').remove();
							$('#order_success').fadeIn(500);
						}else{
							$('#order_fail').fadeIn(500);
						}
					});
				}
			});    
		});