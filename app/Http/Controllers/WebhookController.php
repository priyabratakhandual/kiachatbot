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



class WebhookController extends Controller
{
    
     /**
     * Handle a webhook call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {

        $payload = json_decode($request->getContent(), true);

        $method = 'handle'.Str::studly(str_replace('.', '_', $payload['queryResult']['action'] ));

        if (method_exists($this, $method)) {
            return $this->{$method}($payload);
        }

        return $this->missingMethod();
    }


    public function handleGetUserName(array $payload)
    {
    	$agent = new WebhookClient($payload);
    	$details = explode('/', $agent->getSession());
    	$chat = Chat::where('session',$details[4])->first();
        $prm = $agent->getParameters();
        $chat->name = $prm['user-name'];
        $chat->save();
        return response()->json($agent->render());
    }

    public function handleActionUserEmail(array $payload)
    {
    	$agent = new WebhookClient($payload);
    	$details = explode('/', $agent->getSession());
    	$chat = Chat::where('session',$details[4])->first();
        $prm = $agent->getParameters();
        $chat->email = $prm['email'];
        $chat->save();
        return response()->json($agent->render());
    }

    public function handleActionUserPhone(array $payload){

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

    public function handleActionCategory(array $payload){
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

    public function handleEndCategorySelection(array $payload)
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
     public function handleActionDealerCode(array $payload)
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
     public function handleActionIssueRemark(array $payload)
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
     public function handleActionTicketStatusResponse(array $payload)
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
