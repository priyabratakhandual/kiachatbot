$(document).ready(function(){


// get roles

$.ajax({
  url:base_url+'/roles',
  method:'get',
  dataType:"json",
  success:function(data){
        $('#roletree').treeview({
          data: data.data,
          enableLinks: true
         });
  }
})

// create role

var permissions = [];

function clearArray(array) {
  while (array.length) {
    array.pop();
  }
}

$('#privilege input').on('change',function(){
       clearArray(permissions);
       $('#privilege input[type=checkbox]:checked').each(function () {
                permissions.push($(this).val());
            });
       $('#final_privilege').val(permissions.toString());
});

$("#create_role_form").submit(function(e){
  e.preventDefault();
    $('.error').remove();
        let currentSelect = $(this);
         $.ajax({
         url: base_url + "/roles",
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
                'Role created successfully!',
                'success'
              )
             window.location.href = base_url + "/roles";
            }     
        }    
       });
  });




});
























// /*Treeview Init*/

// $(function() {
//    "use strict";

//         // var alternateData = [
//         //   {
//         //     text: 'Parent 1',
//         //     tags: ['2'],
//         //     nodes: [
//         //       {
//         //         text: 'Child 1',
//         //         tags: ['3'],
//         //         nodes: [
//         //           {
//         //             text: 'Grandchild 1',
//         //             tags: ['6']
//         //           },
//         //           {
//         //             text: 'Grandchild 2',
//         //             tags: ['3']
//         //           }
//         //         ]
//         //       },
//         //       {
//         //         text: 'Child 2',
//         //         tags: ['3']
//         //       }
//         //     ]
//         //   },
//         //   {
//         //     text: 'Parent 2',
//         //     tags: ['7']
//         //   },
//         //   {
//         //     text: 'Parent 3',
//         //     icon: 'glyphicon glyphicon-earphone',
//         //     href: '#demo',
//         //     tags: ['11']
//         //   },
//         //   {
//         //     text: 'Parent 4',
//         //     icon: 'glyphicon glyphicon-cloud-download',
//         //     href: '/demo.html',
//         //     tags: ['19'],
//         //     selected: true
//         //   },
//         //   {
//         //     text: 'Parent 5',
//         //     icon: 'glyphicon glyphicon-certificate',
//         //     color: 'pink',
//         //     backColor: 'red',
//         //     href: 'http://www.tesco.com',
//         //     tags: ['available','0']
//         //   }
//         // ];




//         $('#roletree').treeview({
//           levels: 99,
//           data: alternateData
//         });

// });
