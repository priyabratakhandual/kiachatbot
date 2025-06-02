<!DOCTYPE html>
<html>
<head>
    <title>Import</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        body{
            background-color: #4a4a4a;
        }
    </style>
</head>
<body>
   
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            UPLOAD EXCEL FILE
        </div>
        <div class="card-body">
            <form id="fileUploadForm">
                @csrf
                <input type="file" name="file" class="form-control" id="excelfile" accept=".xls,.xlsx" onchange="ExportToTable()">
                 <br>
                 <h2>FIELD MAPPING FOR VISIT DATA IMPORT</h2>
                 <label>Select Region Field</label>
                 <select class="form-control select" name="region"></select>
                 <br>
                 <label>Select Dealer Code Field</label>
                 <select class="form-control select" name="dealer_code"></select>
                 <br>
                 <label>Select For code Field</label>
                 <select class="form-control select" name="for_code"></select>
                 <br>
                 <label>Select OUtlet Code Field</label>
                 <select class="form-control select" name=" outlet_code"></select>
                 <br>
                 <label>Select Dealer Map Code Field</label>
                 <select class="form-control select" name="dealer_map_code"></select>
                 <br>
                 <label>Select Location Map code Field</label>
                 <select class="form-control select" name="loc_map_code"></select>
                 <br>
                 <label>Select location type Field</label>
                 <select class="form-control select" name=" location_type"></select>
                 <br>
                 <label>Select dealer name Field</label>
                 <select class="form-control select" name="dealer_name"></select>
                 <br>
                 <label>Select location address Field</label>
                 <select class="form-control select" name="loc_address"></select>
                 <br>
                 <label>Select city Field</label>
                 <select class="form-control select" name="city"></select>
                 <br>
                 <label>Select agenda of visit Field</label>
                 <select class="form-control select" name="agenda_of_visit"></select>
                 <br>
                 <label>Select resource name Field</label>
                 <select class="form-control select" name="resource_name"></select>
                 <br>
                 <label>Select visit planned date Field</label>
                 <select class="form-control select" name="visit_planned_date"></select>
                 <br>
                 <label>Select actual date of visit Field</label>
                 <select class="form-control select" name="actual_date_of_visit"></select>
                 <br>
                 <label>Select reason for reschedule Field</label>
                 <select class="form-control select" name=" reason_for_reschedule"></select>
                 <br>
                 <label>Select agenda completed Field</label>
                 <select class="form-control select" name=" agenda_complete"></select>
                 <br>
                 <label>Select dvdr submitted Field</label>
                 <select class="form-control select" name="dvdr_submitted"></select>
                 <br>
                 <label>Select observation Field</label>
                 <select class="form-control select" name="observation"></select>
                 <br>
                 <label>Select action taken Field</label>
                 <select class="form-control select" name=" action_taken"></select>
                 <br>
                </form>  
                 <br>   
                 <button class="btn btn-success" id="start">Start</button>
        </div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
<script type="text/javascript">
    const base_url = {!! json_encode(url('/')) !!};

    var excelDataJson;
    function ExportToTable() {  
         var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;  
         /*Checks whether the file is a valid excel file*/  
         if (regex.test($("#excelfile").val().toLowerCase())) {  
             var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/  
             if ($("#excelfile").val().toLowerCase().indexOf(".xlsx") > 0) {  
                 xlsxflag = true;  
             }  
             /*Checks whether the browser supports HTML5*/  
             if (typeof (FileReader) != "undefined") {  
                 var reader = new FileReader();  
                 reader.onload = function (e) {  
                     var data = e.target.result;  
                     /*Converts the excel data in to object*/  
                     if (xlsxflag) {  
                         var workbook = XLSX.read(data, { type: 'binary' });  
                     }  
                     else {  
                         var workbook = XLS.read(data, { type: 'binary' });  
                     }  
                     /*Gets all the sheetnames of excel in to a variable*/  
                     var sheet_name_list = workbook.SheetNames;  
      
                     var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
                     sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
                         /*Convert the cell value to Json*/  
                         if (xlsxflag) {  
                             var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
                         }  
                         else {  
                             var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
                         }  
                         if (exceljson.length > 0 && cnt == 0) {  
                             BindTableHeader(exceljson, '#exceltable');  
                             cnt++;
                             excelDataJson = exceljson;
                             $('#start').attr('disabled',false);
                         }  
                     });  

                     $('#exceltable').show();  
                 }  
                 if (xlsxflag) {
                     reader.readAsArrayBuffer($("#excelfile")[0].files[0]);  
                 }  
                 else {  
                     reader.readAsBinaryString($("#excelfile")[0].files[0]);  
                 }  
             }  
             else {  
                 alert("Sorry! Your browser does not support HTML5!");  
             }  
         }  
         else {  
             alert("Please upload a valid Excel file!");  
         }  
     }  

 
     function BindTableHeader(jsondata, tableid) { 
         var columnSet = [];  
         for (var i = 0; i < jsondata.length; i++) {  
             var rowHash = jsondata[i];  
             for (var key in rowHash) {  
                 if (rowHash.hasOwnProperty(key)) {  
                     if ($.inArray(key, columnSet) == -1) { 
                         columnSet.push(key);  
                     }  
                 }  
             }  
         }  
         var select = "";
         columnSet.forEach(function(value){
            select += '<option value="'+value+'">'+value+'</option>';
         });
          $('.select').append(select);
     } 
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var itr = 0;
    $('#start').attr('disabled',true);

    $("#start").on('click',function(){

         $('<img src="https://cdn.dribbble.com/users/503653/screenshots/3143656/fluid-loader.gif" style="width:4rem;" />').insertAfter("#start"); 
         $('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" style="width:1%">0/'+excelDataJson.length+'</div></div>').insertBefore(this);
         
         setTimeout(function(){
              itr = 0;
              getProgress(itr);
            }, 200);   
    });
    

   function getProgress(){

            var formdata = $('#fileUploadForm').serialize();
            $.ajaxSetup({
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                  url: base_url+"/importVisit",
                  method: 'post',
                  data: {
                     formdata: formdata,
                     exceldata: JSON.stringify(excelDataJson[itr]),
                  },beforeSend: function(){
                   },
                  success: function(result){
                        itr++;  
                        $(".progress-bar").text(itr + '/' + excelDataJson.length);  
                        $(".progress-bar").css('width', ((itr/excelDataJson.length)*100) + '%');
                        if(itr < excelDataJson.length) {   
                              setTimeout(function(){   
                                 getProgress(); 
                               },20);
                        } else {
                                 window.location.href = base_url;
                        }
                  },
                error: function(result){
                        itr++;  
                        $(".progress-bar").text(itr + '/' + excelDataJson.length);  
                        $(".progress-bar").css('width', ((itr/excelDataJson.length)*100) + '%');
                        if(itr < excelDataJson.length) {   
                              setTimeout(function(){   
                                 getProgress(); 
                               },20);
                        } else {
                                 window.location.href = base_url;
                        }
                        console.log('error');
                }
              });
   }


  });
</script>
</body>
</html>

