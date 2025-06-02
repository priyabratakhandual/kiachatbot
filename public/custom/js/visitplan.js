$(document).ready(function(){

$('#dealer_code').on('change',function(){

   $.get(base_url+ '/activeDealerJson/show/' + $(this).val(), function(data){

   	if(data.status == 0) {

   		alert("please enter valid code");

   	}else{


   		$('#dealer_name').val(data.data.DEALER_NAME);
   		$('#for_code').val(data.data.FOR_CD);
   		$('#outlet_code').val(data.data.OUTLET_CD);
   		$('#dealer_map_code').val(data.data.DEALER_MAP_CD);
   		$('#loc_map_code').val(data.data.LOC_CD);
   		$('#region').val(data.data.REGION_CD);
   		$('#loc_address').val(data.data.DEALER_ADDRESS1 + ' | ' + data.data.DEALER_ADDRESS2 + ' | ' + data.data.DEALER_ADDRESS3);
   		$('#city').val(data.data.City_Name);
   		$('#location_type').val(data.data.Outstation_Local);
         $('#dealer_id').val(data.data.id);

   		$('#show_later').show();


   	}

      
   });

});


});