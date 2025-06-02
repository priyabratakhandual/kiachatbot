/*DataTable Init*/

"use strict";

$(document).ready(function () {

    "use strict";

          // questions datatable
        
    function download_files(files) {
        function download_next(i) {
            if (i >= files.length) {
                return;
            }
            var a = document.createElement('a');
            a.href = files[i].download;
            a.target = '_parent';
            // Use a.download if available, it prevents plugins from opening.
            if ('download' in a) {
                a.download = files[i].filename;
            }
            // Add a to the doc for click to work.
            (document.body || document.documentElement).appendChild(a);
            if (a.click) {
                a.click(); // The click method is supported by most browsers.
            } else {
                $(a).click(); // Backup using jquery
            }
            // Delete the temporary link.
            a.parentNode.removeChild(a);
            // Download the next file with a small timeout. The timeout is necessary
            // for IE, which will otherwise only download the first file.
            setTimeout(function () {
                download_next(i + 1);
            }, 500);
        }
        // Initiate the first download.
        download_next(0);
    }

    $(document).on('click', '.download_multiple', function () {
        var folder = $(this).data('folder');
        var files = $(this).data('files').split("|||");
        var id = $(this).data('id').substring(4);
        $(this).removeData('folder');
        $(this).removeData('files');
        $(this).removeData('id');

        var array = [];

        files.forEach(function (item, index) {
            if (item) {
                array.push({ download: 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' + id + '/' + folder + '/' + item, filename: item });
            }
        })

        console.log(array);

        download_files(array);


    });

    $('.datepicker').datepicker({ format: 'dd/mm/yyyy' });

    $('.datepicker-2').datepicker({ format: 'yyyy/mm/dd' });


    $('#activity_table tfoot th').each(function () {
        var title = $(this).text();
        if (title == 'Activity Type' || title == 'Region' || title == 'Dealer Code' || title == 'Trainer' || title == 'Status' || title == 'Module') {
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
        }
        else {
            $(this).html("");
        }
    });

    var buttonCommon = {
        exportOptions: {
            format: {
                body: function (data, row, column, node) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace(/[$,]/g, '') :
                        data;
                }
            }
        }
    };

    function format(d) {
        // `d` is the original data object for the row
        console.log(d);
        return '<div style="border-radius: 8px;padding: 12px;box-shadow: 1px 2px 9px 0px grey;"><table style="width:100%">' +
            ((d.remarks) ? '<tr><td colspan="3" style="word-break: break-all;">Remarks: ' + d.remarks + '</td></tr>' : '') +
            '<tr>' +
            ((d.attendance) ? '<td>Attendance: <a href="javascript:void(0)" class="download_multiple" data-folder="attendance" data-id="' + d.id + '" data-files="' + d.attendance + '"><span class="badge badge-adi">download</span></a></td>' : '<td>Attendance: No Files</td>') +
            ((d.site_readiness) ? '<td>Site Readiness: <a href="javascript:void(0)" class="download_multiple" data-folder="site_readiness" data-id="' + d.id + '" data-files="' + d.site_readiness + '"><span class="badge badge-adi">download</span></a></td>' : '<td>Site Readiness: No Files</td>') +
            ((d.speed_test) ? '<td>Speed Test: <a href="javascript:void(0)" class="download_multiple" data-folder="speed_test" data-id="' + d.id + '" data-files="' + d.speed_test + '"><span class="badge badge-adi">download</span></a></td>' : '<td>Speed Test: No Files</td>') +
            '</tr>' +
            '<tr>' +
            ((d.training_pics) ? '<td>Training Photos: <a href="javascript:void(0)" class="download_multiple" data-folder="training_pics" data-id="' + d.id + '" data-files="' + d.training_pics + '"><span class="badge badge-adi">download</span></a></td>' : '<td>Training Photos: No Files</td>') +
            ((d.sign_off_doc) ? '<td>Sign Off Docs: <a href="javascript:void(0)" class="download_multiple" data-folder="sign_off_doc" data-id="' + d.id + '" data-files="' + d.sign_off_doc + '"><span class="badge badge-adi">download</span></a></td>' : '<td>Sign Off Docs: No Files</td>') +
            ((d.other_doc) ? '<td>Other Docs: <a href="javascript:void(0)" class="download_multiple" data-folder="other_doc" data-id="' + d.id + '" data-files="' + d.other_doc + '"><span class="badge badge-adi">download</span></a></td>' : '<td>Other Docs: No Files</td>') +
            '</tr>' +
            '</table></div>';
    }


    var activityTable = $('#activity_table').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[5, 10, 25, 50, 100, 500, -1], [5, 10, 25, 50, 100, 500, "All"]],
        pageLength: 5,
        ajax: {
            url: base_url + '/activityTable',
            type: 'GET',
            data: function (d) {
                d.from = $('#startDate').val();
                d.to = $('#endDate').val();
            }
        },
        columns: [
            // {data: 'check', name: 'check',"class":'select-checkbox', searchable:false,orderable: false}, 
            // {data: 'DT_RowIndex',searchable:false,orderable: false},  /* for serial numbers */ 
            { "className": 'details-control', "orderable": false, "data": null, "defaultContent": '', searchable: false, orderable: false },
            { data: 'activity_id', name: 'activity_id', searchable: false, orderable: false },
            { data: 'activity_date_from', name: 'activity_date_from', searchable: false, orderable: false },
            { data: 'activity_date_to', name: 'activity_date_to', searchable: false, orderable: false },
            { data: 'activity_type', name: 'activity_type' },
            { data: 'region', name: 'region' },
            { data: 'dealer_code', name: 'dealer_code' },
            { data: 'module', name: 'module' },
            { data: 'trainer_name', name: 'trainer_name' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', searchable: false, orderable: false },
            { data: 'remarks', name: 'remarks', visible: false, title: 'Remarks', searchable: false, orderable: false },
            { data: 'activity_date', name: 'activity_date', visible: false, title: 'Activity Date', searchable: false, orderable: false },
            { data: 'no_of_men_days', name: 'no_of_men_days', visible: false, title: 'No of Men Days', searchable: false, orderable: false },
            { data: 'no_of_participant', name: 'no_of_participant', visible: false, title: 'No of Participants', searchable: false, orderable: false },
            { data: 'training_type', name: 'training_type', visible: false, title: 'Training Type', searchable: false, orderable: false },
            { data: 'attendance_sta', name: 'attendance_sta', visible: false, title: 'Attendance', searchable: false, orderable: false },
            { data: 'site_readiness_sta', name: 'site_readiness_sta', visible: false, title: 'Site Readiness', searchable: false, orderable: false },
            { data: 'speed_test_sta', name: 'speed_test_sta', visible: false, title: 'Speed Test', searchable: false, orderable: false },
            { data: 'sign_off_doc_sta', name: 'sign_off_doc_sta', visible: false, title: 'Sign Off Doc', searchable: false, orderable: false },
            { data: 'training_pics_sta', name: 'training_pics_sta', visible: false, title: 'Training Pics', searchable: false, orderable: false },
            { data: 'other_doc_sta', name: 'other_doc_sta', visible: false, title: 'Other Docs', searchable: false, orderable: false },
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Export',
                exportOptions: {
                    modifier: { search: 'applied' }
                }
            },
        ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every(function () {
                var that = this;
                $('input', this.footer()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }

    });


    // Add event listener for opening and closing details
    $('#activity_table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = activityTable.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('.datepicker').on('change', function () {
        var from = $("#startDate").val();
        var to = $("#endDate").val();
        if (from && to) {
            console.log("here");
            activityTable.draw();
        }
    });

    $('.datepicker2').datepicker({ format: 'yyyy-mm-dd' });

    $('.datepicker2').on('change', function () {
        var from = $("#sdate").val();
        var to = $("#edate").val();
        // console.log('sss', $('[name="csrf-token"]').attr('content'));
        if (from && to) {
            let url = base_url + `/activity/attendance-feeback?start=${from}&end=${to}`
            console.log(url);
            window.location.replace(url);

        //    $.ajax({
        //     url : base_url + '/activity/attendance-feeback/table',
        //     method:'POST',
        //     data:{
        //         from,to,
        //         '_token' : $('[name="csrf-token"]').attr('content')
        //     },
        //     success:function(data){
        //         console.log(data);
        //     },
        //     error:function(err){
        //         console.log(err);
        //     }
        //    });
        }
        console.log(from, to);
    });


    var trainers = $('#trainers').DataTable({
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: base_url + '/trainersTable',
        columns: [
            { data: 'check', name: 'check', "class": 'select-checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', orderable: false, searchable: false },  /* for serial numbers */
            { data: 'name', name: 'name', "class": "details-control", "orderable": false },
            { data: 'emp_code', name: 'emp_code' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            // {data: 'action', name: 'action'},
        ],
        dom: 'lBfrtip',
        buttons: [
            // {
            //      text: 'Delete',
            //        action: function(){

            //      }
            //  },
        ],
        "fnDrawCallback": function (oSettings) {


            $('#delete_question').on('click', function (e) {

                var count = goahead.rows({ selected: true }).count();
                if (count < 1) {
                    alert('please select one row');
                } else {
                    var questions = goahead.rows({ selected: true }).data().pluck('ques_id').toArray();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    event.preventDefault();

                    $.ajax({
                        url: base_url + "/delete_question",
                        context: this,
                        data: { questions: questions },
                        method: 'POST',
                        beforeSend: function () {
                            /* $(this).append('<div id="dt_loader" class="spinner-border text-dark" style="width: 1rem;height: 1rem;" role="status"><span class="sr-only">Loading...</span></div>'); */
                        },
                        success: function (result) {
                            /*$('#dt_loader').remove();*/
                            location.reload(true / false);
                        }
                    });
                }
            });
        }
    });

    // dt.buttons().container().appendTo( '#question_table_wrapper .col-md-6:eq(0)');  

    var dealer_master = $('#dealer_master').DataTable({
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: base_url + '/dealerMasterTable',
        columns: [
            { data: 'check', name: 'check', "class": 'select-checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', orderable: false, searchable: false },  /* for serial numbers */
            { data: 'dealer_code', name: 'dealer_code', "class": "details-control", "orderable": false },
            { data: 'dealer_name', name: 'dealer_name' },
            { data: 'dealer_category', name: 'dealer_category' },
            { data: 'city', name: 'city' },
            { data: 'creation', name: 'creation' },
            { data: 'dealer_type', name: 'dealer_type' },
            { data: 'visit_required', name: 'visit_required' },
            { data: 'visit_type', name: 'visit_type' },
            { data: 'aging', name: 'aging' },
            { data: 'fe_name', name: 'fe_name' },
            { data: 'action', name: 'action' },
        ],
        dom: 'lBfrtip',
        buttons: [
            // {
            //      text: 'Delete',
            //        action: function(){

            //      }
            //  },
        ],
        "fnDrawCallback": function (oSettings) {


            $('#delete_question').on('click', function (e) {

                var count = dealer_master.rows({ selected: true }).count();
                if (count < 1) {
                    alert('please select one row');
                } else {
                    var questions = dealer_master.rows({ selected: true }).data().pluck('ques_id').toArray();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    event.preventDefault();

                    $.ajax({
                        url: base_url + "/delete_question",
                        context: this,
                        data: { questions: questions },
                        method: 'POST',
                        beforeSend: function () {
                            /* $(this).append('<div id="dt_loader" class="spinner-border text-dark" style="width: 1rem;height: 1rem;" role="status"><span class="sr-only">Loading...</span></div>'); */
                        },
                        success: function (result) {
                            /*$('#dt_loader').remove();*/
                            location.reload(true / false);
                        }
                    });
                }
            });



        }
    });


    var visitplan = $('#visitplan').DataTable({
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: base_url + '/visitPlanTable',
        columns: [
            { data: 'check', name: 'check', "class": 'select-checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', orderable: false, searchable: false },  /* for serial numbers */
            { data: 'dealer_name', name: 'dealer_name', "class": "details-control", "orderable": false },
            { data: 'dealer_code', name: 'dealer_code' },
            { data: 'loc_address', name: 'loc_address' },
            { data: 'location_type', name: 'location_type' },
            { data: 'agenda_of_visit', name: 'agenda_of_visit' },
            { data: 'visit_planned_date', name: 'visit_planned_date' },
            { data: 'actual_date_of_visit', name: 'actual_date_of_visit' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
        dom: 'lBfrtip',
        buttons: [
            // {
            //      text: 'Delete',
            //        action: function(){

            //      }
            //  },
        ],
        "fnDrawCallback": function (oSettings) {


            $('#delete_question').on('click', function (e) {

                var count = visitplan.rows({ selected: true }).count();
                if (count < 1) {
                    alert('please select one row');
                } else {
                    var questions = visitplan.rows({ selected: true }).data().pluck('ques_id').toArray();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    event.preventDefault();

                    $.ajax({
                        url: base_url + "/delete_question",
                        context: this,
                        data: { questions: questions },
                        method: 'POST',
                        beforeSend: function () {
                            /* $(this).append('<div id="dt_loader" class="spinner-border text-dark" style="width: 1rem;height: 1rem;" role="status"><span class="sr-only">Loading...</span></div>'); */
                        },
                        success: function (result) {
                            /*$('#dt_loader').remove();*/
                            location.reload(true / false);
                        }
                    });
                }
            });



        }
    });



    var dt2 = $('#user_table').DataTable({
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: base_url + '/users',
        columns: [
            { data: 'check', name: 'check', "class": 'select-checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', orderable: false, searchable: false },  /* for serial numbers */
            { data: 'name', name: 'name', "class": "details-control", "orderable": false },
            { data: 'email', name: 'email', "orderable": false },
            { data: 'phone', name: 'phone', "orderable": false },
            { data: 'created_at', name: 'created_at' },
            { data: 'user_id', name: 'user_id', visible: false, title: "user id", },
        ],
        dom: 'lBfrtip',
        buttons: [
            // {
            //      text: 'Delete',
            //        action: function(){

            //      }
            //  },
        ],
        "fnDrawCallback": function (oSettings) {


            $('#delete_user').on('click', function (e) {

                var count = dt2.rows({ selected: true }).count();
                if (count < 1) {
                    alert('please select one row');
                } else {
                    var users = dt2.rows({ selected: true }).data().pluck('user_id').toArray();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    event.preventDefault();

                    $.ajax({
                        url: base_url + "/delete_user",
                        context: this,
                        data: { users: users },
                        method: 'POST',
                        beforeSend: function () {
                            /* $(this).append('<div id="dt_loader" class="spinner-border text-dark" style="width: 1rem;height: 1rem;" role="status"><span class="sr-only">Loading...</span></div>'); */
                        },
                        success: function (result) {
                            /*$('#dt_loader').remove();*/
                            location.reload(true / false);
                        }
                    });
                }
            });



        }
    });


    var dt3 = $('#form_table').DataTable({
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: base_url + '/forms',
        columns: [
            { data: 'check', name: 'check', "class": 'select-checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', orderable: false, searchable: false },  /* for serial numbers */
            { data: 'form_title', name: 'form_title', "class": "details-control", "orderable": false },
            { data: 'form_description', name: 'form_description', "orderable": false },
            { data: 'questions', name: 'questions', "orderable": false },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
            { data: 'form_id', name: 'form_id', visible: false, title: "form id", },
        ],
        dom: 'lBfrtip',
        buttons: [
            // {
            //      text: 'Delete',
            //        action: function(){

            //      }
            //  },
        ],
        "fnDrawCallback": function (oSettings) {


            // $('#delete_user').on('click',function(e){

            //     var count = dt3.rows( { selected: true } ).count();
            //     if(count < 1){
            //       alert('please select one row');
            //     }else{
            //        var users = dt3.rows({selected:true}).data().pluck('user_id').toArray();
            //                 $.ajaxSetup({
            //                     headers: {
            //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                     }
            //                 }); 
            //                 event.preventDefault(); 

            //             $.ajax({
            //              url: base_url+ "/delete_user", 
            //              context: this,
            //              data:{users:users},
            //              method: 'POST',
            //                  beforeSend: function(){
            //                      /* $(this).append('<div id="dt_loader" class="spinner-border text-dark" style="width: 1rem;height: 1rem;" role="status"><span class="sr-only">Loading...</span></div>'); */
            //                        },
            //                   success: function(result){ 
            //                      /*$('#dt_loader').remove();*/
            //                       location.reload(true/false);
            //                   }
            //             });
            //     }
            // });



        }
    });



    var dt4 = $('#feedback_table').DataTable({
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: base_url + '/feedback',
        columns: [
            { data: 'check', name: 'check', "class": 'select-checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', orderable: false, searchable: false },  /* for serial numbers */
            { data: 'name', name: 'name', "class": "details-control", "orderable": false },
            { data: 'region', name: 'region', "orderable": false },
            { data: 'dealer_code', name: 'dealer_code', "orderable": false },
            { data: 'location_code', name: 'location_code', "orderable": false },
            { data: 'for_code', name: 'for_code', "orderable": false },
            { data: 'city', name: 'city', "orderable": false },
            { data: 'location_type', name: 'location_type', "orderable": false },
            { data: 'date_of_audit', name: 'date_of_audit', "orderable": false },
            { data: 'audited_by', name: 'audited_by', "orderable": false },
            { data: 'q1', name: 'q1', "orderable": false },
            { data: 'q2', name: 'q2', "orderable": false },
            { data: 'q3', name: 'q3', "orderable": false },
            { data: 'q4', name: 'q4', "orderable": false },
            { data: 'q5', name: 'q5', "orderable": false }
        ],
        dom: 'lBfrtip',
        buttons: [
            // {
            //      text: 'Delete',
            //        action: function(){

            //      }
            //  },
        ],
        "fnDrawCallback": function (oSettings) {


        }
    });



    // attendence datatable
    $('#datatableAttendence').DataTable({
        dom: 'Blfrtip',
        // scrollbar code
        // "scrollY": "400px",
        // "scrollCollapse": true,
        // "paging": false,
        
        buttons: [
            {
                extend: 'excel',
                title: 'Export',
               
                exportOptions: {
                    modifier: { search: 'applied' }
                }
            },
        ],
    });

 
     

});