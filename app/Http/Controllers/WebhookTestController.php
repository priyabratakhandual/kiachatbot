<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Dialogflow\WebhookClient;
use App\Category;
use App\Chat;
use App\Botgotest;

define("base_url", "https://kia.chatbot.inhelpdesk.com");

define("CONFIG_URL", "https://kia.support.inhelpdesk.com");

// user name in CRM
define("CONFIG_NAME", "admin");

// Access Key for given user name (found under "My Preferences")
define("CONFIG_KEY", "TJQuO2tO1Zqci74Z");  // TJQuO2tO1Zqci74Z

class WebhookTestController extends Controller
{
    
     /**
     * Handle a webhook call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request, $version = null)
    {

        $payload = json_decode($request['intent'],true);

        $method = 'handle'.Str::studly(str_replace('.', '_', $payload['fulfillment']['action'] ));

        if (method_exists($this, $method)) {
            return $this->{$method}($payload,$version);
        }

        return $this->missingMethod();
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


    public function botgoFormSubmitTest(Request $request){

      $payload = json_decode($request['webhookData'],true);
      $formData = json_decode($request['submittedData'],true);
      $chatId = $payload['content']['chatId'];
      
      $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
      $entry->name = $formData['name'];
      $entry->email = $formData['email'];
      $entry->mobile = $formData['mobile'];
      $entry->chatId = $chatId;
      $entry->save();

      return response()->json([
         'message' => "success"
      ]);
    }

    // public function updateTicketFormVerify(Request $request){

    //   $payload = json_decode($request['webhookData'],true);
    //   $formData = json_decode($request['submittedData'],true);
    //   $chatId = $payload['content']['chatId'];

    //     //verify dealer
    //     $post = [
    //         'dealer_code' => $formData['dealer'],
    //     ];

    //     $ch = curl_init(base_url.'/public/api/verifyDealer');
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     $res = json_decode($response,true);

    //     if($res['status']){
            
    //         // verify ticket id
    //         $post2 = [
    //             'ticket_number' => $formData['ticket_number'],
    //         ];

    //         $ch2 = curl_init(base_url.'/public/api/fetchTicketByTicketNumber');
    //         curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch2, CURLOPT_POSTFIELDS, $post2);
    //         $response2 = curl_exec($ch2);
    //         curl_close($ch2);
    //         $res2 = json_decode($response2,true);

    //         if($res2['status']){
    //             if(strtolower($res2['dealer_code']) == strtolower($formData['dealer'])){

    //                 // create contact 
    //                 $dealer_info = \DB::connection('kia')->table('vtiger_account')->join('vtiger_accountscf', 'vtiger_account.accountid', '=', 'vtiger_accountscf.accountid')->where('vtiger_accountscf.cf_854',strtoupper($formData['dealer']))->select('vtiger_account.accountid')->first();

    //                 if($dealer_info){
    //                     $name_arr = $this->split_name($formData['name']);
    //                     $contact_id = $this->firstOrNewContact($name_arr[0],$name_arr[1],$formData['email'],'','11x'.$dealer_info->accountid);
    //                     if($contact_id){

    //                       $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
    //                       $entry->name = $formData['name'];
    //                       $entry->email = $formData['email'];
    //                       $entry->contact_id = $contact_id;
    //                       $entry->save();

    //                       return response()->json([
    //                          'status' => 1,
    //                          'message' => "success"
    //                       ]);

    //                     }else{
    //                       return response()->json([
    //                          'status' => 0,
    //                          'message' => "there's some problem in creating your contact."
    //                       ]);
    //                     }
    //                 }else{
    //                   return response()->json([
    //                      'status' => 0,
    //                      'message' => "Dealer Code is not valid"
    //                   ]);
    //                 }
    //             }else{
    //               return response()->json([
    //                  'status' => 0,
    //                  'message' => "Dealer not matched with ticket number"
    //               ]);
    //             }
    //         }else{
    //           return response()->json([
    //              'status' => 0,
    //              'message' => $res2['message']
    //           ]);
    //         }

    //     }else{

    //           return response()->json([
    //              'status' => 0,
    //              'message' => $res['message']
    //           ]);

    //     }
    
    // }


    public function updateTicketFormVerify(Request $request){

      $payload = json_decode($request['webhookData'],true);
      $formData = json_decode($request['submittedData'],true);
      $chatId = $payload['content']['chatId'];
      $entry = Botgotest::firstOrNew(['chatId' => $chatId]);

            
      // create contact 
      $dealer_info = \DB::connection('kia')->table('vtiger_account')->join('vtiger_accountscf', 'vtiger_account.accountid', '=', 'vtiger_accountscf.accountid')->where('vtiger_accountscf.cf_854',strtoupper($entry->dealer_to_update))->select('vtiger_account.accountid')->first();

      if($dealer_info){
          $name_arr = $this->split_name($formData['name']);
          $contact_id = $this->firstOrNewContact($name_arr[0],$name_arr[1],$formData['email'],'','11x'.$dealer_info->accountid);
          if($contact_id){

            $entry->name = $formData['name'];
            $entry->email = $formData['email'];
            $entry->contact_id = $contact_id;
            $entry->save();

            return response()->json([
               'status' => 1,
               'message' => "success"
            ]);

          }else{
            return response()->json([
               'status' => 0,
               'message' => "there's some problem in creating your contact."
            ]);
          }
      }else{
        return response()->json([
           'status' => 0,
           'message' => "Dealer Code is not valid"
        ]);
      }

    }


    public function botgoCreateTicketSubmit(Request $request){

      $payload = json_decode($request['webhookData'],true);
      $formData = json_decode($request['submittedData'],true);
      $chatId = $payload['content']['chatId'];
      
      $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
      $entry->subject = $formData['subject'];
      $entry->description = $formData['description'];
      $entry->save();

      return response()->json([
         'message' => "success"
      ]);
    }
    

    public function handleActionGenRandomText(array $payload,$version){

       $payload['message'] = 'this is another test asdfkjal';

       return json_encode($payload);
    }

    public function handleActionListDealerTickets(array $payload,$version){

        $dealer_code = $payload['fulfillment']['parameters']['dealer_code'];
        $ticket_status = $payload['fulfillment']['parameters']['ticket_status'];

        $query = 'select%20*%20from%20HelpDesk%20where%20cf_974%20=\''.$dealer_code.'\'%20AND%20ticketstatus%20=\''.$ticket_status.'\'%20ORDER%20BY%20createdtime%20DESC%20LIMIT%2010;';
        $url = CONFIG_URL . '/webservice.php?operation=query&sessionName='.$this->vlogin()->result->sessionName.'&query='.$query;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($ch);
        $res = json_decode($response);
         
        $err = curl_error($ch);  
        curl_close ($ch);
        return json_encode($res);
    }


    

    public function handleActionUpdateTicketDetail(array $payload,$version){

       $ticket_id = $payload['fulfillment']['parameters']['updateFormData']['ticket_number'];
       $previousIntent = $payload['fulfillment']['previousIntent'];

        $post = [
            'ticket_number' => $ticket_id,
        ];

        $ch = curl_init(base_url.'/public/api/fetchTicketByTicketNumber');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response,true);


        if($res['status']){

            $status = 'Status: '.$res['data']['ticketstatus'];
            if($res['data']['cf_908'] && $res['data']['cf_908'] != '' && $res['data']['ticketstatus'] != 'Closed' && $res['data']['ticketstatus'] != 'Open'){
                $status = $status . ' - ' . $res['data']['cf_908']; 
            }
            $payload['metadata']['payload'][0]['header']['overlayText'] = $status;
            $payload['metadata']['payload'][0]['subtitle'] = 'Created at : '.$res['data']['createdtime'];
            $payload['metadata']['payload'][0]['title'] = $res['dealer_code'] . ' : ' .$res['data']['ticket_title'];
            $payload['metadata']['payload'][0]['header']['imgSrc'] = null;
            return json_encode($payload);

        }else{

            unset($payload['metadata']);
            unset($payload['fulfillment']);
            $payload['trigger'] = $previousIntent;           
            $payload['userInput'] = false;
            $payload['message'] = 'ticket not found.';
            return json_encode($payload);
            return json_encode($payload);

        }
    }

    public function fetchTicketComments(Request $request){

        // $query = "select * from ModComments where parent_id=11x".$dealer->accountid." and createdtime > '".$exdate."' order by createdtime desc;";
        $query = "select * from ModComments where related_to=".$request->ticket_id." and is_private='0' order by createdtime desc;";
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

                 if($res2->success){
                    return response()->json([
                       'status' => 1,
                       'message' => "success",
                       'data' => $res2->result
                    ]);

                 }else{
                    return response()->json([
                       'status' => 0,
                       'message' => "failure",
                       'data' => null
                    ]);
                 }

    }

    public function handleActionGetTicketStatusById(array $payload,$version){

       $ticket_number = $payload['fulfillment']['parameters']['ticket_id'];
       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];

        $post = [
            'ticket_number' => $ticket_number,
        ];

        $ch = curl_init(base_url.'/public/api/fetchTicketByTicketNumber');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response,true);

        // check bots json for understanding.. intent id: 11

        if($res['status']){

            $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
            $entry->ticket_to_update = $res['data']['id'];
            $entry->dealer_to_update = $res['dealer_code'];
            $entry->save();

            $post = [
              'ticket_id' => $res['data']['id'],
              'module' => 'HelpDesk'
            ];

            $ch = curl_init(base_url.'/public/api/fetchTicketComments');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response2 = curl_exec($ch);
            curl_close($ch);
            $res2 = json_decode($response2,true);       
            
            $admcmnt = '';
            if($res2){
              $arr = $res2['data'];
              if($arr){
                foreach ($arr as $ar) {
                   if($ar['customer'] == ''){
                      $admcmnt = $ar['commentcontent'];
                      break;
                   }
                }
              }
            }
            
            $status = 'Status: '.$res['data']['ticketstatus'];
            if($res['data']['cf_908'] && $res['data']['cf_908'] != '' && $res['data']['ticketstatus'] != 'Closed' && $res['data']['ticketstatus'] != 'Open'){
                $status = $status . ' - ' . $res['data']['cf_908']; 
            }
            // if($status != 'Status: Wait For Response - Dealer'){   
            if(strpos($status,'Closed')){  
               array_shift($payload['metadata']['payload'][0]['buttons']);
            }
            $payload['metadata']['payload'][0]['header']['overlayText'] = $status;
            $payload['metadata']['payload'][0]['subtitle'] = 'Created at : '.$res['data']['createdtime'];
            $payload['metadata']['payload'][0]['title'] = $res['dealer_code'] . ' : ' .$res['data']['ticket_title'];
            $payload['metadata']['payload'][0]['titleExt'] = '';
            if($admcmnt){
              $payload['metadata']['payload'][0]['description'] = '𝙘𝙤𝙢𝙢𝙚𝙣𝙩: '.$admcmnt;
            }else{
              $payload['metadata']['payload'][0]['description'] = 'No comments';
            }
            $payload['metadata']['payload'][0]['header']['imgSrc'] = null;
            return json_encode($payload);

        }else{

            unset($payload['metadata']);
            unset($payload['fulfillment']);
            $payload['trigger'] = $payload['id'];           
            $payload['message'] = $res['message'];
            $payload['userInput'] = true;
            $payload['id'] = $previousIntent;

                $inputOption = new \stdclass();
                $inputOption->type = "text";
                $inputOption->maxLength = 20;
                $inputOption->optional = false;
                $inputOption->errorMessage = "Enter valid Ticket No.";
                $payload['inputOptions'] = $inputOption;
            return json_encode($payload);

        }
    }



    public function handleActionVerifyDealerForProduct(array $payload,$version){

       $dealer_code = $payload['fulfillment']['parameters']['dealer_code'];
       $previousIntent = $payload['fulfillment']['previousIntent'];

        $post = [
            'dealer_code' => $dealer_code,
        ];

        $ch = curl_init(base_url.'/public/api/verifyDealer');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response,true);

        if($res['status']){
            $payload['message'] = "Welcome <b>".$res['data']['accountname']."</b>..<br>Please select the product";
            return json_encode($payload);

        }else{

            unset($payload['metadata']);
            unset($payload['fulfillment']);
            $payload['trigger'] = $payload['id'];           
            $payload['message'] = $res['message'];
            $payload['userInput'] = true;
            $payload['id'] = $previousIntent;

                $inputOption = new \stdclass();
                $inputOption->type = "text";
                $inputOption->maxLength = 7;
                $inputOption->optional = false;
                $inputOption->errorMessage = "Enter valid Dealer Code";
                $payload['inputOptions'] = $inputOption;
            return json_encode($payload);

        }
    }


    public function handleActionGetTicketsByProduct(array $payload,$version){


       $dealer_code = $payload['fulfillment']['parameters']['dealer_code'];
       $product_name = $payload['fulfillment']['parameters']['product'];
       $previousIntent = $payload['fulfillment']['previousIntent'];

        $post = [
            'dealer_code' => $dealer_code,
            'product_name' => $product_name
        ];

        $ch = curl_init(base_url.'/public/api/fetchTicketByProductName');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response,true);

        if($res['status']){

            $ticketRes = [];
            foreach ($res['data'] as $ticket) {
                $main = new \stdclass();
                $header = new \stdclass();
                $header->overlayText = "Ticket No. : ".$ticket['ticket_no'];  
                // $header->imgSrc = $payload['metadata']['payload'][0]['header']['imgSrc']; 
                $header->imgSrc = null; 
                $main->header = $header;
                $main->title = $dealer_code . " : " . $ticket['ticket_title'];
                $main->subtitle = "Status: ". $ticket['ticketstatus'];
                if($ticket['cf_908'] && $ticket['cf_908'] != '' && $ticket['ticketstatus'] != 'Closed' && $ticket['ticketstatus'] != 'Open'){
                    $main->subtitle = $main->subtitle . ' - ' . $ticket['cf_908']; 
                }
                $main->description = "Created at : ". $ticket['createdtime'];
                // $main->buttons = $payload['metadata']['payload'][0]['buttons'];
                $main->buttons = [];
                array_push($ticketRes,$main);
            }
            $payload['metadata']['payload'] = $ticketRes;
            return json_encode($payload);

        }else{

            // unset($payload['metadata']);
            // unset($payload['fulfillment']);
            // $payload['trigger'] = $payload['id'];           
            // $payload['message'] = $res['message'];
            // $payload['userInput'] = true;
            // $payload['id'] = $previousIntent;

            //     $inputOption = new \stdclass();
            //     $inputOption->type = "text";
            //     $inputOption->maxLength = 7;
            //     $inputOption->optional = false;
            //     $inputOption->errorMessage = "Enter valid Dealer Code";
            //     $payload['inputOptions'] = $inputOption;

            // Log::useDailyFiles(storage_path().'/logs/webhook.log');
            // Log::info($res);
            return json_encode($payload);


        }
    }


    public function handleActionAnswerQuestion(array $payload,$version){

    	    $topic = $payload['fulfillment']['parameters']['topic'];
    	    $arr1 = ['Location'=>'cat4','Rooms'=>'cat5','Tarrif Rooms'=>'cat6','Cottage'=>'cat7','Activities'=>'cat8','Food'=>'cat9','Bills'=>'cat10','Policy'=>'cat11','Booking'=>'cat12','Nearby Facilities'=>'cat13','COVID'=>'cat14'];

    	    $arr2 = [
    	    	       "Which is this Resort?" => "We are situated in Hampi,Karnataka",
    	    	       "Where is this resort Located?" => "We are situated in Hampi,Karnataka",
    	    	       "In which state Resort is located?" => "We are situated in Hampi,Karnataka",
    	    	       "What are the category of rooms?" => "We have 3 Categories of Rooms, Standard rooms with bush view, Deluxe River Facing Rooms and Executive Cottage",
    	    	       "How many rooms does the resort have?" => "Hampi's Boulders is a 16 room boutique property",
    	    	       "How many can stay in 1 room?" => "It depends on the room availability, please feel free to call us on 9480904202",
    	    	       "What kind of Extra bed do you provide?" => "We provide a roll on extra bed",
    	    	       "What are the Room Amenities" => "Water Kettel,Air conditioner.Safe Locker, FanPlease feel free to call us on 9480904202 for more details",
    	    	       "What is the room tariff?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "What does the room tariff include?" => "Tariff includes breakfast",
    	    	       "Is all meals included in the tariff?" => "The package includes only breakfast",
    	    	       "What is the tax component on tariff?" => "Tax Component id 12 and 18% respectively",
    	    	       "Are there individual cottages?" => "Yes, but we have only few individual cottages",
    	    	       "Do you have a restaurant?" => "Yes we do, our restaurant serves Buffet with a spread of Veg and Non-veg for lunch and dinner at an additonal cost",
    	    	       "Do you have any special offer?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "Is there drivers accommodation?" => "Yes,there is dormitory facility for the drivers",
    	    	       "What is check in and check out time?" => "Check in: 1pm and Check out:11am",
    	    	       "Is there Car parking?" => "Yes,there is safe car parking",
    	    	       "Is there extension of Check out Time?" => "Extension of rooms is as per availability of rooms",
    	    	       "What are the activities?" => "Complimentary Activities: River Trail ,Lake Walk,Waterfall rock path,Island Visit.",
    	    	       "Are activities chargeable?" => "Only the Wilderness Drive and Hampi Sighseeing is Chargeable",
    	    	       "Can activities be included in the package as complimentary?" => "Unfortunately not,we are sorry",
    	    	       "Can I have all meals ?" => "Yes you can have buffet at our restaurant",
    	    	       "Can I have breakfast and Dinner plan?" => "We are sorry, we do not have a Breakfat and Dinne Plan.",
    	    	       "What is the spread of food in the buffet?" => "It is a spread of veg and Non veg with local flavours",
    	    	       "Is it Buffet or a la carte?" => "It is buffet, but you also have a la carte service",
    	    	       "Can we get our drinks?" => "We do not allow liquor in public areas",
    	    	       "What is the timing for meals?" => "Breakfast:8-9:30am/Lunch: 1-3pm/Dinner: 8-9:30pm",
    	    	       "Can we get a candle light dinner, what is the cost and what does it include?" => "Candle Light dinner is Rs 3000 per couple with complimnetary cake.",
    	    	       "Where does Candle light dinner be set up?" => "Candle light dinner depends on the weather on your arrival date",
    	    	       "Would require a cake !" => "Sure we can organise a 1/2 Kg cake at Rs 750",
    	    	       "What is the menu for meals?" => "Food menu has a spread of Veg and Non Veg as per chef’s choice.",
    	    	       "Can I get a GST bill?" => "Yes, we will provide a GST bill for your stay.",
    	    	       "Can you give me better rate than OTA’s?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "Is it separate rate for Indians and Foreigners?" => "We have uniform rates for accommodtion, food and activites.",
    	    	       "Do we have to pay for children ?" => "Yes, 5-12 yrs are chargeable as children",
    	    	       "What are your child policy?" => "5-12 yrs are chargeable as children",
    	    	       "What is the cancellation policy?" => "Cancellation Policy
																100% refund for cancellation before 30 days of check in
																50% refund for cancellation between 15-30 days of check in
																25% refund for cancellation between 7-15 days of check in
																No refund for cancellation less than 7 days of check in",
    	    	       "Can I get a credit note?" => "Yes, you may ony if there is a lockdown or Travel restriction imposed by the Government.",
    	    	       "What is the process to book the room?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "How can I make payment?" => "Once confirmed oncall, we will be able to help you with a voucher and an online payment link on your registered email",
    	    	       "Can I make payment during check in?" => "A minimum of 50% is mandatory to block the rooms",
    	    	       "How much payment should I make to make a reservation?" => "A minimum of 50% is mandatory to block the rooms",
    	    	       "Can I amend the booking later?" => "Booking once made can be amended prior to a month or with supporting medical certificates",
    	    	       "Can credit note be used by my friend or relative." => "The credit Note is non transferable.",
    	    	       "How far are you from nearby destination" => "We are at 25 mins drive to Virupaksha Temple",
    	    	       "Where is the nearby hospital ?" => "Gangavathi and Hospet",
    	    	       "Do you need vaccination certificate?" => "We would certainly suggest that you carry your vaccination certificates",
    	    	       "What if there is a lockdown or travel restriction?" => "In case of a lockdown or a covid situation, the booking will be termed as a credit voucher to be used within a time validity. This will be processed only with the discretion of the management.",
    	            ];



    	    if(isset($payload['fulfillment']['parameters'][$arr1[$topic]])){

    	    	$question = $payload['fulfillment']['parameters'][$arr1[$topic]];

    	    	if(is_array($question) && isset($question[0]['label'])){
                    $text = $question[0]['label'];
					$arr = [];
					$max = 0;
					$question = '';
					$response = '';
					foreach (array_keys($arr2) as $array_key) {
					    similar_text($text,$array_key,$percent);
					    array_push($arr,[$array_key => $percent]);
					    if($percent > $max){
					        $max = $percent;
					        if($max > 50){
					            $question = $array_key;
					            $response = $arr2[$array_key];
					        }else{
					            $response = "Oops sorry we didn’t get your question.<br>For further help contact us on 9480904202.";
					        }
					    }
					}  
					$payload['message'] = $response;
    	    	}else{
	    	    		$payload['message'] = "Oops sorry we didn’t get your question.<br>For further help contact us on 9480904202.";
    	    	}
    	    }else{
    	    		$payload['message'] = "Oops sorry we didn’t get your question.<br>For further help contact us on 9480904202.";
    	    }


            return json_encode($payload);
    }


        public function handleActionAnswerQuestionTwo(array $payload,$version){

    	    $question = $payload['fulfillment']['parameters']['question'];

    	    $arr2 = [
    	    	       "Which is this Resort?" => "We are situated in Hampi,Karnataka",
    	    	       "Where is this resort Located?" => "We are situated in Hampi,Karnataka",
    	    	       "In which state Resort is located?" => "We are situated in Hampi,Karnataka",
    	    	       "What are the category of rooms?" => "We have 3 Categories of Rooms, Standard rooms with bush view, Deluxe River Facing Rooms and Executive Cottage",
    	    	       "How many rooms does the resort have?" => "Hampi's Boulders is a 16 room boutique property",
    	    	       "How many can stay in 1 room?" => "It depends on the room availability, please feel free to call us on 9480904202",
    	    	       "What kind of Extra bed do you provide?" => "We provide a roll on extra bed",
    	    	       "What are the Room Amenities" => "Water Kettel,Air conditioner.Safe Locker, FanPlease feel free to call us on 9480904202 for more details",
    	    	       "What is the room tariff?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "What does the room tariff include?" => "Tariff includes breakfast",
    	    	       "Is all meals included in the tariff?" => "The package includes only breakfast",
    	    	       "What is the tax component on tariff?" => "Tax Component id 12 and 18% respectively",
    	    	       "Are there individual cottages?" => "Yes, but we have only few individual cottages",
    	    	       "Do you have a restaurant?" => "Yes we do, our restaurant serves Buffet with a spread of Veg and Non-veg for lunch and dinner at an additonal cost",
    	    	       "Do you have any special offer?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "Is there drivers accommodation?" => "Yes,there is dormitory facility for the drivers",
    	    	       "What is check in and check out time?" => "Check in: 1pm and Check out:11am",
    	    	       "Is there Car parking?" => "Yes,there is safe car parking",
    	    	       "Is there extension of Check out Time?" => "Extension of rooms is as per availability of rooms",
    	    	       "What are the activities?" => "Complimentary Activities: River Trail ,Lake Walk,Waterfall rock path,Island Visit.",
    	    	       "Are activities chargeable?" => "Only the Wilderness Drive and Hampi Sighseeing is Chargeable",
    	    	       "Can activities be included in the package as complimentary?" => "Unfortunately not,we are sorry",
    	    	       "Can I have all meals ?" => "Yes you can have buffet at our restaurant",
    	    	       "Can I have breakfast and Dinner plan?" => "We are sorry, we do not have a Breakfat and Dinne Plan.",
    	    	       "What is the spread of food in the buffet?" => "It is a spread of veg and Non veg with local flavours",
    	    	       "Is it Buffet or a la carte?" => "It is buffet, but you also have a la carte service",
    	    	       "Can we get our drinks?" => "We do not allow liquor in public areas",
    	    	       "What is the timing for meals?" => "Breakfast:8-9:30am/Lunch: 1-3pm/Dinner: 8-9:30pm",
    	    	       "Can we get a candle light dinner, what is the cost and what does it include?" => "Candle Light dinner is Rs 3000 per couple with complimnetary cake.",
    	    	       "Where does Candle light dinner be set up?" => "Candle light dinner depends on the weather on your arrival date",
    	    	       "Would require a cake !" => "Sure we can organise a 1/2 Kg cake at Rs 750",
    	    	       "What is the menu for meals?" => "Food menu has a spread of Veg and Non Veg as per chef’s choice.",
    	    	       "Can I get a GST bill?" => "Yes, we will provide a GST bill for your stay.",
    	    	       "Can you give me better rate than OTA’s?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "Is it separate rate for Indians and Foreigners?" => "We have uniform rates for accommodtion, food and activites.",
    	    	       "Do we have to pay for children ?" => "Yes, 5-12 yrs are chargeable as children",
    	    	       "What are your child policy?" => "5-12 yrs are chargeable as children",
    	    	       "What is the cancellation policy?" => "Cancellation Policy
																100% refund for cancellation before 30 days of check in
																50% refund for cancellation between 15-30 days of check in
																25% refund for cancellation between 7-15 days of check in
																No refund for cancellation less than 7 days of check in",
    	    	       "Can I get a credit note?" => "Yes, you may ony if there is a lockdown or Travel restriction imposed by the Government.",
    	    	       "What is the process to book the room?" => "Please feel free to call us on 9480904202 for more details",
    	    	       "How can I make payment?" => "Once confirmed oncall, we will be able to help you with a voucher and an online payment link on your registered email",
    	    	       "Can I make payment during check in?" => "A minimum of 50% is mandatory to block the rooms",
    	    	       "How much payment should I make to make a reservation?" => "A minimum of 50% is mandatory to block the rooms",
    	    	       "Can I amend the booking later?" => "Booking once made can be amended prior to a month or with supporting medical certificates",
    	    	       "Can credit note be used by my friend or relative." => "The credit Note is non transferable.",
    	    	       "How far are you from nearby destination" => "We are at 25 mins drive to Virupaksha Temple",
    	    	       "Where is the nearby hospital ?" => "Gangavathi and Hospet",
    	    	       "Do you need vaccination certificate?" => "We would certainly suggest that you carry your vaccination certificates",
    	    	       "What if there is a lockdown or travel restriction?" => "In case of a lockdown or a covid situation, the booking will be termed as a credit voucher to be used within a time validity. This will be processed only with the discretion of the management.",
    	            ];



    	    if($question){
                $text = $question;
				$arr = [];
				$max = 0;
				$question = '';
				$response = '';
				foreach (array_keys($arr2) as $array_key) {
				    similar_text($text,$array_key,$percent);
				    array_push($arr,[$array_key => $percent]);
				    if($percent > $max){
				        $max = $percent;
				        if($max > 50){
				            $question = $array_key;
				            $response = $arr2[$array_key];
				        }else{
				            $response = "Oops sorry we didn’t get your question.<br>For further help contact us on 9480904202.";
				        }
				    }
				}  
				$payload['message'] = $response;
	    	}
            return json_encode($payload);
    }



    public function handleActionGetLastTickets(array $payload,$version){

       $dealer_code = $payload['fulfillment']['parameters']['dealer_code'];
       $previousIntent = $payload['fulfillment']['previousIntent'];

        $post = [
            'dealer_code' => $dealer_code,
        ];

        $ch = curl_init(base_url.'/public/api/fetchTicket');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response,true);


        if($res['status']){

            $ticketRes = [];
            foreach ($res['data'] as $ticket) {
                $main = new \stdclass();
                $header = new \stdclass();
                $header->overlayText = "Ticket No. : ".$ticket['ticket_no'];  
                // $header->imgSrc = $payload['metadata']['payload'][0]['header']['imgSrc']; 
                $header->imgSrc = null; 
                $main->header = $header;
                $main->title = $dealer_code . " : " . $ticket['ticket_title'];
                $main->subtitle = "Status: ". $ticket['ticketstatus'];
                if($ticket['cf_908'] && $ticket['cf_908'] != '' && $ticket['ticketstatus'] != 'Closed' && $ticket['ticketstatus'] != 'Open'){
                    $main->subtitle = $main->subtitle . ' - ' . $ticket['cf_908']; 
                }
                $main->description = "Created at : ". $ticket['createdtime'];
                // $main->buttons = $payload['metadata']['payload'][0]['buttons'];
                $main->buttons = [];
                array_push($ticketRes,$main);
            }
            $payload['metadata']['payload'] = $ticketRes;
            return json_encode($payload);

        }else{

            unset($payload['metadata']);
            unset($payload['fulfillment']);
            $payload['trigger'] = $payload['id'];           
            $payload['message'] = $res['message'];
            $payload['userInput'] = true;
            $payload['id'] = $previousIntent;

                $inputOption = new \stdclass();
                $inputOption->type = "text";
                $inputOption->maxLength = 7;
                $inputOption->optional = false;
                $inputOption->errorMessage = "Enter valid Dealer Code";
                $payload['inputOptions'] = $inputOption;

            // Log::useDailyFiles(storage_path().'/logs/webhook.log');
            // Log::info($payload);
            return json_encode($payload);


        }
    }

    public function handleActionGenerateTicketid(array $payload,$version){

        $chatId = $payload['chatId'];
        $entry = Botgotest::firstOrNew(['chatId' => $chatId]);

        $url = CONFIG_URL . '/webservice.php?operation=retrieve&sessionName='.$this->vlogin()->result->sessionName.'&id='.$entry->ticket_id;

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
              $payload['message'] = 'Your ticket ID is <b>'.$res2->result->ticket_no.'</b>';
              return json_encode($payload);
            }
        }
        return json_encode($payload);

    }


    public function handleActionLinkFilesWithTicketComment(array $payload,$version){

        $file_details = $payload['fulfillment']['parameters']['files'];
        $chatId = $payload['chatId'];
        $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
        $ticket = explode('x',$entry->ticket_to_update)[1]; 

        if(strpos(CONFIG_URL, 'demo')){
            $ticket2 =  \DB::connection('demo')->table('vtiger_crmentity')->where('crmid',$ticket)->first();
        }else{
            $ticket2 =  \DB::connection('kia')->table('vtiger_crmentity')->where('crmid',$ticket)->first();
        }      

        if($ticket2){
           if($ticket2->setype != 'HelpDesk'){
             return json_encode($payload);
           }
        }else{
            return json_encode($payload);
        }

            $url = $file_details[0]['url'];
            if (strpos($url,'https://botgo.s3.ap-south-1.amazonaws.com/') === false) {
              $url = 'https://botgo.s3.ap-south-1.amazonaws.com/'.$file_details[0]['url'];
            }
          $file_name = $file_details[0]['filename'];

            $entry->url = $url;
            $entry->save();

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
  
                     
        return json_encode($payload);
    }


    public function handleActionLinkFilesWithTicket(array $payload,$version){

        $file_details = $payload['fulfillment']['parameters']['files'];

        if($version == 'v2'){
            Log::useDailyFiles(storage_path().'/logs/webhook1.log');
            Log::info(json_encode($payload));
        }

		$chatId = $payload['chatId'];
        $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
        $ticket = explode('x',$entry->ticket_id)[1]; 

        if(strpos(CONFIG_URL, 'demo')){
            $ticket2 =  \DB::connection('demo')->table('vtiger_crmentity')->where('crmid',$ticket)->first();
        }else{
            $ticket2 =  \DB::connection('kia')->table('vtiger_crmentity')->where('crmid',$ticket)->first();
        }      

		    if($ticket2){
		       if($ticket2->setype != 'HelpDesk'){
		         return json_encode($payload);
		       }
		    }else{
		        return json_encode($payload);
		    }

            $url = urldecode($file_details[0]['url']);
            Log::useDailyFiles(storage_path().'/logs/webhook.log');
            Log::info($url);
            if (strpos($url,'https://botgo.s3.ap-south-1.amazonaws.com/') === false) {
              $url = 'https://botgo.s3.ap-south-1.amazonaws.com/'.$file_details[0]['url'];
            }
	        $file_name = $file_details[0]['filename'];

            $entry->url = $url;
            $entry->save();

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

            if($version == 'v2'){
                Log::useDailyFiles(storage_path().'/logs/webhook.log');
                Log::info(json_encode($payload));
            }
	
                     
        return json_encode($payload);
    }

    public function handleActionVerifyDealerCreateTicket(array $payload,$version){

       $dealer_code = $payload['fulfillment']['parameters']['dealer_code'];
       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];

        $post = [
            'dealer_code' => $dealer_code,
        ];

        $ch = curl_init(base_url.'/public/api/verifyDealer');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response,true);

        if($res['status']){

            $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
            $entry->chatId = $chatId;
            $entry->dealer_code = $dealer_code;
            $entry->save();
            return json_encode($payload);

        }else{

            unset($payload['metadata']);
            unset($payload['fulfillment']);
            $payload['trigger'] = $payload['id'];           
            $payload['message'] = $res['message'];
            $payload['userInput'] = true;
            $payload['id'] = $previousIntent;

                $inputOption = new \stdclass();
                $inputOption->type = "text";
                $inputOption->maxLength = 7;
                $inputOption->optional = false;
                $inputOption->errorMessage = "Enter valid Dealer Code";
                $payload['inputOptions'] = $inputOption;
            return json_encode($payload);

        }
    }


    public function handleActionAddCommentToTicket(array $payload,$version){

       $comment = $payload['fulfillment']['parameters']['comment'];
       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];
       $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
       $ticket_id = $entry->ticket_to_update;

       $t_id = substr($ticket_id,3);
       $ticupdate = \DB::connection('kia')->table('vtiger_ticketcf')->where('ticketid',$t_id)->update(['cf_1014' => 'yes']);
 
                    $data = array(
                        'commentcontent' => $comment,
                        'assigned_user_id' => '$vtiger->_userid',
                        'related_to' => $ticket_id, // ticket id
                        'creator' => '19x1',
                        'customer' => $entry->contact_id,
                        'source' => "CRM",
                        'is_private' => "0",
                    );

                    $post = [
                        'operation' => 'create',
                        'sessionName' => $this->vlogin()->result->sessionName,
                        'element'   => json_encode($data),
                        'elementType' => 'ModComments',
                    ];


                    $ch = curl_init(CONFIG_URL . '/webservice.php');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

                    $response2 = curl_exec($ch);
                    curl_close($ch);
                    $res2 = json_decode($response2);

                    if($res2){

                        return json_encode($payload);

                    }else{
                        
                        $payload['message'] = "some error occurred while adding the comment."; 
                        $payload['trigger'] = 1;  
                        unset($payload['fulfillment']);
                        return json_encode($payload);
                    }

    }

    public function handleActionCheckPrevTicket(array $payload,$version){

       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];

       $upcoming = Botgotest::where('chatId',$chatId)->first();
       //get last generated ticket by same dealer code in one hour with same details selected..
       $exists = Botgotest::where('dealer_code',$upcoming->dealer_code)
                              ->whereNotNull('ticket_id')
                              ->where('category1',$upcoming->category1)
                              ->where('category2',$upcoming->category2)
                              ->where('category3',$upcoming->category3)
                              ->where("created_at",">",Carbon::now()->subHour())
                              ->first();


       if($exists){
          $ticket = \DB::connection('kia')->table('vtiger_troubletickets')->where('ticketid',explode('x',$exists->ticket_id)[1])->first(); 
          $payload['message'] = "Sorry but, A Ticket No.: <b>".$ticket->ticket_no."</b>,<br> Title: <b>".$exists->subject."</b>,<br> already locked by your Dealership today, Kindly check once.";
       }else{
          unset($payload['metadata']);
          $payload['trigger'] = 113;
       }
        
       return json_encode($payload);
    }



    public function handleActionCreateTicketBotgo(array $payload,$version){

       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];
        
         $entry;
        do {
           $entry = Botgotest::where('chatId',$chatId)->first();
        }while ($entry->subject == '');

        $post = [
            'ticket_title' => 'B! - ' . $entry->subject,
            'ticketstatus' => 'Open',
            'ticketpriorities' => 'Medium',
            'description' => $entry->description,
            'dealer_code' => $entry->dealer_code,
            'product' => $entry->category1,
            'module' => $entry->category2,
            'issue_category' => $entry->category3,
            'name' => $entry->name,
            'email' => $entry->email,
            'mobile' => $entry->mobile,
        ];

        $ch = curl_init(base_url.'/public/api/createTicket');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response,true);



            // Log::useDailyFiles(storage_path().'/logs/ticket.log');
            // Log::info($res);

        if($res['status']){
        	$entry->ticket_id  = $res['data']['id'];
        	$entry->save(); 
            return json_encode($payload);

        }else{        
            $payload['message'] = "Some error occurred, Please try again after sometime";
            $payload['trigger'] = 1;
            return json_encode($payload);
        }
    }



    public function handleActionCategory1(array $payload,$version){

       $category1 = $payload['fulfillment']['parameters']['category1'];
       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];

       $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
       $entry->category1 = $category1;
       $entry->save();

       return json_encode($payload);
    }



    public function handleActionCategory2(array $payload,$version){

       $category2 = $payload['fulfillment']['parameters']['category2'];
       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];

       $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
       $entry->category2 = $category2;
       $entry->save();

       return json_encode($payload);
    }



    public function handleActionCategory3(array $payload,$version){

       $category3 = $payload['fulfillment']['parameters']['category3'];
       $previousIntent = $payload['fulfillment']['previousIntent'];
       $chatId = $payload['chatId'];

       $entry = Botgotest::firstOrNew(['chatId' => $chatId]);
       $entry->category3 = $category3;
       $entry->save();

       return json_encode($payload);
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


























    public function handleGetUserName(array $payload,$version)
    {
    	$agent = new WebhookClient($payload);
    	$details = explode('/', $agent->getSession());
    	$chat = Chat::where('session',$details[4])->first();
        $prm = $agent->getParameters();
        $chat->name = $prm['user-name'];
        $chat->save();
        return response()->json($agent->render());
    }

    public function handleActionUserEmail(array $payload,$version)
    {
    	$agent = new WebhookClient($payload);
    	$details = explode('/', $agent->getSession());
    	$chat = Chat::where('session',$details[4])->first();
        $prm = $agent->getParameters();
        $chat->email = $prm['email'];
        $chat->save();
        return response()->json($agent->render());
    }

    public function handleActionUserPhone(array $payload,$version){

    	$agent = new WebhookClient($payload);
    	$categories = Category::where('parent_id',0)->get();

    	$details = explode('/', $agent->getSession());
    	$chat = Chat::where('session',$details[4])->first();
        $prm = $agent->getParameters();
        $chat->phone = $prm['phone-number'];
        $chat->save();

    	$richcontent = [];
    	$richcontent[0] = [];

    	foreach ($categories as $category){

    		  $element = new \stdclass();
    		  $element->type = 'list';
    		  $element->title = $category->title;
    		    $action = new \stdclass();
    		       $param = new \stdclass();
    		    if(Category::where('parent_id',$category->id)->count() > 0){
    		      $action->name = "get_sub_category";
	    		       $param->selected_id = (string)$category->id;
	    		       $param->selected_title = $category->title;
    		    }else{
    		      $action->name = "end_category_selection";
	    		       $param->last_selected_category = $category->id;
    		    }
    		    $action->languageCode = '';
    		    $action->parameters = $param;
    		  $element->event = $action;

    		  array_push($richcontent[0], $element);

    	}
		$response = new \stdclass();
         $fulfillmentMessages = [];

           $textObjOuter = new \stdclass();
           $textObj = new \stdclass();
           $textObj->text = ['Thanks. Please select an issue type, for which you want to create a support ticket.'];
           $textObjOuter->text = $textObj;
   
           $list = new \stdclass();
           $payload = new \stdclass();
           $payload->richContent = $richcontent;
           $list->payload = $payload;

           array_push($fulfillmentMessages,$textObjOuter);
           array_push($fulfillmentMessages,$list);
           
         $response->fulfillmentMessages = $fulfillmentMessages;

    	return response()->json($response);
           
    }

    public function handleActionCategory(array $payload,$version){
            // Log::useDailyFiles(storage_path().'/logs/webhook.log');
            // Log::info(json_encode($payload));

    	$agent = new WebhookClient($payload);
        $prm = $agent->getParameters();
   
    	$categories = Category::where('parent_id',$prm['selected_id'])->get();

    	$richcontent = [];
    	$richcontent[0] = [];

    	foreach ($categories as $category){

    		  $element = new \stdclass();
    		  $element->type = 'list';
    		  $element->title = $category->title;
    		    $action = new \stdclass();
    		       $param = new \stdclass();
    		    if(Category::where('parent_id',$category->id)->count() > 0){
    		      $action->name = "get_sub_category";
	    		       $param->selected_id = (string)$category->id;
	    		       $param->selected_title = $category->title;
    		    }else{
    		      $action->name = "end_category_selection";
	    		       $param->last_selected_category = $category->id;
    		    }
    		    $action->languageCode = '';
    		    $action->parameters = $param;
    		  $element->event = $action;

    		  array_push($richcontent[0], $element);

    	}
		$response = new \stdclass();
         $fulfillmentMessages = [];

           $textObjOuter = new \stdclass();
           $textObj = new \stdclass();
           $textObj->text = ['Please select a sub-category for '. $prm['selected_title']];
           $textObjOuter->text = $textObj;
   
           $list = new \stdclass();
           $payload = new \stdclass();
           $payload->richContent = $richcontent;
           $list->payload = $payload;

           array_push($fulfillmentMessages,$textObjOuter);
           array_push($fulfillmentMessages,$list);

         $response->fulfillmentMessages = $fulfillmentMessages;

    	return response()->json($response);
           
    }

    public function handleEndCategorySelection(array $payload,$version)
    {
    	$agent = new WebhookClient($payload);
        $prm = $agent->getParameters();

       $selected = Category::find($prm['last_selected_category']);
       $title = [];
       array_push($title,$selected->title);
       $parent = $selected->parent_id;
       while($parent != 0){
          $cgy = Category::find($parent);
          array_push($title,$cgy->title);
          $parent = $cgy->parent_id;
       }
       $title = array_reverse($title);
       $title = implode("/",$title);

        $details = explode('/', $agent->getSession());
    	$chat = Chat::where('session',$details[4])->first();
        $chat->title = $title;
        $chat->category_id = $prm['last_selected_category'];
        $chat->save();

        return response()->json($agent->render());
        
    }

     /**
     * Verify dealer code
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function handleActionDealerCode(array $payload,$version)
     {  


			$details = explode('/', $payload['queryResult']['outputContexts'][0]['name']);

			$post = [
                'dealer_code' => $payload['queryResult']['parameters']['dealer_code'],
            ];

            $ch = curl_init('https://kia.chatbot.inhelpdesk.com/public/api/verifyDealer');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            $response = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($response);

            $output = "";
            if($res->status == 1){
                
                $session = $details[4]; 
                $prev = Chat::where('session',$session)->first();
                if($prev){
                    $prev->dealer_code = $payload['queryResult']['parameters']['dealer_code'];
                    $prev->save();
                }else{
	                $chat = new Chat();
	                $chat->session = $session;
	                $chat->dealer_code = $payload['queryResult']['parameters']['dealer_code'];
	                $chat->save();
                }


				$output= "May I know your name please?";
	     	    $response = new \stdclass();
				       $outputcontext_res = [];
				       $outputcontext_res[0]['name'] = 'projects/'.$details[1].'/agent/sessions/'.$details[4].'/contexts/get_user_name';
				       $outputcontext_res[0]['lifespanCount'] = 1;
			    $response->outputContexts = $outputcontext_res;
			    $response->fulfillmentText = $output;
			    return response()->json($response);
            }
			else{
				$output = "Please enter valid dealer code";
	     	    $response = new \stdclass();
				       $outputcontext_res = [];
				       $outputcontext_res[0]['name'] = 'projects/'.$details[1].'/agent/sessions/'.$details[4].'/contexts/dealer_code';
				       $outputcontext_res[0]['lifespanCount'] = 1;
			    $response->outputContexts = $outputcontext_res;
			    $response->fulfillmentText = $output;
			    return response()->json($response);
			}
     }

     /**
     * Verify dealer code
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function handleActionIssueRemark(array $payload,$version)
     {
            //Log::useDailyFiles(storage_path().'/logs/webhook.log');
           // Log::info(json_encode($payload));

     	$agent = new WebhookClient($payload);
        $prm = $agent->getParameters();
        $details = explode('/', $agent->getSession());

        $chat = Chat::where('session',$details[4])->first();

        $description = $prm['issue'] . PHP_EOL . 'NAME: ' . $chat->name . PHP_EOL . 'EMAIL: ' . $chat->email . PHP_EOL . 'PHONE: ' . $chat->phone;

    	$post = [
            'ticket_title' => $chat->title,
            'ticketstatus' => 'Open',
            'ticketpriorities' => 'Medium',
            'description' => $description,
            'dealer_code' => $chat->dealer_code
        ];

        $ch = curl_init('https://kia.chatbot.inhelpdesk.com/public/api/createTicket');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);
        
        if($res->status){
           $agent->reply('Dear '.$chat->name.', Your ticket has been successfully created and your ticket number is '. $res->data->ticket_no); 
           $chat->ticket_id = $res->data->id;
           $chat->description = $prm['issue'];
           $chat->save(); 
        }else{
           $agent->reply('Dear '.$chat->name.'I am unable to create ticket right now. please try after sometime !!'); 
        }   	

     	return response()->json($agent->render());

     }

     /**
     * Verify dealer code
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function handleActionTicketStatusResponse(array $payload,$version)
     {
     	dd("erer");
     }



     /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function missingMethod($parameters = [])
    {
        return new Response;
    }


}
