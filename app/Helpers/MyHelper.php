<?php 

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Logs;


 function createLog($user_id,$activity_id,$description,$event_time,$event_type){   
   $log = new Logs;
   $log->user_id = $user_id;
   $log->activity_id = $activity_id;
   $log->description = $description;
   $log->event_time = $event_time;
   $log->event_type = $event_type;
   $log->save();
   return true;

}

?>

