$(document).ready(function(){
			$('#order_cancel_send').click(function(e){
				
				//stop the form from being submitted
				e.preventDefault();
				
				$.post("/order/cancel.php", $("#order_cancel").serialize(),function(result){
						//and after the ajax request ends we check the text returned
						if(result == 'success'){
							$('#order_cancel').remove();
							$('#order_cancel_success').fadeIn(500);
						}else{
							$('#order_cancel_fail').fadeIn(500);
						}
					});
			});    
		});