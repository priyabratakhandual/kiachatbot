<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Dialogflow\WebhookClient;
use Illuminate\Support\Facades\Mail;
use App\Category;
use App\Chat;
use App\Botgowebsite;
use App\Mail\botgoLead;

class BotgoWebhookController extends Controller
{
    
     /**
     * Handle a webhook call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {

        $payload = json_decode($request['intent'],true);

        $method = 'handle'.Str::studly(str_replace('.', '_', $payload['fulfillment']['action'] ));

        if (method_exists($this, $method)) {
            return $this->{$method}($payload);
        }

        return $this->missingMethod();
    }

    public function botgoContactQuery(Request $request){

      $payload = json_decode($request['webhookData'],true);
      $formData = json_decode($request['submittedData'],true);
      $chatId = $payload['content']['chatId'];
      
      $entry = Botgowebsite::firstOrNew(['chatId' => $chatId]);
      $entry->formOneData = json_encode($formData);
      $entry->save();

      return response()->json([
         'message' => "success"
      ]);
    }

    public function testMail($chatId){
            
      $entry = Botgowebsite::firstOrNew(['chatId' => $chatId]);
      // $entry->previousValues = json_encode($payload['fulfillment']['parameters']);
      // $entry->save();

      $data['formData'] = json_decode($entry->formOneData,true);
      $data['previousValues'] = json_decode($entry->previousValues,true);

      Mail::to(['at002526@gmail.com'])->send(new botgoLead($data));

      return response()->json([
         'message' => "success"
      ]);

    }


    public function handleActionNotifyAdmin(array $payload){
      
      $chatId = $payload['chatId'];
      
      $entry = Botgowebsite::firstOrNew(['chatId' => $chatId]);
      $entry->previousValues = json_encode($payload['fulfillment']['parameters']);
      $entry->save();

      $data['formData'] = json_decode($entry->formOneData,true);
      $data['previousValues'] = json_decode($entry->previousValues,true);

      // Mail::to(['denis@globtier.com','nishul@globtierinfotech.com'])->cc(['aditya@globtierinfotech.com'])->send(new botgoLead($data));
      Mail::to(['aditya@globtierinfotech.com'])->send(new botgoLead($data));

        return json_encode($payload);
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
