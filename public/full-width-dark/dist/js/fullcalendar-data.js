/*FullCalendar Init*/
$(document).ready(function() {
!function($) {
    "use strict";

    var CalendarPage = function() {};

    CalendarPage.prototype.init = function() {

        //checking if plugin is available
        if ($.isFunction($.fn.fullCalendar)) {
            /* initialize the external events */
            $('#external-events .fc-event').each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });
            
            /* initialize the calendar */

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({ 
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    // right: 'academyappointment,coachappointment,appointment,avaibility,month,basicWeek,basicDay'
                    right: ''
                },
                scrollTime:  moment().format('H:m'),
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                    },
                    customButtons: {
                        avaibility: {
                          text: 'Own Availablility',
                          click: function (event) {
                           // console.log(event);
                            let opened_month = $('#calendar .fc-center h2').text();
                            var date_start,date_end;

                           let view_type = $(this).parent('div').find('button').closest('.fc-state-active').text();

                           switch(view_type){
                            case 'month':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).endOf('month').format('YYYY-MM-DD');


                            break;

                            case 'week':

                                let new_dates = opened_month.split(',');
                                let again_new = new_dates[0].split('–');
                                // console.log(new_dates);
                                // console.log(again_new);
                                let start_new_date = moment(again_new[0]+' '+new_dates[1]).format('YYYY-MM-DD');
                                let end_new_date = moment(start_new_date).add('6','days').format('YYYY-MM-DD');
                                //console.log(end_new_date);
                                date_start = start_new_date;
                                date_end = end_new_date;

                            break;

                            case 'day':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).add('1','day').format('YYYY-MM-DD');                                

                            break;

                           }
                           
                           // console.log(date_start);
                           //      console.log(date_end);

                           // $('#calendar').fullCalendar('removeEvents');
                             $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }); 
                                $.ajax({
                                    method: 'POST',
                                    data: {start:date_start,end:date_end},
                                    url:  base_url+'/get-admin-availibility',
                                    beforeSend: function(){
                                        $('#preloader').show();
                                        $('#calendar').fullCalendar('removeEvents');
                                    },
                                    success: function(data){
                                       // console.log(data);
                                        $('#preloader').hide();
                                        var obj = JSON.parse(data);
                                        if(obj){
                                          var events = [];
                                          $(obj).each(function() {
                                                events.push({
                                                    title: $(this).attr('title'),
                                                    start: $(this).attr('start'),
                                                    coach_id: $(this).attr('coach_id'),
                                                    color: $(this).attr('color'),
                                                });
                                            });
                                           // console.log(events);
                                            //$('#calendar').fullCalendar('removeEvents');
                                            $('#calendar').fullCalendar('addEventSource',events);
                                        }

                                    }
                                });

                          }
                        },
                        appointment: {
                          text: 'Own Appointment',
                          click: function (event) {
                           // console.log(event);
                            let opened_month = $('#calendar .fc-center h2').text();
                            var date_start,date_end;

                           let view_type = $(this).parent('div').find('button').closest('.fc-state-active').text();

                           switch(view_type){
                            case 'month':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).endOf('month').format('YYYY-MM-DD');


                            break;

                            case 'week':

                                let new_dates = opened_month.split(',');
                                let again_new = new_dates[0].split('–');
                                // console.log(new_dates);
                                // console.log(again_new);
                                let start_new_date = moment(again_new[0]+' '+new_dates[1]).format('YYYY-MM-DD');
                                let end_new_date = moment(start_new_date).add('6','days').format('YYYY-MM-DD');
                                //console.log(end_new_date);
                                date_start = start_new_date;
                                date_end = end_new_date;


                            break;

                            case 'day':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).add('1','day').format('YYYY-MM-DD');                                

                            break;

                           }
                           // console.log(date_start);
                           //      console.log(date_end);
                           

                           // $('#calendar').fullCalendar('removeEvents');
                             $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }); 
                                $.ajax({
                                    method: 'POST',
                                    data: {start:date_start,end:date_end},
                                    url:  base_url+'/get-admin-appointments',
                                    beforeSend: function(){
                                        $('#preloader').show();
                                        $('#calendar').fullCalendar('removeEvents');
                                    },
                                    success: function(data){
                                       // console.log(data);
                                        $('#preloader').hide();
                                        var obj = JSON.parse(data);
                                        if(obj){
                                          let events = [];
                                          $(obj).each(function() {
                                                events.push({
                                                    title: $(this).attr('title'),
                                                    start: $(this).attr('start'),
                                                    coach_id: $(this).attr('coach_id'),
                                                    color: $(this).attr('color'),
                                                });
                                            });
                                           console.log(events);
                                            //$('#calendar').fullCalendar('removeEvents');
                                            $('#calendar').fullCalendar('addEventSource',events);
                                        }

                                    }
                                });

                          }
                        },
                        coachappointment: {
                          text: 'Coach Appointment',
                          click: function (event) {
                           // console.log(event);
                            let opened_month = $('#calendar .fc-center h2').text();
                            var date_start,date_end;

                           let view_type = $(this).parent('div').find('button').closest('.fc-state-active').text();

                           switch(view_type){
                            case 'month':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).endOf('month').format('YYYY-MM-DD');


                            break;

                            case 'week':

                                let new_dates = opened_month.split(',');
                                let again_new = new_dates[0].split('–');
                                // console.log(new_dates);
                                // console.log(again_new);
                                let start_new_date = moment(again_new[0]+' '+new_dates[1]).format('YYYY-MM-DD');
                                let end_new_date = moment(start_new_date).add('6','days').format('YYYY-MM-DD');
                                //console.log(end_new_date);
                                date_start = start_new_date;
                                date_end = end_new_date;

                            break;

                            case 'day':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).add('1','day').format('YYYY-MM-DD');                                

                            break;

                           }
                           
                           

                          // $('#calendar').fullCalendar('removeEvents');
                             $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }); 
                                $.ajax({
                                    method: 'POST',
                                    data: {start:date_start,end:date_end},
                                    url:  base_url+'/become-coach-appointments-list',
                                    beforeSend: function(){
                                        $('#preloader').show();
                                        $('#calendar').fullCalendar('removeEvents');
                                    },    
                                    success: function(data){
                                       //console.log(data);
                                        $('#preloader').hide();
                                        if(data.status == 1){
                                            var obj = JSON.parse(data.data);
                                            if(obj){
                                               var events = [];
                                               $(obj).each(function() {
                                                    events.push({
                                                        title: $(this).attr('title'),
                                                        start: $(this).attr('start'),
                                                        coach_id: $(this).attr('coach_id'),
                                                        color: $(this).attr('color'),
                                                    });
                                                });
                                          
                                            //$('#calendar').fullCalendar('removeEvents');
                                            $('#calendar').fullCalendar('addEventSource',events);
                                            }
                                        }
                                    }
                                });

                          }
                        },  
                        academyappointment: {
                          text: 'Academy',
                          click: function (event) {
                           // console.log(event);
                            let opened_month = $('#calendar .fc-center h2').text();
                            var date_start,date_end;

                           let view_type = $(this).parent('div').find('button').closest('.fc-state-active').text();

                           switch(view_type){
                            case 'month':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).endOf('month').format('YYYY-MM-DD');


                            break;

                            case 'week':

                                let new_dates = opened_month.split(',');
                                let again_new = new_dates[0].split('–');
                                // console.log(new_dates);
                                // console.log(again_new);
                                let start_new_date = moment(again_new[0]+' '+new_dates[1]).format('YYYY-MM-DD');
                                let end_new_date = moment(start_new_date).add('6','days').format('YYYY-MM-DD');
                                //console.log(end_new_date);
                                date_start = start_new_date;
                                date_end = end_new_date;

                            break;

                            case 'day':

                                date_start = moment(opened_month).format('YYYY-MM-DD');
                                date_end = moment(date_start).add('1','day').format('YYYY-MM-DD');                                

                            break;

                           }
                           
                           

                          // $('#calendar').fullCalendar('removeEvents');
                             $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }); 
                                $.ajax({
                                    method: 'POST',
                                    data: {start:date_start,end:date_end},
                                    url:  base_url+'/academy-appointments-list',
                                    beforeSend: function(){
                                        $('#preloader').show();
                                        $('#calendar').fullCalendar('removeEvents');
                                    },    
                                    success: function(data){
                                       //console.log(data);
                                        $('#preloader').hide();
                                        if(data.status == 1){
                                            var obj = JSON.parse(data.data);
                                            if(obj){
                                               var events = [];
                                               $(obj).each(function() {
                                                    events.push({
                                                        title: $(this).attr('title'),
                                                        start: $(this).attr('start'),
                                                        user_id: $(this).attr('user_id'),
                                                        color: $(this).attr('color'),
                                                    });
                                                });
                                          
                                            //$('#calendar').fullCalendar('removeEvents');
                                            $('#calendar').fullCalendar('addEventSource',events);
                                            }
                                        }
                                    }
                                });

                          }
                        },                       
                      },
                      viewRender: function(event,view, element){
                        //console.log(view);
                        // console.log(event.start);
                        // console.log(event.end);
                        //console.log($('#coach_calendar .fc-right .fc-button-group').find('button').hasClass('fc-state-active'));
                            let date_start = moment(event.start).format('YYYY-MM-DD');
                            let date_end = moment(event.end).format('YYYY-MM-DD');
                            // console.log(date_start);
                            // console.log(date_end);
                               $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }); 
                                $.ajax({
                                    method: 'POST',
                                    data: {start:date_start,end:date_end},
                                    url:  base_url+'/get-visits',
                                    beforeSend: function(){
                                        $('#preloader').show();
                                    },
                                    success: function(data){
                                        var obj = JSON.parse(data);
                                        if(obj){
                                          var events = [];
                                          $(obj).each(function() {
                                                events.push({
                                                    title: $(this).attr('title'),
                                                    start: $(this).attr('start'),
                                                    user_id: $(this).attr('user_id'),
                                                    color: $(this).attr('color'),
                                                });
                                            });
                                           // console.log(events);
                                            $('#calendar').fullCalendar('removeEvents');
                                            $('#calendar').fullCalendar('addEventSource',events);
                                            $('#preloader').hide();
                                        }

                                    }
                                });
                            
                        },                      
                      dayClick: function (date, jsEvent, view) {
                        var date = moment(date).format('YYYY-MM-DD');
                        var current = moment();
                        let today_date = current.format("YYYY-MM-DD");                        
                        if(new Date(date) < new Date(today_date)){
                           alert('Cannot select previous date !');
                        }else{
                            $('#adminappointment_availibility').find('input[name="visit_planned_date"]').val(date);
                            $('#adminappointment_availibility').modal('show');
                        }
                      },
                       eventClick: function(event) {
                       let select_date = moment(event.start).format('YYYY-MM-DD');
                       let current = moment();
                       let today_date = current.format("YYYY-MM-DD");
                       // if(new Date(select_date) < new Date(today_date)){
                       //         alert('Cannot select previous date !');
                       //  }else{


                           if(event.title == "Pending Appointment"){
                             let start_date_time =  moment(event.start).format('YYYY-MM-DD HH:mm:ss');
                             let user_detail = event.user_id
                             // console.log(start_date_time);
                             // console.log(start_date_time);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }); 
                                $.ajax({
                                    method: 'POST',
                                    data: {start:start_date_time,user_detail:user_detail},
                                    url:  base_url+'/appointment-booking-slots',
                                    beforeSend: function(){
                                        $('#preloader').show();
                                    },
                                    success: function(data){
                                        $('#preloader').hide();
                                        var obj = JSON.parse(data);
                                        if(obj){
                                         //console.log(obj);

                                         let date_time = obj.start.split(' ');
                                         //console.log(obj.coach_details);
                                         $('#appointment_allot').find('input[name="user_name"]').val(obj.user_name);
                                         $('#appointment_allot').find('input[name="appointment_date"]').val(date_time[0]);
                                         $('#appointment_allot').find('input[name="appointment_time"]').val(date_time[1]);
                                         $('#appointment_allot').find('input[name="booking_id"]').val(obj.booking_id);
                                         $('#appointment_allot').find('input[name="booking_id"]').attr('data-id',obj.booking_id);

                                         $('#appointment_allot').find('select').html(obj.coach_details);
                                         if(obj.user_img){
                                            let path = base_url+'/'+obj.user_img;
                                            $('#user_image ').attr('src',path);
                                            //console.log(path);
                                         }else{
                                            let path = base_url+'/img/user1-128x128.jpg';
                                            $('#user_image ').attr('src',path);
                                         }
                                         $('#allotappointmentuser').attr('href',base_url+'/user-profile-details/'+obj.user_id);
                                         //$('#appointment_allot').find('input[name="user_name"]').val(obj.user_name);
                                         $('#appointment_allotment').modal('show');
                                        }
                                       

                                    }
                                });
                           }

                           if(event.title == "Appointment Completed"){
                             let start_date_time =  moment(event.start).format('YYYY-MM-DD HH:mm:ss');
                             let user_detail = event.user_id
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }); 
                                $.ajax({
                                    method: 'POST',
                                    data: {start:start_date_time,user_detail:user_detail},
                                    url:  base_url+'/appointment-completed',
                                    beforeSend: function(){
                                        $('#preloader').show();
                                    },
                                    success: function(data){
                                        $('#preloader').hide();
                                        var obj = JSON.parse(data);
                                        if(obj){
                                         //console.log(obj);

                                         let date_time = obj.date.split(' ');
                                         //console.log(date_time);
                                         $('#appointment_completed').find('input[name="user_name"]').val(obj.user_name);
                                         $('#appointment_completed').find('input[name="appointment_date"]').val(date_time[0]);
                                         $('#appointment_completed').find('select[name="appointment_time"]').html(obj.start);
                                         $('#appointment_completed').find('input[name="booking_id"]').val(obj.booking_id);
                                         $('#appointment_completed').find('input[name="booking_id"]').attr('data-id',obj.booking_id);
                                         $('#appointment_completed').find('select[name="coach"]').html(obj.coach_details);

                                         //$('#appointment_alloted').find('select').html(obj.coach_details);
                                         //console.log(obj.user_img);
                                         if(obj.user_img){
                                            let path = base_url+'/'+obj.user_img;
                                            $('#user_image ').attr('src',path);
                                            //console.log(path);
                                         }else{
                                            let path = base_url+'/img/user1-128x128.jpg';
                                            $('#user_image ').attr('src',path);
                                         }
                                         $('#appointmentcompleteduser').attr('href',base_url+'/user-profile-details/'+obj.user_id);
                                         $('#appointment_completed').modal('show');
                                            // $('#calendar').fullCalendar('removeEvents');
                                            // $('#calendar').fullCalendar('addEventSource',events);
                                        }
                                       

                                    }
                                });
                           }
                        
                      },
            });

            /* coach calander */
            // $('#coach_calendar').fullCalendar({                
            //         header: {
            //             left: 'prev,next today',
            //             center: 'title',
            //             right: 'month,basicWeek,basicDay'
            //         },
            //         editable: true,
            //         eventLimit: true, // allow "more" link when too many events
            //         droppable: false, // this allows things to be dropped onto the calendar !!!
            //             drop: function(date, allDay) { // this function is called when something is dropped

            //                 // retrieve the dropped element's stored Event Object
            //                 var originalEventObject = $(this).data('eventObject');

            //                 // we need to copy it, so that multiple events don't have a reference to the same object
            //                 var copiedEventObject = $.extend({}, originalEventObject);

            //                 // assign it the date that was reported
            //                 copiedEventObject.start = date;
            //                 copiedEventObject.allDay = allDay;

            //                 // render the event on the calendar
            //                 // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            //                 $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            //                 // is the "remove after drop" checkbox checked?
            //                 if ($('#drop-remove').is(':checked')) {
            //                     // if so, remove the element from the "Draggable Events" list
            //                     $(this).remove();
            //                 }

            //             },
            //         customButtons: {
            //             Available: {
            //               text: 'Availablility',
            //               click: function () {
            //                 var opened_month = $('#coach_calendar .fc-center h2').text();
            //                 //console.log(opened_month);
            //                 $(this).parent('div').find('button').removeClass('fc-state-active');
            //                 $(this).addClass("fc-state-active");
            //                 // $('#coach_calendar').fullCalendar('removeEvents');
            //                 // $('#coach_calendar').fullCalendar();
            //                 // console.log('available');
            //                 //$('#coach_calendar').fullCalendar('renderEvents',events);

            //               }
            //             },
            //             Appointments: {
            //               text: 'Appointments',
            //               click: function () {
            //                 console.log('appointments');
            //                 $(this).parent('div').find('button').removeClass('fc-state-active');
            //                 $(this).addClass("fc-state-active");
            //                 // $('#coach_calendar').fullCalendar('removeEvents');
            //                 // $('#coach_calendar').fullCalendar();

            //               }
            //             }
            //           },                      
            //           dayClick: function (date, jsEvent, view) {
            //             var date = moment(date).format('YYYY-MM-DD');
            //             var current = moment();
            //             let today_date = current.format("YYYY-MM-DD");                        
            //             if(new Date(date) < new Date(today_date)){
            //                alert('Cannot select previous date !');
            //             }else{
            //                 $('#appointment_availibility').find('input[name="available_date"]').val(date);
            //                 $('#appointment_availibility').modal('show');
            //             }
                       
            //           },
            //          eventClick: function(event) {
            //             //$(this).parent('div').find('button').removeClass('fc-state-active');
            //           // console.log(event);
            //           // console.log(event.coach_id);
            //           let select_date = moment(event.start).format('YYYY-MM-DD');
            //           let current = moment();
            //           let today_date = current.format("YYYY-MM-DD");
            //           let title = event.title;
            //           if(new Date(select_date) < new Date(today_date)){                               
            //                if(event.coach_id){
            //                     if(title == "Scheduled Appointment"){
            //                         $.ajaxSetup({
            //                             headers: {
            //                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                             }
            //                         }); 
            //                         $.ajax({
            //                             method: 'POST',
            //                             data: {details:event.coach_id,appointment_id : event.appointment_id },
            //                             url:  base_url+'/get-coach-appointment',
            //                             beforeSend: function(){
            //                                 $('#preloader').show();
            //                             },
            //                             success: function(data){
            //                                 $('#preloader').hide();
            //                                  let details = JSON.parse(data);
            //                                   if(details){
            //                                         $('#call_started_success').remove();
            //                                         $('#call_started').remove();
            //                                         $('#startcall').hide();
            //                                         $('#appointment_display').find('input[name="user_name"]').val(details.name);
            //                                         $('#appointment_display').find('input[name="appointment_date"]').val(details.date);
            //                                         $('#appointment_display').find('input[name="appointment_time"]').val(details.start);
            //                                         $('#appointment_display').find('input[name="booking_id"]').val(details.booking_id);
            //                                         $('#appointment_display').find('input[name="booking_id"]').attr('data-id',details.booking_id);
            //                                         if(details.profile_img){
            //                                             let path = base_url+'/'+details.profile_img;
            //                                             $('#appoint_user_image').attr('src',path);
            //                                             //console.log(path);
            //                                         }else{
            //                                             let path = base_url+'/img/user1-128x128.jpg';
            //                                             $('#appoint_user_image ').attr('src',path);
            //                                         } 
            //                                         // let new_urlll = base_url+'/user-profile-details/'+details.user_id;
            //                                         // console.log(new_urlll);
            //                                         $('#coachappointmentuser').attr('href',base_url+'/user-profile-details/'+details.user_id);                                                  
            //                                         $('#appointment_show').modal('show');                                             
            //                                   }
            //                             }
            //                         });
            //                     }
                                
            //                }else{
            //                   alert('Cannot select previous date !');
            //                }



            //             }else{
            //                 if(event.coach_id){
            //                     if(title == "Available"){
            //                         //console.log(title);
            //                         $.ajaxSetup({
            //                             headers: {
            //                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                             }
            //                         }); 
            //                         $.ajax({
            //                             method: 'POST',
            //                             data: {details:event.coach_id},
            //                             url:  base_url+'/get-avaibility-coach-details',
            //                             beforeSend: function(){
            //                                 $('#preloader').show();
            //                             },
            //                             success: function(data){
            //                                  $('#preloader').hide();
            //                                  var details = JSON.parse(data);
            //                                   if(details){
            //                                        // console.log(details);
            //                                         $('#availibility_update').find('input[name="available_date"]').val(details.date);
            //                                         $('#availibility_update').find('input[name="available_start_time"]').val(details.start);
            //                                         $('#availibility_update').find('input[name="available_end_time"]').val(details.end);
            //                                         $('#availibility_update').find('input[name="details"]').val(details.row_id);
            //                                         $('#update_appointment_availibility').modal('show');
                                             
            //                                   }
            //                             }
            //                         });
            //                     }else if(title == "Scheduled Appointment"){
            //                         //console.log(event);
            //                         $.ajaxSetup({
            //                             headers: {
            //                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                             }
            //                         }); 
            //                         $.ajax({
            //                             method: 'POST',
            //                             data: {details:event.coach_id,appointment_id : event.appointment_id },
            //                             url:  base_url+'/get-coach-appointment',
            //                             beforeSend: function(){
            //                                 $('#preloader').show();
            //                             },
            //                             success: function(data){
            //                                 $('#preloader').hide();
            //                                  let details = JSON.parse(data);
            //                                   if(details){
            //                                         $('#call_started_success').remove();
            //                                         $('#call_started').remove();
            //                                         $('#appointment_display').find('input[name="user_name"]').val(details.name);
            //                                         $('#appointment_display').find('input[name="appointment_date"]').val(details.date);
            //                                         $('#appointment_display').find('input[name="appointment_time"]').val(details.start);
            //                                         $('#appointment_display').find('input[name="booking_id"]').val(details.booking_id);
            //                                         $('#appointment_display').find('input[name="booking_id"]').attr('data-id',details.booking_id);
            //                                         if(details.profile_img){
            //                                             let path = base_url+'/'+details.profile_img;
            //                                             $('#appoint_user_image').attr('src',path);
            //                                             //console.log(path);
            //                                         }else{
            //                                             let path = base_url+'/img/user1-128x128.jpg';
            //                                             $('#appoint_user_image ').attr('src',path);
            //                                         }

            //                                          $('#coachappointmentuser').attr('href',base_url+'/user-profile-details/'+details.user_id);
            //                                         //console.log(details);
            //                                         if(details.status == 1){
            //                                             //console.log('yes  ut not work');
            //                                             $('#startcall').hide();
            //                                         }else{
            //                                             $('#startcall').show();
            //                                         }
            //                                         $('#appointment_show').modal('show');                                             
            //                                   }
            //                             }
            //                         });
            //                     }else if(title == "Appointment Completed"){
            //                          //console.log(event);
            //                         $.ajaxSetup({
            //                             headers: {
            //                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                             }
            //                         }); 
            //                         $.ajax({
            //                             method: 'POST',
            //                             data: {appointment_id : event.appointment_id },
            //                             url:  base_url+'/get-coach-completed-appointment',
            //                             beforeSend: function(){
            //                                 $('#preloader').show();
            //                             },
            //                             success: function(data){
            //                                 $('#preloader').hide();
            //                                 //console.log(data);
            //                                  let details = JSON.parse(data);
            //                                   if(details){                                                   
            //                                         $('#coach_appointment_complete').find('input[name="user_name"]').val(details.name);
            //                                         $('#coach_appointment_complete').find('input[name="appointment_date"]').val(details.date);
            //                                         $('#coach_appointment_complete').find('input[name="appointment_time"]').val(details.start);
            //                                         $('#coach_appointment_complete').find('input[name="booking_id"]').val(details.booking_id);
            //                                         $('#coach_appointment_complete').find('input[name="booking_id"]').attr('data-id',details.booking_id);
            //                                         if(details.profile_img){
            //                                             let path = base_url+'/'+details.profile_img;
            //                                             $('#user_image').attr('src',path);
            //                                             //console.log(path);
            //                                         }else{
            //                                             let path = base_url+'/img/user1-128x128.jpg';
            //                                             $('#user_image ').attr('src',path);
            //                                         }

            //                                         $('#coachappointmentcompleteduser').attr('href',base_url+'/user-profile-details/'+details.user_id);
                                                    
            //                                         $('#coach_appointment_completed').modal('show');                                             
            //                                   }
            //                             }
            //                         });
            //                     }
                                
            //                }
            //             }
            //           },
            //         viewRender: function(event,view, element){
            //             let date_start = moment(event.start).format('YYYY-MM-DD');
            //             let date_end = moment(event.end).format('YYYY-MM-DD');
            //             $.ajaxSetup({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 }
            //             }); 
            //             $.ajax({
            //                 method: 'POST',
            //                 data: {start:date_start,end:date_end},
            //                 url:  base_url+'/coachavailable',
            //                 beforeSend: function(){
            //                     $('#preloader').show();
            //                 },
            //                 success: function(data){
            //                    //console.log(data);
            //                     $('#preloader').hide();
            //                     var obj = JSON.parse(data);
            //                     if(obj){
            //                       var events = [];
            //                       $(obj).each(function() {
            //                             events.push({
            //                                 title: $(this).attr('title'),
            //                                 start: $(this).attr('start'),
            //                                 coach_id: $(this).attr('coach_id'),
            //                                 color: $(this).attr('color'),
            //                                 appointment_id: $(this).attr('appointment_id'),
            //                             });
            //                         });
            //                        // console.log(events);
            //                         $('#coach_calendar').fullCalendar('removeEvents');
            //                         $('#coach_calendar').fullCalendar('addEventSource',events);
            //                     }

            //                 }
            //             });

                        
                        
            //         },
            // });
            
             /*Add new event*/
            // Form to add new event

            $("#add_event_form").on('submit', function(ev) {
                ev.preventDefault();

                var $event = $(this).find('.new-event-form'),
                    event_name = $event.val();

                if (event_name.length >= 3) {

                    var newid = "new" + "" + Math.random().toString(36).substring(7);
                    // Create Event Entry
                    $("#external-events").append(
                        '<div id="' + newid + '" class="fc-event">' + event_name + '</div>'
                    );


                    var eventObject = {
                        title: $.trim($("#" + newid).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $("#" + newid).data('eventObject', eventObject);

                    // Reset draggable
                    $("#" + newid).draggable({
                        revert: true,
                        revertDuration: 0,
                        zIndex: 999
                    });

                    // Reset input
                    $event.val('').focus();
                } else {
                    $event.focus();
                }
            });

        }
        else {
            alert("Calendar plugin is not installed");
        }
    },
    //init
    $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
    $('.available_start_time').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '00',
        maxTime: '23:30',
        defaultTime: '6',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
    });


    // $("#available_start_time").blur(function(e) {
    //    setTimeout(function(){ 
    //         let entered_time = $(e.target).val();
    //         var entered_split = entered_time.split(':');
    //         var time = moment(entered_split[0]+':'+entered_split[1],'HH:mm');
    //         time.add(1,'h');
    //         $('#available_end_time').val(time.format("HH:mm"));
    //         //console.log();
    //     }, 100);
    // });
    
}
(window.jQuery),


//initializing 
function($) {
    "use strict";
    $.CalendarPage.init()
}(window.jQuery);


 
});