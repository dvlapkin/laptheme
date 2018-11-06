	jQuery(document).ready(function($){
			var $myimgFile    = $('input[type="file"]');
			var $myimgId      = $('.image_id');	
			$('#btn').attr('disabled', true);
			
					$myimgFile.on('change', function(e){
				
						e.preventDefault();
					 
						var formData = new FormData();
					 
						formData.append('action', 'upload-attachment');
						formData.append('async-upload', $myimgFile[0].files[0]);
						formData.append('name', $myimgFile[0].files[0].name);
						formData.append('_wpnonce', m_config.nonce);
					 
						$.ajax({
							url: m_config.upload_url,
							data: formData,
							processData: false,
							contentType: false,
							dataType: 'json',
							type: 'POST',
							beforeSend: function( xhr ) {
								$('#btn').text('Загрузка  img...');	
							},
							success: function(resp) {
								$('#btn').attr('disabled', false);
								$('#btn').text('Добавить объект');
								console.log(resp);
								$myimgId.val(resp.data.id);
							},
							error: function(xhr){
								alert('Error:'+xhr.status + " " + xhr.statusText);
								$('#btn').text('Error!');
							}
						});
					
					});
					
					$(window).scroll(function(){
						if ($(this).scrollTop() > 100) {
						$('.scrollup').fadeIn();
						} else {
						$('.scrollup').fadeOut();
						}
						});
						 
					$('.scrollup').click(function(){
						$("html, body").animate({ scrollTop: 0 }, 600);
						return false;
						});
					
				});

				jQuery(function($){
					$('#btn').click(function(){
						var dt=jQuery('#add_object').serialize();
						dt='action=add_prop&'+dt;				
						console.log(dt);
						$.ajax({
							url:  m_config.ajax_url,
							type: 'POST',
							data: dt, 
							beforeSend: function( xhr ) {
								$('#btn').text('Загрузка...');	
							},
							success: function( data ) {
								$('#btn').text('Добавить объект');
								$('.prop-review').html(data)
							}
						});
						// если элемент – ссылка, то не забываем:
						// return false;
					});// click
				});	