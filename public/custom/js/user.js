$(document).ready(function(){

$('#role').on('change',function(){

  if($(this).val() == 'Field Engineer'){
   $('#if_fe').show();
  }else{
   $('#if_fe').hide();
  }

});

$("#add_user_form").submit(function(e){
  e.preventDefault();
    $('.error').remove();
        let currentSelect = $(this);
         $.ajax({
         url: base_url + "/users",
         method:"POST",
         data: new FormData(this),
         dataType:'JSON',
         contentType: false,
         cache: false,
         processData: false,
         beforeSend: function(){
           $('#preloader').show();
                       },
         success:function(data)
         {
           $('#preloader').hide();
            if(data.status == 0){
              $.each(data.message , function(i,v){
                console.log(i + " " + v);
                $(currentSelect).find('input[name='+i+']').after('<p style="color:red" class="error">' +v + '</p>'); 
                 $(currentSelect).find('select[name='+i+']').after('<p style="color:red" class="error">' +v + '</p>'); 
                 $(currentSelect).find('textarea[name='+i+']').after('<p style="color:red" class="error">' +v + '</p>'); 
              });
            }
            else{
              Swal.fire(
                'Success!',
                'User created successfully!',
                'success'
              )
             window.location.href = base_url + "/users";
            }     
        }    
       });
  });

});
