<?php

namespace App\Helpers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Validator;
use Carbon\Carbon;
use App\Admin;
use App\Activity;
use App\Logs;
use App\Dealer_master;
use App\Attendie;
use DataTables;
use App\Feedback;
use App\TicketFeedback;
use App\DeactiveAttendence;
use App\Exports\FeedbackExport;
use Maatwebsite\Excel\Facades\Excel;

class ActivityPlanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    return redirect('/login');
  }



  public function activityTable(Request $request)
  {
   

    $startDate = $request->get('from');
    $endDate = $request->get('to');

    $query = Activity::orderby('plan_date_start', 'DESC');
    

    if (Session::get('user_details')[0]['role'] == 'trainee') {
      $query->where('trainer_id', Session::get('user_details')[0]['user_id']);
    }


    if ($startDate && $endDate) {
      $query->whereDate('plan_date_start', '>=', Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d'))
        ->whereDate('plan_date_start', '<=', Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d'));
    }


    return DataTables::of($query)
      
      ->addColumn("check", function ($query) {
        return "";
      })
      ->addColumn("activity_id", function ($query) {
        return $query->activity_id;
      })
      ->addColumn('activity_date_from', function ($query) {
        return date('d-m-Y', strtotime(explode(',', $query->plan_date)[0]));
      })
      ->addColumn('activity_date_to', function ($query) {
        return date('d-m-Y', strtotime(explode(',', $query->plan_date)[count(explode(',', $query->plan_date)) - 1]));
      })
      ->addColumn('activity_date', function ($query) {
        return $query->plan_date;
      })
      ->addColumn('activity_type', function ($query) {
        return $query->activity_type;
      })
      ->addColumn('region', function ($query) {
        return $query->region;
      })
      ->addColumn('remarks', function ($query) {
        return $query->remarks;
      })
      ->addColumn('dealer_code', function ($query) {
        return $query->dealer_code;
      })
      ->addColumn('module', function ($query) {
        return $query->module;
      })
      ->addColumn('trainer_name', function ($query) {
        return $query->trainer_name;
      })
      ->addColumn('attendance_sta', function ($query) {
        return (($query->attendance) ? 'Yes' : '-');
      })
      ->addColumn('site_readiness_sta', function ($query) {
        return (($query->site_readiness) ? 'Yes' : '-');
      })
      ->addColumn('speed_test_sta', function ($query) {
        return (($query->speed_test) ? 'Yes' : '-');
      })
      ->addColumn('sign_off_doc_sta', function ($query) {
        return (($query->sign_off_doc) ? 'Yes' : '-');
      })
      ->addColumn('training_pics_sta', function ($query) {
        return (($query->training_pics) ? 'Yes' : '-');
      })
      ->addColumn('other_doc_sta', function ($query) {
        return (($query->other_doc) ? 'Yes' : '-');
      })
      ->addColumn('no_of_men_days', function ($query) {
        return (($query->no_of_men_days) ? $query->no_of_men_days : '-');
      })
      ->addColumn('no_of_participant', function ($query) {
        return (($query->no_of_participant) ? $query->no_of_participant : '-');
      })
      ->addColumn('training_type', function ($query) {
        return (($query->training_type) ? $query->training_type : '-');
      })
      ->addColumn('status', function ($query) {
        $a = '';
        switch ($query->status) {
          case 'Open':
            $a = '<span class="label label-info">' . $query->status . '</span>';
            break;
          case 'Rescheduled':
            $a = '<span class="label label-primary">' . $query->status . '</span>';
            break;
          case 'Cancelled':
            $a = '<span class="label label-default">' . $query->status . '</span>';
            break;
          case 'Closed':
            $a = '<span class="label label-danger">' . $query->status . '</span>';
            break;
        }
        return $a;
      })
      ->addColumn('action', function ($query) {
        $a = '';
        if ($query->status == 'Closed') {
          $a = '<a data-toggle="tooltip" title="ACTIVITY VIEW" href="' . URL::to('/activity_details_view') . '/' . base64_encode($query->id) . '" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';
        } else {
          $a = '<a href="' . URL::to('/activity') . '/' . base64_encode($query->id) . '" class="mr-10" data-toggle="tooltip" title="UPDATE" ><i class="fa fa-pencil text-inverse m-r-10"></i></a><a data-toggle="tooltip" title="ACTIVITY EDIT" href="' . URL::to('/activity_details_update') . '/' . base64_encode($query->id) . '" ><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a>';
        }
        return $a;
      })
      ->editColumn('id', 'ID: {{$id}}')
      ->escapeColumns([])
      ->addIndexColumn()->make(true);
  }

  public function add_dealer(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'region' => 'required',
      'dealer_code_add' => 'required',
      'dealer_name' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'status' => 0,
        'message' => $validator->errors()
      ]);
    } else {

      $dealer = new Dealer_master;
      $dealer->Region = $request->region;
      $dealer->Dealer_code = $request->dealer_code_add;
      $dealer->Dealership_Name = $request->dealer_name;
      if ($dealer->save()) {

        return response()->json([
          'status' => 1,
          'message' => 'success'
        ]);
      } else {

        return response()->json([
          'status' => 0,
          'message' => 'error'
        ]);
      }
    }
  }

  public function fileUploadBatch(Request $request)
  {

    $file_name = '';
    $location = '';
    if ($request->file('file-3')) {
      $file = $request->file('file-3');
      $location = base_path('storage/documents/activity_info/' . $request->activity_id . '/' . $request->title);
      $file->move($location, $file->getClientOriginalName());
      $file_name = $file->getClientOriginalName();
    }

    $title = $request->title;

    $activity = Activity::find($request->activity_id);
    $arr = explode('|||', $activity->$title);
    array_push($arr, $file_name);
    $str = implode('|||', $arr);
    $activity->$title = $str;
    $activity->save();

    return response()->json(['uploaded' => $location . '/' . $file_name]);
  }

  function endsWith($haystack, $needle)
  {
    $length = strlen($needle);
    if (!$length) {
      return true;
    }
    return substr($haystack, -$length) === $needle;
  }

  public function fetch_docs(Request $request)
  {

    $title = $request->title;

    $activity =  Activity::find($request->activity_id);
    $arr = explode('|||', $activity->$title);
    $initPrevArr = [];
    $initPrevConfArr = [];
    for ($i = 0; $i < count($arr); $i++) {
      if ($arr[$i]) {

        $file = 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' . $request->activity_id . '/' . $title . '/' . $arr[$i];

        $headers = get_headers($file, true);

        $object = new \stdClass();
        $object->caption = $arr[$i];
        $object->downloadUrl = '{$url}';
        $object->size = $headers['Content-Length'];
        $object->url = 'https://kia.chatbot.inhelpdesk.com/public/file-delete/' . $title . '/' . base64_encode($request->activity_id) . '/' . base64_encode($arr[$i]);
        $object->key = $i;

        if ($this->endsWith($file, 'pdf')) {
          $object->type = 'pdf';
        } elseif ($this->endsWith($file, 'jpg') || $this->endsWith($file, 'jpeg') || $this->endsWith($file, 'png') || $this->endsWith($file, 'jpe')) {
          $object->type = 'image';
        } elseif ($this->endsWith($file, 'txt') || $this->endsWith($file, 'html') || $this->endsWith($file, 'php') || $this->endsWith($file, 'js')) {
          $object->type = 'text';
        } elseif ($this->endsWith($file, 'mp4')) {
          $object->type = 'video';
          $object->filetype = "video/mp4";
        } else {
          $object->type = 'other';
        }

        array_push($initPrevArr, $file);
        array_push($initPrevConfArr, $object);
      }
    }

    return response()->json([
      'initPrevArr' => $initPrevArr,
      'initPrevConfArr' => $initPrevConfArr
    ]);
  }

  public function file_delete(Request $request, $file_type, $activity_id, $file_name)
  {

    $activity = Activity::find(base64_decode($activity_id));
    $arr = explode('|||', $activity->$file_type);

    $location = base_path('storage/documents/activity_info/' . base64_decode($activity_id) . '/' . $request->file_type);

    unlink($location . '/' . $arr[$request->key]);
    unset($arr[$request->key]);

    $str = implode('|||', $arr);
    $activity->$file_type = $str;
    $activity->save();

    return response()->json(['message' => 'deleted']);
  }

  public function create()
  {
    $data['trainers'] = Admin::select('id', 'name', 'email')->where('role', '2')->get();
    $data['dealers'] = Dealer_master::all();
    return view('activity.create', $data);
  }

  public function activity_details_update(Request $request, $id)
  {
    // dd(base64_decode($id));
    // dd($id);
    $Checkdata = feedback::with('attendie')->get();
    // dd($Checkdata);

    $data['trainers'] = Admin::where('role', 2)->get();
    $data['details'] = Activity::find(base64_decode($id));
    $data['logs'] = Logs::where('activity_id', base64_decode($id))->orderby('event_time', 'Desc')->get();
    $data['closed'] = false;
    // dd($data['details']->id);
    $data['attendies'] = Attendie::where('activity_id', $data['details']->id)->get();
    $data['generatedUrl'] = url('/') . '/attendance_form/' . $id;
    $data['attendieAll'] = Attendie::all()->pluck('id');
    // dd($data['details']->id);
     
     $data['remarks'] = Feedback::where(['activity_id' => $data['details']->id, 'question_id' => 7])->get();
     
    // dd($data['remarks']);
    $encodedActivityId = $id;
    $decodedActivityId = base64_decode($encodedActivityId);
    $data['countAttendie'] = Attendie::where('activity_id', $decodedActivityId)->get()->count();
    // dd($data['countAttendie']);

    $data['checkStatus'] = DeactiveAttendence::where(['activity_id' => $decodedActivityId, 'status' => '1'])->first(); 
    

    if ($data['trainers'] && $data['details']) {
      return view('activity.activity_update', $data, compact('encodedActivityId'));
    } else {
      return redirect('/login');
    }
  }

  public function activity_details_view(Request $request, $id)
  {

    $data['trainers'] = Admin::where('role', 2)->get();
    $data['details'] = Activity::find(base64_decode($id));
    $data['logs'] = Logs::where('activity_id', base64_decode($id))->orderby('event_time', 'Desc')->get();
    $data['closed'] = true;
    if ($data['trainers'] && $data['details'])
      return view('activity.activity_view', $data);
    else
      return redirect('/login');
  }

  public function activityUpdate(Request $request)
  {


    // if($request->status == 'Rescheduled' && !$request->reschedule_date){

    //      return response()->json([
    //          'message' => 'Please enter reschedule date',
    //          'status' => 0
    //      ]);   

    // }


    // $attendance = '';
    // $site_readliness = '';
    // $speed_test = '';
    // $sign_off_docs = '';
    // $training_photos = '';
    // $other_docs = '';


    $activity = Activity::find($request->activity_id);
    $activity->no_of_participant = $request->no_of_participant;
    if ($activity->status !== $request->status) {
      createLog(Session::get('user_details')[0]['user_id'], $activity->id, 'Status changed, from ' . $activity->status . ' to ' . $request->status . ' by ' . Session::get('user_details')[0]['user_name'], date('Y-m-d H:i:s'), 'UPDATED');
      $activity->status = $request->status;
    }
    $activity->save();



    return response()->json([
      'message' => 'success',
      'status' => 1
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  function date_sort($a, $b)
  {
    return strtotime($a) - strtotime($b);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'plan_date' => 'required',
      'activity_type' => 'required',
      // 'activity_date' => 'required',
      'region' => 'required',
      'dealer_code' => 'required',
      'trainer' => 'required',
      'module' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'status' => 0,
        'message' => $validator->errors()
      ]);
    } else {

      if ($request->update == 'false') {

        $activity = new Activity;
        $activity->activity_type = implode(', ', $request->activity_type);

        $date_array = explode(',', $request->plan_date);

        usort($date_array, array($this, "date_sort"));

        $activity->plan_date = implode(', ', $date_array);
        $activity->activity_date = implode(', ', $date_array);

        $activity->plan_date_start = date('Y-m-d', strtotime($date_array[0]));

        $activity->region = implode(', ', $request->region);
        $activity->no_of_men_days =  $request->no_of_men_days;
        $activity->dealer_code = strtoupper(implode(', ', $request->dealer_code));
        $activity->trainer_id = $request->trainer[0];
        $activity->trainer_name = Admin::find($request->trainer[0])->name;
        $activity->module = implode(', ', $request->module);
        $activity->status = 'Open';
        $activity->remarks = $request->remarks;
        $activity->training_type = $request->training_type;
        $activity->save();
        $region_code = '';
        foreach ($request->region as $regions) {
          $region_code .= strtoupper(substr($regions, 0, 1));
        }

        $activity->activity_id = date('Y') . date('m') . $region_code . sprintf('%04s', $activity->id);
        $activity->save();

        createLog(Session::get('user_details')[0]['user_id'], $activity->id, 'Created by ' . Session::get('user_details')[0]['user_name'], date('Y-m-d H:i:s'), 'CREATE');

        return response()->json([
          'status' => 1,
          'message' => []
        ]);
      }

      if ($request->update == 'true') {

        $activity = Activity::find($request->plan_id);
        $activity->activity_type = implode(', ', $request->activity_type);


        $date_array = explode(',', $request->plan_date);

        usort($date_array, array($this, "date_sort"));

        $activity->plan_date = implode(', ', $date_array);
        $activity->activity_date = implode(', ', $date_array);

        $activity->plan_date_start = date('Y-m-d', strtotime($date_array[0]));

        $activity->region = implode(', ', $request->region);
        $activity->no_of_men_days =  $request->no_of_men_days;
        $activity->dealer_code = strtoupper(implode(', ', $request->dealer_code));
        $activity->trainer_id = $request->trainer[0];
        $activity->trainer_name = Admin::find($request->trainer[0])->name;
        $activity->module = implode(', ', $request->module);
        $activity->status = 'Open';
        $activity->remarks = $request->remarks;
        $activity->training_type = $request->training_type;
        $activity->save();
        $region_code = '';
        foreach ($request->region as $regions) {
          $region_code .= strtoupper(substr($regions, 0, 1));
        }
        $activity->activity_id = date('Y') . date('m') . $region_code . sprintf('%04s', $activity->id);
        $activity->save();

        return response()->json([
          'status' => 1,
          'message' => []
        ]);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data['trainers'] = Admin::where('role', 2)->get();
    $data['details'] = Activity::find(base64_decode($id));
    $data['dealers'] = Dealer_master::all();

    if ($data['trainers'] && $data['details'])
      return view('activity.show', $data);
    else
      return redirect('/login');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function showAttendanceForm(Request $request, $id)
  {
    // dd($id);
    $data['activity'] = Activity::find(base64_decode($id));
    return view('activity.attendance_form', $data);
  }

  /**
   * Display the specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Responses
   */
  public function attendanceSubmit(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'activity_id' => 'required',
      'dealer_code' => 'required|max:5',
      'name' => 'required',
      'mobile_no' => 'required|digits:10',
      'location' => 'required',
      'dms_employee_id' => 'required',
      'designation' => 'required',
    ]);

    if ($validator->fails()) {

      return response()->json([
        'status' => 0,
        'message' => $validator->errors(),
        'data' => null
      ]);

    } else {

      $data = $request->all();
      $alreadySubmittedForToday = Attendie::where(['mobile_no' => $data['mobile_no'], 'activity_id' => $data['activity_id']])->whereDate('created_at', '=', date('Y-m-d'))->first();
        
      if ($alreadySubmittedForToday) {
        return response()->json([
          'status' => 2,
          'message' => 'attendence marked already!!'
        ]);
        
      } else {
        $insertData = Attendie::create($data);
        return response()->json([
          'status' => 1,
          'data' => $insertData,
          'message' => 'successfully saved!!'
        ]);
      }
    }
  }



  public function activityAttendanceFeedback(Request $request)
  {
    $from = $request->start;
    $to = $request->end;
    $activity = Activity::orderby('plan_date_start', 'DESC');
    // dd($from, $to);
    if($from && $to){
      // dd($from);
      $from = Carbon::parse($from)->format('Y-m-d');
      $to = Carbon::parse($to)->format('Y-m-d');
      $activity = $activity->whereBetween('plan_date_start', [$from, $to]);
    }

    $activity = $activity->paginate(10);
    return view('activity.activity-feedback')->with([
      'activity'  => $activity,
      'from' => $from, 
      'to' => $to
    ]);
    // dd($activity);
  }

  public function activityTicketFeedback(Request $request)
  {
    $from = $request->start;
    $to = $request->end;
    $activity = TicketFeedback::orderby('created_at', 'DESC');
    // dd($from, $to);
    if($from && $to){
      // dd($from);
      $from = Carbon::parse($from)->format('Y-m-d');
      $to = Carbon::parse($to)->format('Y-m-d');
      $activity = $activity->whereBetween('created_at', [$from, $to]);
    }

    $activity = $activity->paginate(10);
    return view('activity.ticket-feedback')->with([
      'activity'  => $activity,
      'from' => $from, 
      'to' => $to
    ]);
    // dd($activity);
  }

  public function activityAttendanceFeedbackExport(Request $request)
  { 
    $from = Carbon::parse($request->start)->format('Y-m-d');
    $to = Carbon::parse($request->end)->format('Y-m-d');       
    return Excel::download(new FeedbackExport($from, $to), 'kia-feedback-data.csv');
  }

  public function attendieFeedback(Request $request, $activity_id)
  {
    $activity = Activity::find($activity_id);
    $attendies = Attendie::where('activity_id', $activity_id)->get();

    return view('activity.attendie-feedback')->with([
      'activity' => $activity,
      'attendies' => $attendies
    ]);
    dd($attendies);
  }

  public function questions(Request $request, $activity_id, $attendi_id)
  {
    $feedbacks = Feedback::where('activity_id', $activity_id)->where('attendie_id', $attendi_id)->get();    
    return view('activity.feedback-rating')->with([
      'feedbacks' => $feedbacks
    ]);
  }

  public function exportFeedbackForm(Request $request)
  {
    return view('activity.export-feedback');    
  }

  public function exportFeedbackPost(Request $request)
  {   
    $from = date('Y-m-d', strtotime($request->from));
    $to = date('Y-m-d', strtotime($request->to));
    $fileName = "kia-feedback-data from (" . $from . ") to (" . $to . ")";    

    $sql = "SELECT activity.activity_id , activity.plan_date as act_date_from, activity.plan_date as act_date_to, activity.activity_type , activity.region , 
    activity.dealer_code , activity.module , activity.trainer_name, activity.status, attendies.dms_employee_id , attendies.name , attendies.designation , 
    attendies.location , attendies.mobile_no, feedback_master.question_text as feedback_question , feedbacks.answer as feedback_answer
    FROM attendies 
    LEFT JOIN feedbacks ON attendies.id = feedbacks.attendie_id 
    LEFT JOIN activity ON activity.id = attendies.activity_id 
    LEFT JOIN feedback_master ON feedback_master.id = feedbacks.question_id        
    WHERE activity.plan_date_start >= '" . $from . "' AND activity.plan_date_start <= '" . $to . "'";
    $data = \DB::connection('kia_activity')->select($sql);      
    
    Excel::create($fileName, function($excel) use($data) {    
      $excel->sheet('Sheetname', function($sheet) use($data) {
        // $sheet->fromArray($data);
        $sheet->loadView('activity.activity-feedback-table')->with('data', $data);;
      });    
    })->download('csv');
      
  }

}
