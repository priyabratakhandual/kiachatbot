<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionMaster;
use App\FeedBackMaster;
use App\Feedback;
use App\Activity;
use App\Attendie;
use App\DeactiveAttendence;
use Validator;
use Exception;
use DB;
use Illuminate\Contracts\Session\Session;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.index');
    }

    public function sendMsG($activity_id, $attendie_id)
    {
        $questions = FeedBackMaster::whereStatus('active')->get();
        return view('feedback.form', compact('questions', 'activity_id', 'attendie_id'));
    }

    public function submitFeedback(Request $request)
    {

        try {
            $decodedActivityId = base64_decode($request->activity_id);
            $checkduplicateFeedback = Feedback::where(['activity_id' => $decodedActivityId, 'attendie_id' => $request->attendie_id])->first();
            
            if($checkduplicateFeedback){
                return redirect()->route('feedbackSubmitAlready');
            }
            else{
                foreach ($request->ques as $key => $value) {
                    $insertData = Feedback::create([
                        'activity_id' => $decodedActivityId,
                        'question_id' => $key,
                        'answer' => $value,
                        'attendie_id' => $request->attendie_id,
                    ]);
                }
                return redirect()->route('feedbackRecievedStatus');
               
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function SendSmsToUser(Request $request)
    {
        try{
            // dd($request->all());
            $activity_id =  $request->activity_id;
            $activityDetails = Activity::find(base64_decode($activity_id));
            $attendies = Attendie::where('activity_id', $activityDetails->id)->get();
                 
            $checkUser = '';
            foreach ($attendies as $key => $attendy) {
                
                    if ($attendy->feedback->count() < 1) {
                        $feedbackUrl = url('/') . '/sendFeedback/' . $activity_id . '/' . $attendy->id;
                        $mobile_no = $attendy->mobile_no;
                       
                        $body1 = 'Dear Team Kindly provide your Training feedback by clicking on the below link%3A '.$feedbackUrl.' Thanks %26 Regards Globtier Team';
                        $body = str_replace(' ', '%20', $body1);
                    
                        $url = 'https://easygosms.in/api/url_api.php?api_key=NSna1b7myoBzfFsw&pass=d9O25IhgAE&senderid=GLBTER&dlttempid=1507165432603627326&dlttagid=&message='.$body.'&dest_mobileno='.$mobile_no.'&mtype=TXT';
            
                        $ch = curl_init();
                        
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
                        $response = curl_exec($ch);
                        $err = curl_error($ch);
                        curl_close($ch);
                    }
                    else{
                        // dd("not in if");
                        $checkUser = 'valueExist';
                    }
                    
                }

                if($checkUser != null){
                    return redirect()->back()->with('AlreadySent', 'Sms has been already sent to users');
                }
               

            $decodedActivityId = base64_decode($activity_id);

            DeactiveAttendence::create([
                'activity_id' =>  $decodedActivityId,
                'status' => $request->status,
            ]);

            return redirect()->back()->with('Sent', 'Sms has been sent to users successfully');
            
        }

        catch(Exception $e){
            
            return response()->json([
                'status' => 0,
                'data' => $e->getMessage(),
            ]);

        }
       
    }
}
