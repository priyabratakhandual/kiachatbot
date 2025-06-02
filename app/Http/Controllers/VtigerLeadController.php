<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleSheet;
use App\TicketFeedback;
use Illuminate\Support\Facades\Mail;
use App\Mail\NegativeFeedbackAlert;
use App\Mail\vecvCustomerActionMail;
use App\Mail\vecvProposedSolutionMail;

define("CONFIG_URL", "https://globtier.inhelpdesk.com");

// user name in CRM
define("CONFIG_NAME", "admin");

// Access Key for given user name (found under "My Preferences")
define("CONFIG_KEY", "wfiNboj7LhlHCExk");  // TJQuO2tO1Zqci74Z


class VtigerLeadController extends Controller
{   
  

    public function vlogin(){

            $url = CONFIG_URL . '/webservice.php?operation=getchallenge&username='. CONFIG_NAME;

             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_POST, 0);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

             $response = curl_exec ($ch);
             $res = '';
             // $accessKey = '9YxpsUxqjl3gwII4'; //stored in vtiger dashboard [unique for user]
             $accessKey = CONFIG_KEY;
              if($response){
                 $res = json_decode($response);
             }

             $err = curl_error($ch);  //if you need
             curl_close ($ch);

             $post = [
                'operation' => 'login',
                'username' => CONFIG_NAME,
                'accessKey'   => md5($res->result->token . $accessKey),
            ];


            $ch = curl_init(CONFIG_URL . '/webservice.php');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            $response2 = curl_exec($ch);
            curl_close($ch);
            $res2 = json_decode($response2);
            //Session::push('vtiger_session', $res2->result);

            return $res2;
    }

        public function listType()
    {
          //  if(Session::has('vtiger_session')){
               // $sessionId = Session::get('vtiger_session')[0];
                 $url = CONFIG_URL . '/webservice.php?operation=listtypes&sessionName='.$this->vlogin()->result->sessionName;

                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_POST, 0);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                 $response = curl_exec ($ch);
                 $res = json_decode($response);

                 $err = curl_error($ch);  //if you need
                 curl_close ($ch);

                  return response()->json([
                      'status' => 1,
                      'message' => 'success',
                      'data' => $res
                	]);
    }

    public function getFeedbackDetails($gid){
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $result = \DB::select('SELECT * from vecv_feedback where id = "'.$gid.'"');

        return $result;
    }

    public function describe(Request $request)
    {
                // if(Session::has('vtiger_session')){
                // $sessionId = Session::get('vtiger_session')[0];
                 $url = CONFIG_URL . '/webservice.php?operation=describe&sessionName='.$this->vlogin()->result->sessionName.'&elementType=Leads';

                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_POST, 0);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                 $response = curl_exec ($ch);
                 $res = json_decode($response);
                  
                 $err = curl_error($ch);  
                 curl_close ($ch);

                  return response()->json([
                      'status' => 1,
                      'message' => 'success',
                      'data' => $res
                	]);
    }


    public function vecvfeedback(Request $request){

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");


            $arr = [
                'ticket_no' => 'required|regex:/^(9000)[0-9]/|numeric|digits:10',
                'plant_code' => 'required|min:4|max:4|alpha_dash',
                'name' => 'required',
                'telephone' => 'required|numeric|digits:10',
                'email' => 'required|email',
            ];


           $validator = Validator::make($request->all(),$arr,

            [
              'ticket_no.regex' => 'Incorrect Format,it should look like 9000xxxxxx',
              'email.required'  => 'Email is required.',
              'plant_code.alpha_dash' => 'The plant code may only contain letters & numbers.',
              'solman_id.required' => 'Solman Id is required',
              'solman_des.required' => "Solman Description is required",
            ]);


        if($validator->fails()){
               return response()->json([
                         'message'   => $validator->errors(),
                         'status' => 0,
                        ]);
        }else{ 

            $sitekey = "6LdEf_EhAAAAAHjLv920lfDUJnQhyfUvc24uXlZg";
            if($request->g_recaptcha_response){
                response()->json([
                         'message'   => "Please Check the captcha",
                         'status' => 2,
                        ]);
            }else{
                $ip = $_SERVER['REMOTE_ADDR'];
                        // post request to server
                        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($sitekey) .  '&response=' . urlencode($request->g_recaptcha_response);
                        $response = file_get_contents($url);
                        $responseKeys = json_decode($response,true);
                        // should return JSON with success as true
                        if(empty($responseKeys["success"])) {
                            return response()->json([
                                     'message'   => "Invalid captcha",
                                     'status' => 2,
                                    ]);
                        }
            }

            if((int)$request->radio1 < 4 || (int)$request->radio2 < 4 || (int)$request->radio3 < 4 || (int)$request->radio4 < 4 || (int)$request->radio5 < 4){
                Mail::to(['zzmgupta7@vecv.in','zzrkumar24@vecv.in','zznkbaberwal@vecv.in','zzidasgupta@vecv.in'])->send(new NegativeFeedbackAlert($request->all()));
            }

            $googlesheet = new GoogleSheet('1toUMlz0twuvTOr30kzYnY8DgV3ThoimoWhygsqFdmfk');


            $arr = [date('d/m/Y H:i:s'),$request->ticket_no,$request->plant_code,$request->name,$request->telephone,$request->email,$request->radio1,$request->radio2,$request->radio3,$request->radio4,$request->radio5,$request->anyconcern];

            $saved = $googlesheet->saveDataToSheet([$arr]);


               return response()->json([
                         'message'   => $saved,
                         'status' => 1,
                        ]);
         
        }



    }




    public function vecvfeedbacknew(Request $request){

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");


            $arr = [
                'plant_code' => 'required|min:4|max:4',
                'plant_name' => 'required',
                'user_id' => 'required',
                'name' => 'required',
                'telephone' => 'required|numeric|digits:10',
                'email' => 'required|email',
            ];


           $validator = Validator::make($request->all(),$arr,

            [
              'ticket_no.regex' => 'Incorrect Format',
              'email.required'  => 'Email is required.',
              'solman_id.required' => 'Solman Id is required',
              'solman_des.required' => "Solman Description is required",
            ]);


        if($validator->fails()){
               return response()->json([
                         'message'   => $validator->errors(),
                         'status' => 0,
                        ]);
        }else{ 

            \DB::select('UPDATE vecv_feedback SET  plant_code = "'.$request->plant_code.'", plant_name = "'.$request->plant_name.'" ,user_id = "'.$request->user_id.'" ,full_name = "'.$request->name.'" ,mobile = "'.$request->telephone.'" ,email = "'.$request->email.'" ,full_name_old = "'.$request->old_name.'" ,mobile_old = "'.$request->old_mobile.'" ,email_old ="'.$request->old_email.'", radio1 = "'.$request->radio1.'" ,radio2 = "'.$request->radio2.'" ,radio3 = "'.$request->radio3.'" ,radio4 = "'.$request->radio4.'", radio5 = "'.$request->radio5.'", comments = "'.$request->anyconcern.'" where id = '.$request->gid);

            $googlesheet = new GoogleSheet('1QlU9H4b5Zl4sITRMyfm8Ok-w4Wo_-GOwtvqwFAFeqwQ');

            $arr = [date('d/m/Y H:i:s'),$request->plant_code,$request->plant_name,$request->user_id,$request->name,$request->telephone,$request->email,$request->old_name,$request->old_mobile,$request->old_email,$request->radio1,$request->radio2,$request->radio3,$request->radio4,$request->radio5,$request->anyconcern];

            $saved = $googlesheet->saveDataToSheet([$arr]);

               return response()->json([
                         'message'   => $saved,
                         'status' => 1,
                        ]);
         
        }



    }


    public function kiafeedback(Request $request){

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        
        $total = $request->radio1 + $request->radio2 + $request->radio3 + $request->radio4 + $request->radio5;

        $arr= [];

        if($total < 20){

            $arr = [
                'dealercode' => 'required|nullable',
                'dealername' => 'required',
                'contactperson' => 'required',
                'designation' => 'required|',
                'mobileno' => 'required|numeric',
                'email' => 'required|email',
                'elaborate' => 'required',
            ];

        }else{

            $arr = [
                'dealercode' => 'required|nullable',
                'dealername' => 'required',
                'contactperson' => 'required',
                'designation' => 'required|',
                'mobileno' => 'required|numeric',
                'email' => 'required|email',
            ];

        }

           $validator = Validator::make($request->all(),$arr,

            [
              'dealercode.required' => 'dealer code is required',
              'email.required'  => 'Email is required.',
              'dealername.required' => 'dealer name is required',
              'contactperson.required' => "contact person's name is required",
              'designation.required' => "designation is required",
              'mobileno.required' => "mobile number is required",
              'elaborate.required' => 'please answer this question',
            ]);


        if($validator->fails()){
               return response()->json([
                         'message'   => $validator->errors(),
                         'status' => 0,
                        ]);
        }else{ 

            $googlesheet = new GoogleSheet('1ML7WUIrW8W5Juh677RgLiLG_ir2LxT7lO3r_PltbqKY');
            
            $arr = [date('m/d/Y H:i:s'),$request->dealercode,$request->dealername,$request->contactperson,$request->designation,$request->mobileno,$request->email,$request->radio1,$request->radio2,$request->radio3,$request->radio4,$request->radio5,$request->anyconcern,$request->elaborate];

            $saved = $googlesheet->saveDataToSheet([$arr]);


               return response()->json([
                         'message'   => $saved,
                         'status' => 1,
                        ]);
         
        }



    }    
    
    public function kiafeedbackTicket(Request $request){

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        
            $arr = [
                // 'remarks' => 'required',
                // 'mobileno' => 'required|numeric',
            ];

           $validator = Validator::make($request->all(),$arr,
            [
              'mobileno.required' => "mobile number is required",
              'remarks.required' => 'please add remarks',
            ]);


        if($validator->fails()){
               return response()->json([
                         'message'   => $validator->errors(),
                         'status' => 0,
                        ]);
        }else{ 

             $fd = new TicketFeedback();
             $fd->ticket_no = $request->ticketno;
             $fd->mobile_no = $request->mobileno;
             $fd->rating = $request->radio1;
             $fd->remarks = $request->remarks;
             $fd->save();

               return response()->json([
                         'message'   => "success",
                         'status' => 1,
                        ]);
         
        }



    }

    public function registerlead(Request $request)
    {

           $validator = Validator::make($request->all(), [
                'email' => 'required|email|nullable',
                'f_name' => 'required|alpha',
                'l_name' => 'required|alpha',
                'phone' => 'required|nullable|numeric',
                'city' => 'required',
                'linkedIn' => 'required|url',
                'organization' => 'required', 
                'designation' => 'required', 
                'employer_status' => 'required',
                'pf_emp_type' => 'required',
                'open_to_rel' => 'required',
                'open_to_remote' => 'required',
                'open_to_contract' => 'required',
                'worked_in_startup' => 'required',
                'open_to_gig' => 'required',
                'file' => 'required',
            ],

            [
			  'email.required'  => 'Email is required.',
			  'f_name.required'  => 'first name is required.',
			  'l_name.required'  => 'last name is required.',
			  'phone.required'  => 'phone number is required.',
			  'city.required'  => "city's name is required.",
			  'linkedIn.required'  => 'Please provide linkedin profile.',
			  'organization.required'  => "organization's name is required.",
			  'designation.required'  => 'designation is required.',
			  'employer_status.required'  => 'Please answer this.',
			  'pf_emp_type.required'  => 'Please answer this.',
			  'open_to_rel.required'  => 'Please answer this.',
			  'open_to_remote.required'  => 'Please answer this.',
			  'open_to_contract.required'  => 'Please answer this.',
			  'worked_in_startup.required'  => 'Please answer this.',
			  'open_to_gig.required'  => 'Please answer this.',
			  'file.required'  => 'CV is required.',
			]);


        if($validator->fails()){
               return response()->json([
                         'message'   => $validator->errors(),
                         'status' => 0,
                        ]);
        }else{ 


        	    $data = array(
                    'firstname' => $request->f_name,
                    'lastname' => $request->l_name,
                    'mobile' => $request->phone,
                    'designation' => $request->designation,
                    'email' => $request->email,
                    'assigned_user_id' => '$vtiger->_userid',
                    'city' => $request->city,
                    'description' => $request->share_about,
                    'cf_878' => $request->linkedIn, //linkedin profile
                    'cf_880' => $request->organization, //Organization
                    'cf_882' => $request->employer_status, //Employment status
                    'cf_884' => $request->skills, //Skills
                    'cf_886' => $request->pf_emp_type, //Preferred Employment type
                    'cf_888' => $request->rolesinterest, //Roles of Interest
                    'cf_890' => $request->open_to_rel, //Open to relocation?
                    'cf_892' => $request->open_to_remote, //Open to remote work?
                    'cf_894' => $request->open_to_contract, //Open to a  Contract job?
                    'cf_896' => $request->worked_in_startup, //Have you worked in a start-up earlier?
                    'cf_898' => $request->other_info, //Any other information
                );

                $post = [
                    'operation' => 'create',
                    'sessionName' => $this->vlogin()->result->sessionName,
                    'element'   => json_encode($data),
                    'elementType' => 'Leads',
                ];


                $ch = curl_init(CONFIG_URL . '/webservice.php');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

                $response2 = curl_exec($ch);
                curl_close($ch);
                $res2 = json_decode($response2);

                if($res2){
                    if($res2->success){  
         

                                $file = $request->file;
                                $destinationPath = public_path();
                                $originalFile = $file->getClientOriginalName();
                                $filename=$originalFile;
                                $file->move($destinationPath, $filename);
                                chmod(public_path().'/'.$filename, 0777);

                                $element = array(
                                    'notes_title'=> $filename .' document',
                                    'filelocationtype'=>'I',
                                    //default folder
                                    'folderid'=>'22x1',
                                    'notecontent'=>'created '. $filename ,
                                    'filename'=>$filename,
                                    'filetype'=>filetype(public_path().'/'.$filename),
                                    'filesize'=>filesize(public_path().'/'.$filename),
                                    'filestatus'=>'1',
                                    //assign to user admin, groups would have the prefix 20
                                    'assigned_user_id'=> '19x1',
                                );

                                $cfile = curl_file_create(public_path().'/'.$filename); 

                                $params =  [     "operation" => "create",
                                                 "format" => "json",    
                                                 "sessionName" => $this->vlogin()->result->sessionName,
                                                 "elementType" => 'Documents',
                                                 "element" => json_encode($element),
                                                 'file_contents'=> $cfile
                                           ];

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL,CONFIG_URL . '/webservice.php');
                                curl_setopt($ch, CURLOPT_POST,1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec ($ch);
                                $res4 = json_decode($response);

                                $err = curl_error($ch);  
                                curl_close ($ch);

                                unlink(public_path().'/'.$filename);

                                $note_id = explode('x',$res4->result->id)[1];

                                \DB::connection('globtier')->table('vtiger_senotesrel')->insert(
                                                ['crmid' => explode('x',$res2->result->id)[1], 'notesid' => $note_id]
                                );


                        return response()->json([
                          'status' => 1,
                          'message' => 'Lead created successfully',
                          'data' => $res2->result
                        ]);
                    }else{
                        return response()->json([
                          'status' => 0,
                          'message' => 'failure, try after sometime',
                          'data' => null
                        ]);
                    }
                }else{
                    return response()->json([
                          'status' => 0,
                          'message' => 'failure, try after sometime',
                          'data' => null
                    ]);
                }



        }

    }

    public function importCustomerAction(Request $request){

        $params = array();
        parse_str($request->formdata, $params);
        $excel_data = json_decode($request->exceldata);

        $ticket_id = '';
        $data = [];

        if(isset($excel_data->{$params['ticket_id']})){
            $ticket_id =  $excel_data->{$params['ticket_id']};
            $data['ticket_id'] = $ticket_id;
            if(isset($excel_data->{$params['ticket_desc']}))
                 $data['ticket_desc'] = trim($excel_data->{$params['ticket_desc']});
            if(isset($excel_data->{$params['ticket_status']}))
                 $data['ticket_status'] = trim($excel_data->{$params['ticket_status']});
            if(isset($excel_data->{$params['created_on']}))
                 $data['created_on'] = trim($excel_data->{$params['created_on']});
            if(isset($excel_data->{$params['created_by']}))
                 $data['created_by'] = trim($excel_data->{$params['created_by']});
            if(isset($excel_data->{$params['sold_to_party']}))
                 $data['sold_to_party'] = trim($excel_data->{$params['sold_to_party']});
            if(isset($excel_data->{$params['email']}))
                 $data['email'] = trim($excel_data->{$params['email']});

            $ticket = \DB::connection('mysql')->table('vecv_customer_action')->where('ticket_id',$ticket_id)->get();

            if(count($ticket)){

                if((int)($ticket[0]->attempt) != 3){

                    Mail::to($data['email'])->send(new vecvCustomerActionMail($data));
                      $update = \DB::connection('mysql')->table('vecv_customer_action')->where('ticket_id',$ticket_id)->update(['attempt' => (int)($ticket[0]->attempt)+1,'updated_at' => date('Y-m-d H:i:s')]);
                                             
                }

            }else{
               
               Mail::to($data['email'])->send(new vecvCustomerActionMail($data));
                 $insert =  \DB::connection('mysql')->table('vecv_customer_action')->insert(['ticket_id' => $ticket_id,'attempt' => 1,'created_at' => date('Y-m-d H:i:s')]);
                               

            }

        }

           return response()->json([
                'message' => $ticket
            ]);


    }

    public function importProposedSolution(Request $request){

        $params = array();
        parse_str($request->formdata, $params);
        $excel_data = json_decode($request->exceldata);

        $ticket_id = '';
        $data = [];

        if(isset($excel_data->{$params['ticket_id']})){
            $ticket_id =  $excel_data->{$params['ticket_id']};
            $data['ticket_id'] = $ticket_id;
            if(isset($excel_data->{$params['ticket_desc']}))
                 $data['ticket_desc'] = trim($excel_data->{$params['ticket_desc']});
            if(isset($excel_data->{$params['ticket_status']}))
                 $data['ticket_status'] = trim($excel_data->{$params['ticket_status']});
            if(isset($excel_data->{$params['closed_on']}))
                 $data['closed_on'] = trim($excel_data->{$params['closed_on']});
            if(isset($excel_data->{$params['created_by']}))
                 $data['created_by'] = trim($excel_data->{$params['created_by']});
            if(isset($excel_data->{$params['sold_to_party']}))
                 $data['sold_to_party'] = trim($excel_data->{$params['sold_to_party']});
            if(isset($excel_data->{$params['email']}))
                 $data['email'] = trim($excel_data->{$params['email']});
               
            Mail::to($data['email'])->send(new vecvProposedSolutionMail($data));

        }

        return response()->json([
            'message' => $ticket_id
        ]);


    }
}
