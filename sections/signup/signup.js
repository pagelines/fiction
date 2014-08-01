!function ($) {

	$(document).ready(function() {
		

		$('.signup-center').each(function(){
			
			var theCenter = $(this)
			,	button = theCenter.find('.btn-signup')
			,	theMessages = theCenter.find('.messages')
			,	msg = ''
			
			button.on('click', function(){
				
				var email = theCenter.find('.the-email').val()
				

				// BASIC CHECKING
				if( ! plIsEmailFormat( email )  ){
				
					msg = '<i class="icon icon-smile"></i> Please use a valid email.'

					theMessages
						.html( msg )
						.slideDown()

					setTimeout(function(){
						theMessages.slideUp()
					} , 2500)
					
					return;
				}
				

				$.ajax({
					type: 'POST'
				  	, url: window.plajaxrequest
					, data: {
						action: 'pl_ajax_signup_account'
						, email: email
					}
					, beforeSend: function(){
						theMessages
							.html('<i class="icon icon-refresh icon-spin spin-fast"></i> Sending').slideDown()
					}
					, success: function( response ){

						console.log( response )

						var rsp	= $.parseJSON( response )
						,	result = rsp.result

						
						
						if( result == 1 ){
							$('.pl-signup-form').hide()
							$('.signup-confirm').fadeIn('slow')
						} else if ( result == 2 ){
							
							msg = 'Email already exists.'
							
							theMessages
								.html( msg )
								.slideDown()

							setTimeout(function(){
								theMessages.slideUp()
							} , 2500)
						}
						

					}
				})



			})
			
		})
		
	})
	

}(window.jQuery);