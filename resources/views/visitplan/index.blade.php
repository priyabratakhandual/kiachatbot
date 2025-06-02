@extends('layouts.app')
  
@section('content')

  
			<div class="page-wrapper">
				<div class="container-fluid">

					<!-- Row -->
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default card-view">
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="calendar-wrap mt-40">
										  <div id="calendar"></div>
										</div>
									</div>
								</div>
							</div>	
						</div>	
					</div>	
						<!-- /Row -->
				</div>
				
				<!-- Footer -->
				<footer class="footer container-fluid pl-30 pr-30">
					<div class="row">
						<div class="col-sm-12">
							<p>2018 &copy; Grandin. Pampered by Hencework</p>
						</div>
					</div>
				</footer>
				<!-- /Footer -->
				
			</div>

<div class="modal fade" id="adminappointment_availibility" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Visit Plan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>                    
      <!-- Modal body -->
      <div class="modal-body">
         <form id="adminavailibility_save">
             <div class="row">
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Visit Date</label>
                 </div>
                 <div class="col-md-9">
                   <input type="date" name="visit_planned_date" min="{{ date('Y-m-d') }}" class="form-control">
                 </div>
               </div>
              </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Dealer Unique Code</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Dealer Code</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Region</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>for code</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Outlet Code</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Dealer Map Code</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Location Map Code</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Dealer Name</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Location Address</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>City</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Location Type</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="" id="" value="" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Agenda of visit</label>
                 </div>
                 <div class="col-md-9">
                   <textarea name="" id="" value="" class="form-control"></textarea>
                 </div>
               </div>
             </div>

             <div class="form-group col-md-12" style="padding-top: 5px;">
               <div class="float-right">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button class="btn btn-success" >Save</button>
               </div> 
             </div>
           </div>
         </form>
      </div>
    </div>
  </div>
</div>

           
<div class="modal fade" id="appointment_booking" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" width="150" height="150"></a>
        <a href="#" id="appointmentbookinguser" target="_blank" class="view">View</a>
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form>
         <div class="row">
           <div class="form-group col-md-12">
           <div class="row">
             <div class="col-md-2">
               <label>Name</label>
             </div>
             <div class="col-md-10">
               <input type="text" name="" class="form-control">
             </div>
           </div> 
         </div>
         <div class="form-group col-md-6">
           <div class="row">
             <div class="col-md-3">
               <label>Appointment Date</label>
             </div>
             <div class="col-md-9">
               <input type="date" name="" class="form-control">
             </div>
           </div>
         </div>
         <div class="form-group col-md-6">
           <div class="row">
             <div class="col-md-3">
               <label>Coach Name</label>
             </div>
             <div class="col-md-9">
               <input type="text" name="" class="form-control">
             </div>
           </div> 
         </div>
         <div class="form-group col-md-12" style="padding-top: 5px;">
           <div class="float-right">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
             <button class="btn btn-success">Save</button>
           </div> 
         </div>
         </div>
       </form>
      </div>      
    </div>
  </div>
</div>


<div class="modal fade" id="appointment_allotment" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="user_image" width="150" height="150"></a>
        <a href="#" id="allotappointmentuser" target="_blank" class="view">View</a>
        <h4 class="modal-title">Allot Appointment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="appointment_allot">
         <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>User Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="user_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" class="form-control" disabled>
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="appointment_time"  class="form-control" disabled>
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Select Coach</label>
               </div>
               <div class="col-md-9">
                 <select class="form-control" name="coach">
                 </select>
               </div>
             </div> 
           </div>                        
           <input type="hidden" name="booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button class="btn btn-success">Confirm</button>
             </div> 
           </div>
         </div>
       </form>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="appointment_alloted" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="user_image" width="150" height="150"></a>
        <a href="#" id="bookedappointmentuser" target="_blank" class="view">View</a>
        <h4 class="modal-title">Booked Appointment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="appointment_reschedule">
         <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>User Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="user_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="reschedule_appointment_date" min="{{ date('Y-m-d') }}" class="form-control">
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                <select id="reschedule_appointment_time" name="reschedule_appointment_time" class="form-control">
                </select>
                
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Select Coach</label>
               </div>
               <div class="col-md-9">
                 <select class="form-control" name="coach" id="reschedule_coach">
                 </select>
               </div>
             </div> 
           </div>
           <input type="hidden" name="booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button class="btn btn-success">Confirm</button>
             </div> 
           </div>
         </div>
       </form>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="appointment_completed" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="user_image" width="150" height="150"></a>
        <a href="#" id="appointmentcompleteduser" target="_blank" class="view">View</a>
        <h4 class="modal-title">Appointment Completed</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="appointment_complete">
         <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>User Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="user_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" class="form-control">
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                <select id="appointment_time" name="appointment_time" class="form-control">
                </select>
                
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Select Coach</label>
               </div>
               <div class="col-md-9">
                 <select class="form-control" name="coach" id="reschedule_coach">
                 </select>
               </div>
             </div> 
           </div>
           <input type="hidden" name="booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>                             
             </div> 
           </div>
         </div>
       </form>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="appointment_edit" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="appointment_availibility" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Availability</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>                    
      <!-- Modal body -->
      <div class="modal-body">
         <form id="availibility_save">
             <div class="row">
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Available Date</label>
                 </div>
                 <div class="col-md-9">
                   <input type="date" name="available_date" min="{{ date('Y-m-d') }}" class="form-control">
                 </div>
               </div>
             </div>
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Time Slots</label>
                 </div>
                 <div class="col-md-9">
                   <select id="available_times" name="dates[]" multiple="multiple">
                    <option value="00:00-01:00">12:00 AM - 01:00 AM</option>
                    <option value="01:00-02:00">01:00 AM - 02:00 AM</option>
                    <option value="02:00-03:00">02:00 AM - 03:00 AM</option>
                    <option value="03:00-04:00">03:00 AM - 04:00 AM</option>
                    <option value="04:00-05:00">04:00 AM - 05:00 AM</option>
                    <option value="05:00-06:00">05:00 AM - 06:00 AM</option>
                    <option value="06:00-07:00">06:00 AM - 07:00 AM</option>
                    <option value="07:00-08:00">07:00 AM - 08:00 AM</option>
                    <option value="08:00-09:00">08:00 AM - 09:00 AM</option>
                    <option value="09:00-10:00">09:00 AM - 10:00 AM</option>
                    <option value="10:00-11:00">10:00 AM - 11:00 AM</option>
                    <option value="11:00-12:00">11:00 AM - 12:00 PM</option>
                    <option value="12:00-13:00">12:00 PM - 01:00 PM</option>
                    <option value="13:00-14:00">01:00 PM - 02:00 PM</option>
                    <option value="14:00-15:00">02:00 PM - 03:00 PM</option>
                    <option value="15:00-16:00">03:00 PM - 04:00 PM</option>
                    <option value="16:00-17:00">04:00 PM - 05:00 PM</option>
                    <option value="17:00-18:00">05:00 PM - 06:00 PM</option>
                    <option value="18:00-19:00">06:00 PM - 07:00 PM</option>
                    <option value="19:00-20:00">07:00 PM - 08:00 PM</option>
                    <option value="20:00-21:00">08:00 PM - 09:00 PM</option>
                    <option value="21:00-22:00">09:00 PM - 10:00 PM</option>
                    <option value="22:00-23:00">10:00 PM - 11:00 PM</option>
                    <option value="23:00-00:00">11:00 PM - 12:00 AM</option>
                  </select>
                 </div>
               </div>
             </div>
{{--              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Start Time</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="available_start_time" id="available_start_time" class="form-control available_start_time">
                 </div>
               </div>
             </div>
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>End Time</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="available_end_time" id="available_end_time" class="form-control available_end_time" disabled>
                 </div>
               </div> 
             </div> --}}
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Your TimeZone</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" class="form-control" value=""disabled>                  
                 </div>
               </div> 
             </div>
             <div class="form-group col-md-12" style="padding-top: 5px;">
               <div class="float-right">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button class="btn btn-success" >Save</button>
               </div> 
             </div>
           </div>
         </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update_appointment_availibility" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Availability</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>                    
      <!-- Modal body -->
      <div class="modal-body">
         <form id="availibility_update">
             <div class="row">
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Available Date</label>
                 </div>
                 <div class="col-md-9">
                   <input type="date" name="available_date" min="{{ date('Y-m-d') }}" class="form-control">
                 </div>
               </div>
             </div>
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Start Time</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="available_start_time" id="updateavailable_start_time" class="form-control available_start_time">
                 </div>
               </div>
             </div>
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>End Time</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="available_end_time" id="updateavailable_end_time" class="form-control available_end_time" disabled>
                 </div>
               </div> 
             </div>
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Your TimeZone</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" class="form-control" value=""disabled>                  
                 </div>
               </div> 
             </div>
            <input type="hidden" name="details" id="details_row" class="form-control details_row" disabled>
             <div class="form-group col-md-12" style="padding-top: 5px;">
               <div class="float-right">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button class="btn btn-success">Update</button>
               </div> 
             </div>
           </div>
         </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="appointment_show" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="appoint_user_image" width="150" height="150"></a>
        <a href="#" id="coachappointmentuser" target="_blank" class="view">View</a>
        <h4 class="modal-title">Appointment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="appointment_display" action="javascript:void(0)">
          <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>User Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="user_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" class="form-control">
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="appointment_time" class="form-control">
               </div>
             </div>
           </div>                         
           <input type="hidden" name="booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">
              <button id="startcall" class="btn btn-success">Start Call</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
             </div> 
           </div>
         </div>
       </form>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="adminupdate_appointment_availibility" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Availability</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>                    
      <!-- Modal body -->
      <div class="modal-body">
         <form id="adminavailibility_update">
             <div class="row">
              <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Available Date</label>
                 </div>
                 <div class="col-md-9">
                   <input type="date" name="available_date" min="{{ date('Y-m-d') }}" class="form-control">
                 </div>
               </div>
             </div>
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Start Time</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="available_start_time" id="updateadminavailable_start_time" class="form-control available_start_time">
                 </div>
               </div>
             </div>
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>End Time</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" name="available_end_time" id="updateadminavailable_end_time" class="form-control available_end_time" disabled>
                 </div>
               </div> 
             </div>
             <div class="form-group col-md-6">
               <div class="row">
                 <div class="col-md-3">
                   <label>Your TimeZone</label>
                 </div>
                 <div class="col-md-9">
                   <input type="text" class="form-control" value=""disabled>                  
                 </div>
               </div> 
             </div>
            <input type="hidden" name="details" id="details_row" class="form-control details_row" disabled>
             <div class="form-group col-md-12" style="padding-top: 5px;">
               <div class="float-right">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button class="btn btn-success">Update</button>
               </div> 
             </div>
           </div>
         </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="coach_appointment_completed" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="user_image" width="150" height="150"></a>
        <a href="#" id="coachappointmentcompleteduser" target="_blank" class="view">View</a>
        <h4 class="modal-title">Appointment Completed</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="coach_appointment_complete">
         <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>User Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="user_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" class="form-control">
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                <input type="text" class="form-control" name="appointment_time"  class="form-control">
               </div>
             </div>
           </div>                        
           <input type="hidden" name="booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>                             
             </div> 
           </div>
         </div>
       </form>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="become_coach_appointment" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="become_coach_user_image" width="150" height="150"></a>
        <a href="#" id="becomecoachappointment" target="_blank" class="view">View</a>
        <h4 class="modal-title">Coach Appointment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="become_coach_appointment_details">
         <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Coach Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="become_coach_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="become_coach_appointment_date"  class="form-control" disabled>
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                <input type="text" class="form-control" name="become_coach_appointment_time"  class="form-control">
               </div>
             </div>
           </div>                        
           <input type="hidden" name="become_coach_booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">
               <button class="btn btn-success" id="become_coach_button">Become Coach</button>  
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>  

             </div> 
           </div>
         </div>
       </form>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="become_coach_appointment_completed" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="become_coach_user_completed_image" width="150" height="150"></a>
        <a href="#" id="becomecoachappointmentcompleted" target="_blank" class="view">View</a>
        <h4 class="modal-title">Coach Appointment Completed</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="become_coach_appointment_completed_details">
         <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Coach Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="become_coach_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="become_coach_appointment_date"  class="form-control" disabled>
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                <input type="text" class="form-control" name="become_coach_appointment_time"  class="form-control">
               </div>
             </div>
           </div>                        
           <input type="hidden" name="become_coach_booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">                
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>  

             </div> 
           </div>
         </div>
       </form>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="academy_appointment" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <a href="#"><img src="{{ asset('img/user1-128x128.jpg') }}" id="academy_user_image" width="150" height="150"></a>
        <a href="#" id="academyappointment" target="_blank" class="view">View</a>
        <h4 class="modal-title">Academy Appointment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
       <form id="academy_appointment_details">
         <div class="row">
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>User Name</label>
               </div>
               <div class="col-md-9">
                 <input type="text" name="academy_name" class="form-control">
               </div>
             </div> 
            </div>
            <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Date</label>
               </div>
               <div class="col-md-9">
                 <input type="date" name="academy_appointment_date"  class="form-control" disabled>
               </div>
             </div>
           </div>
           <div class="form-group col-md-6">
             <div class="row">
               <div class="col-md-3">
                 <label>Appointment Time</label>
               </div>
               <div class="col-md-9">
                <input type="text" class="form-control" name="academy_appointment_time"  class="form-control">
               </div>
             </div>
           </div>                        
           <input type="hidden" name="academy_booking_id" data-id="" value="">
           <div class="form-group col-md-12" style="padding-top: 5px;">
             <div class="float-right">
               <button class="btn btn-success" id="academy_button">End Appointment</button>  
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>  
             </div> 
           </div>
         </div>
       </form>
      </div>
    </div>
  </div>
</div>
           


@endsection