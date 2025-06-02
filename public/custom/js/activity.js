$(document).ready(function(){


		$('#create_activity_form').submit(function(event){
		    event.preventDefault();	
            $('.error').remove();
			let currentSelect = $(this);
				$.ajax({

				   url: base_url+"/activity",
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
						   		    $(currentSelect).find('select[name="'+i+'[]"]').after('<p style="color:red" class="error">' +v[0] + '</p>'); 
						   		});
						   	}else {
						   		if($('#update').val() == 'false'){
						   		alert("Plan Created Successfully!");  
						   		Swal.fire(
									  'Done!',
									  'Plan Created Successfully!',
									  'success'
									)

						   		}else{  
						   		alert("Plan Updated Successfully!");
						   		Swal.fire(
									  'Done!',
									  'Plan Updated Successfully!',
									  'success'
									)

						   		}
						   		window.location.href = base_url + '/login';
						    }			   
				    }
				});


		});



		$('#work_on_activity_form').submit(function(event){
		    event.preventDefault();	
            $('.error').remove();
			let currentSelect = $(this);
				$.ajax({

				   url: base_url+"/activityUpdate",
				   method:"POST",
				   data: new FormData(this),
				   dataType:'JSON',
				   contentType: false,
				   cache: false,
				   processData: false,
				   beforeSend: function(){
	     	     			            $('<img src="https://cdn.dribbble.com/users/503653/screenshots/3143656/fluid-loader.gif" class="preloader" style="width:4rem;" />').insertAfter($('#update_btn')); 
	             	},
				   success:function(data){
						    $('#message').html("");
							$('#preloader').remove();
						   	if(data.status == 0){
						   		    $(currentSelect).find('select[name=status]').after('<p style="color:red" class="error">' +data.message + '</p>'); 
						   	}else {
						   		alert("Plan Updated Successfully!");
						   		Swal.fire(
									  'Done!',
									  'Plan Updated Successfully!',
									  'success'
									)

						   		window.location.href = base_url + '/login';
						    }			   
				    }
				});


		});

});