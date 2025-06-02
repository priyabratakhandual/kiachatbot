<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TicketDetail;

define("CONFIG_URL", "https://kia.support.inhelpdesk.com");

// user name in CRM
define("CONFIG_NAME", "admin");

// Access Key for given user name (found under "My Preferences")
define("CONFIG_KEY", "TJQuO2tO1Zqci74Z");  // TJQuO2tO1Zqci74Z


class FrontendController extends Controller
{   

    public function verifyDealer(Request $request){
        $user = \DB::connection('kia')->table('vtiger_account')->join('vtiger_accountscf', 'vtiger_account.accountid', '=', 'vtiger_accountscf.accountid')->where('vtiger_accountscf.cf_854',strtoupper($request->dealer_code))->first();
        if($user){
            return response()->json([
              'status' => 1,
              'message' => 'Dealer found!',
              'data' => $user 
            ]);

        }else{
            return response()->json([
              'status' => 0,
              'message' => 'Dealer not found!',
              'data' => null 
            ]);
        }
    }


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

    public function describe(Request $request)
    {
                // if(Session::has('vtiger_session')){
                // $sessionId = Session::get('vtiger_session')[0];
                 $url = CONFIG_URL . '/webservice.php?operation=describe&sessionName='.$this->vlogin()->result->sessionName.'&elementType='.$request->module;

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


    public function firstOrNewContact($firstname,$lastname,$email_id,$mobile,$organization){

                 $query = 'select%20*%20from%20Contacts%20where%20email%20=\''.$email_id.'\';';
                 $url = CONFIG_URL . '/webservice.php?operation=query&sessionName='.$this->vlogin()->result->sessionName.'&query='.$query;

                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_POST, 0);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                 $response = curl_exec ($ch);
                 $res2 = json_decode($response);

                 $err = curl_error($ch);  
                 curl_close ($ch);

                 if($res2->success){

                    if($res2->result){
                      return $res2->result[count($res2->result)-1]->id;
                    }else{
                       // create contact for later emailing

                        if(!$lastname){
                            $lastname = '.';  // coz lastname is mandatory
                        }
                       
                        $data = array(
                          'firstname' => $firstname,
                          'lastname' => $lastname,
                          'mobile' => $mobile,
                          'account_id' => $organization,
                          'email' => $email_id,
                          'assigned_user_id' => '$vtiger->_userid',
                        );

                        $post = [
                            'operation' => 'create',
                            'sessionName' => $this->vlogin()->result->sessionName,
                            'element'   => json_encode($data),
                            'elementType' => 'Contacts',
                        ];

                        $ch = curl_init(CONFIG_URL . '/webservice.php');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

                        $response2 = curl_exec($ch);
                        curl_close($ch);
                        $res3 =  json_decode($response2);

                        if($res3->success){
                          if($res3->result){
                            return $res3->result->id;
                          }else{
                            return '';
                          }
                        }else{
                            return '';
                        }

                    }
            
                 }else{
                    return '';
                 }
      
    }

    public function split_name($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }

    public function createTicket(Request $request){

              $dealer_info = \DB::connection('kia')->table('vtiger_account')->join('vtiger_accountscf', 'vtiger_account.accountid', '=', 'vtiger_accountscf.accountid')->where('vtiger_accountscf.cf_854',strtoupper($request->dealer_code))->select('vtiger_account.accountid')->first();
            // if(Session::has('vtiger_session')){
            //     $sessionId = Session::get('vtiger_session')[1];

              if($dealer_info){

                $name_arr = $this->split_name($request->name);
                
                $contact_id = $this->firstOrNewContact($name_arr[0],$name_arr[1],$request->email,$request->mobile,'11x'.$dealer_info->accountid);

                $product = 704;
                $product_fetch = \DB::connection('kia')->table('vtiger_products')->where('productname',preg_replace('!\s+!', ' ', $request->product))->first();
                if($product_fetch){
                  $product = $product_fetch->productid;
                }

                $module = 'Others';
                $module_fetch = \DB::connection('kia')->table('vtiger_cf_880')->where('cf_880',preg_replace('!\s+!', ' ', $request->module))->first();
                if($module_fetch){
                  $module = $module_fetch->cf_880;
                }

                $issue = 'other';
                $issue_fetch = \DB::connection('kia')->table('vtiger_cf_968')->where('cf_968',preg_replace('!\s+!', ' ', $request->issue_category))->first();
                if($issue_fetch){
                  $issue = $issue_fetch->cf_968;
                }


                $data = array(
                    'ticket_title' => $request->ticket_title,
                    'ticketstatus' => $request->ticketstatus,
                    'ticketpriorities' => $request->ticketpriorities,
                    'description' => $request->description,
                    'cf_974' => strtoupper($request->dealer_code),
                    'assigned_user_id' => '$vtiger->_userid',
                    'parent_id' => '11x'.$dealer_info->accountid,
                    'product_id' => '14x'.$product, 
                    'cf_878' => 'Others', //Solution Category
                    'cf_880' => $module, //Module Name
                    'cf_946' => 'Pending', //L2 Status
                    'cf_976' => 'Chatbot', //Generated Through
                    'cf_968' => $issue, //Issue category
                    'cf_992' => $request->mobile,
                );

                if($contact_id){
                  $data['contact_id'] = $contact_id;
                }


                $post = [
                    'operation' => 'create',
                    'sessionName' => $this->vlogin()->result->sessionName,
                    'element'   => json_encode($data),
                    'elementType' => 'HelpDesk',
                ];


                $ch = curl_init(CONFIG_URL . '/webservice.php');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

                $response2 = curl_exec($ch);
                curl_close($ch);
                $res2 = json_decode($response2);

                if($res2){
                    if($res2->success){
                        $ticket = new TicketDetail;
                        $ticket->ticket_id = $res2->result->id;
                        $ticket->ticket_number = $res2->result->ticket_no;
                        $ticket->dealer_code = strtoupper($request->dealer_code);
                        $ticket->save();
                        return response()->json([
                          'status' => 1,
                          'message' => 'ticket created successfully',
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

              }else{
                
                    return response()->json([
                          'status' => 0,
                          'message' => 'Please Enter Valid Dealer ID',
                          'data' => null
                    ]);

              }



            

    }

    public function fetchProduct(Request $request){

                 $query = 'select%20*%20from%20Accounts;';
                 $url = CONFIG_URL . '/webservice.php?operation=query&sessionName='.$this->vlogin()->result->sessionName.'&query='.$query;

                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_POST, 0);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                 $response = curl_exec ($ch);
                 $res2 = json_decode($response);

                 $err = curl_error($ch);  
                 curl_close ($ch);

                 dd($res2);

    }

        var $defaults = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 86400,
            CURLOPT_HTTPHEADER => array("Content-Type: multipart/form-data"),

        );


    public function documentupload(Request $request)
    {   

        $file_details = json_decode($request->payload);
        $ticket = explode('x',$request->ticket)[1];



        if(strpos(CONFIG_URL, 'demo')){
            $ticket2 =  \DB::connection('demo')->table('vtiger_crmentity')->where('crmid',$ticket)->first();
        }else{
            $ticket2 =  \DB::connection('kia')->table('vtiger_crmentity')->where('crmid',$ticket)->first();
        }      


        if($ticket2){
           if($ticket2->setype != 'HelpDesk'){
            return response()->json([
              'status' => 0,
              'message' => 'please enter valid ticket id',
              'data' => []
            ]);

           }
        }else{
            return response()->json([
              'status' => 0,
              'message' => 'ticket does not exists',
              'data' => []
            ]);
        }

        $url = $file_details->url;
        $file_name = $file_details->name;

        file_put_contents(public_path().'/'.basename($url),file_get_contents($url));
        chmod(public_path().'/'.basename($url), 0777);
        rename(public_path().'/'.basename($url),public_path().'/'.$file_name);

        $element = array(
            'notes_title'=> $file_name .' document',
            'filelocationtype'=>'I',
            //default folder
            'folderid'=>'22x1',
            'notecontent'=>'created '. $file_name ,
            'filename'=>$file_name,
            'filetype'=>filetype(public_path().'/'.$file_name),
            'filesize'=>filesize(public_path().'/'.$file_name),
            'filestatus'=>'1',
            //assign to user admin, groups would have the prefix 20
            'assigned_user_id'=> '19x1',
        );

        $cfile = curl_file_create(public_path().'/'.$file_name); 

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
        $res = json_decode($response);

        $err = curl_error($ch);  
        curl_close ($ch);

        unlink(public_path().'/'.$file_name);

        $note_id = explode('x',$res->result->id)[1];

        if(strpos(CONFIG_URL, 'demo')){
                \DB::connection('demo')->table('vtiger_senotesrel')->insert(
                        ['crmid' => $ticket2->crmid, 'notesid' => $note_id]
                );
        }else{
                \DB::connection('kia')->table('vtiger_senotesrel')->insert(
                        ['crmid' => $ticket2->crmid, 'notesid' => $note_id]
                );
        }
                     
        return response()->json([
          'status' => 1,
          'message' => 'file uploaded successfully',
          'data' => $res->result
        ]);
        

    }


    public function fetchTicketByTicketNumber(Request $request){
                 
                 $ticket_source = \DB::connection('kia')->table('vtiger_troubletickets')->where('ticket_no',$request->ticket_number)->first();

                 if($ticket_source){

                         $url = CONFIG_URL . '/webservice.php?operation=retrieve&sessionName='.$this->vlogin()->result->sessionName.'&id=17x'.$ticket_source->ticketid;

                         $ch = curl_init();
                         curl_setopt($ch, CURLOPT_URL, $url);
                         curl_setopt($ch, CURLOPT_POST, 0);
                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                         $response = curl_exec ($ch);
                         $res2 = json_decode($response);

                         $err = curl_error($ch);  
                         curl_close ($ch);

                        if($res2){
                            if($res2->success){

                                 $query = 'select%20cf_854%20from%20Accounts%20where%20id%20=%20'.$res2->result->parent_id.';';  //cf_854 =>dealer_code
                                 $url = CONFIG_URL . '/webservice.php?operation=query&sessionName='.$this->vlogin()->result->sessionName.'&query='.$query;

                                 $ch = curl_init();
                                 curl_setopt($ch, CURLOPT_URL, $url);
                                 curl_setopt($ch, CURLOPT_POST, 0);
                                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                 $response_new = curl_exec ($ch);
                                 $res_new = json_decode($response_new);

                                 $err = curl_error($ch);  
                                 curl_close ($ch);
                                 
                                 $dealer_code = '';

                                 if($res_new->success){
                                  $dealer_code = $res_new->result[0]->cf_854;
                                 }                 

                                      $res2->result->createdtime = date('d-M-Y',strtotime($res2->result->createdtime));
                                      $res2->result->modifiedtime = date('d-M-Y',strtotime($res2->result->modifiedtime));

                                return response()->json([
                                  'status' => 1,
                                  'message' => 'has records',
                                  'dealer_code' => $dealer_code,
                                  'data' => $res2->result
                                ]);
                            }else{
                                return response()->json([
                                  'status' => 0,
                                  'message' => 'failure, try after sometime',
                                  'dealer_code' => '',
                                  'data' => null
                                ]);
                            }
                        }else{
                            return response()->json([
                                  'status' => 0,
                                  'message' => 'failure, try after sometime',
                                  'dealer_code' => '',
                                  'data' => null
                            ]);
                        }

                 }else{

                            return response()->json([
                                  'status' => 0,
                                  'message' => 'Incorrect Ticket Number',
                                  'dealer_code' => '',
                                  'data' => null
                            ]);

                 }

    }




    public function fetchTicket(Request $request){
               $dealer = \DB::connection('kia')->table('vtiger_account')->join('vtiger_accountscf', 'vtiger_account.accountid', '=', 'vtiger_accountscf.accountid')->where('vtiger_accountscf.cf_854',strtoupper($request->dealer_code))->select('vtiger_account.accountid')->first();

               if($dealer){

                 // $url = CONFIG_URL . '/webservice.php?operation=retrieve&sessionName='.$this->vlogin()->result->sessionName.'&id=17x3705';
                 // $ids = \DB::select('select ticket_id from vtiger_ticket_detail where dealer_code = "'.$request->dealer_code.'"');  
                 // $arr = implode(',', array_column($ids,'ticket_id'));
                 $exdate = date('Y-m-d H:i:s', strtotime('-30 days'));
                 // $query = "select * from HelpDesk where parent_id=11x".$dealer->accountid." order by modifiedtime desc limit 10;";
                 $query = "select * from HelpDesk where parent_id=11x".$dealer->accountid." and createdtime > '".$exdate."' order by createdtime desc;";
                 $queryParam = urlencode($query);
                 $url = CONFIG_URL . '/webservice.php?operation=query&sessionName='.$this->vlogin()->result->sessionName.'&query='.$queryParam;

                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_POST, 0);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                 $response = curl_exec ($ch);
                 $res2 = json_decode($response);

                 $err = curl_error($ch);  
                 curl_close ($ch);

                if($res2){
                    if($res2->success){

                        foreach ($res2->result as $ticket) {
                            $ticket->createdtime = date('d-M-Y',strtotime($ticket->createdtime));
                            $ticket->modifiedtime = date('d-M-Y',strtotime($ticket->modifiedtime));
                        } 

                        return response()->json([
                          'status' => 1,
                          'message' => 'has records',
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

               }else{

                    return response()->json([
                          'status' => 0,
                          'message' => 'Dealer Not Found',
                          'data' => null
                    ]);

               }

    }


    public function fetchTicketByProductName(Request $request){
               $dealer = \DB::connection('kia')->table('vtiger_account')->join('vtiger_accountscf', 'vtiger_account.accountid', '=', 'vtiger_accountscf.accountid')->where('vtiger_accountscf.cf_854',strtoupper($request->dealer_code))->select('vtiger_account.accountid')->first();

               $product = \DB::connection('kia')->table('vtiger_products')->where('productname',$request->product_name)->first();

               if($dealer && $product){

                 // $url = CONFIG_URL . '/webservice.php?operation=retrieve&sessionName='.$this->vlogin()->result->sessionName.'&id=17x3705';
                 // $ids = \DB::select('select ticket_id from vtiger_ticket_detail where dealer_code = "'.$request->dealer_code.'"');  
                 // $arr = implode(',', array_column($ids,'ticket_id'));
                 // $query = 'select%20*%20from%20HelpDesk%20where%20parent_id%20=%2011x'.$dealer->accountid.'%20and%20product_id%20=%2014x'.$product->productid.'%20order%20by%20modifiedtime%20desc%20limit%205;';

                 $exdate = date('Y-m-d H:i:s', strtotime('-30 days'));
                 $query = "select * from HelpDesk where parent_id=11x".$dealer->accountid." and product_id = 14x".$product->productid." and createdtime > '".$exdate."' order by createdtime desc;";
                 $queryParam = urlencode($query);
                 $url = CONFIG_URL . '/webservice.php?operation=query&sessionName='.$this->vlogin()->result->sessionName.'&query='.$queryParam;

                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_POST, 0);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                 $response = curl_exec ($ch);
                 $res2 = json_decode($response);

                 $err = curl_error($ch);  
                 curl_close ($ch);

                if($res2){
                    if($res2->success){

                        foreach ($res2->result as $ticket) {
                            $ticket->createdtime = date('d-M-Y',strtotime($ticket->createdtime));
                            $ticket->modifiedtime = date('d-M-Y',strtotime($ticket->modifiedtime));
                        } 

                        return response()->json([
                          'status' => 1,
                          'message' => 'has records',
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

               }else{

                    return response()->json([
                          'status' => 0,
                          'message' => 'Dealer Not Found',
                          'data' => null
                    ]);

               }

    }
}




































    // public function documentuploadold(Request $request){
    //     $type = 'Documents';
    //     $element = array(
    //         'notes_title'=>'aditya document',
    //         'filelocationtype'=>'I',
    //         //default folder
    //         'folderid'=>'22x1',
    //         'notecontent'=>'created by aditya',
    //         'filename'=>$_FILES['image']['name'],
    //         'filetype'=>$_FILES['image']['type'],
    //         'filesize'=>$_FILES['image']['size'],
    //         'filestatus'=>'1',
    //         //assign to user admin, groups would have the prefix 20
    //         'assigned_user_id'=> '19x1',
    //     );
    //     $filepath = $_FILES['image']['tmp_name'];
        
    //     $curl_handler = curl_init();
    //     $params = array("operation" => "create", "format" => "json", "sessionName" => $this->vlogin()->result->sessionName, "elementType" => $type, "element" => json_encode($element));
    //     $options = array(CURLOPT_URL => CONFIG_URL . '/webservice.php', CURLOPT_POST => 1, CURLOPT_POSTFIELDS => http_build_query($params));
    //     if ($filepath != '') {
    //         $filename = pathinfo($filepath, PATHINFO_BASENAME);
    //         $size = filesize($filepath);
    //         $add_options = array(CURLOPT_HTTPHEADER => array("Content-Type: multipart/form-data"), CURLOPT_INFILESIZE => $size);
    //         if (!function_exists('curl_file_create')) {
    //             $add_params = array("filedata" => "@$filepath", "filename" => $filename);
    //         } else {
    //             $cfile = curl_file_create($filepath, '', $filename);
    //             $add_params = array('tmp_file' => $cfile);
    //         }
            
    //         $options += $add_options;
    //         // $this->defaults[CURLOPT_HEADER] = 1;
    //         $options[CURLOPT_POSTFIELDS] = $params + $add_params;
    //     }

    //     curl_setopt_array($curl_handler, ($this->defaults + $options));
    //     // $this->defaults[CURLOPT_HEADER] = 0;
    //     $result = curl_exec($curl_handler);

                     
    //     return response()->json([
    //       'status' => 1,
    //       'message' => 'nothing',
    //       'data' => $result
    //     ]);

        
    //     // return $this->handleReturn($result, __FUNCTION__);

    // }