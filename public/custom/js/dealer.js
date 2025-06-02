$(document).ready(function(){


		$('#add_dealer_form_own').submit(function(event){
		    event.preventDefault();	
            $('.error').remove();
			let currentSelect = $(this);
				$.ajax({

				   url: base_url+"/dealers",
				   method:"POST",
				   data: new FormData(this),
				   dataType:'JSON',
				   contentType: false,
				   cache: false,
				   processData: false,
				   beforeSend: function(){
	     	     	$('#preloader').show();
	             	},
				   success:function(data){
						    $('#message').html("");
							$('#preloader').hide();
						   	if(data.status == 0){
						   		$.each(data.message , function(i,v){
						   		    $(currentSelect).find('input[name='+i+']').after('<p style="color:red" class="error">' +v[0] + '</p>'); 
						   		    $(currentSelect).find('textarea[name='+i+']').after('<p style="color:red" class="error">' +v[0] + '</p>'); 
						   		    $(currentSelect).find('select[name='+i+']').after('<p style="color:red" class="error">' +v[0] + '</p>'); 
						   		});
						   	}else {
						   		Swal.fire(
									  'Good job!',
									  'Dealer Created Successfully!',
									  'success'
									)
						   		window.location.href = base_url + 'dealers';
						    }			   
				    }
				});


		});

});