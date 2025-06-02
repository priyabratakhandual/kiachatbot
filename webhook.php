<?php
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST")
{
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$action = $json->queryResult->action;
	// $text = $json->result->parameters->text;
 

	switch ($action) {
		case 'action-dealer-code':
			//execute dealer 

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://kia.chatbot.inhelpdesk.com/public/api/verifyDealer",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => array('dealer_code' => 'DLR001'),
			));

			$response = curl_exec($curl);
			curl_close($curl);

			if $response->status ==0:
				$output= "Hello "+$response->data->name +"Dealer, May I know your name please"
			else:
				$output = "Please enter valid Dealer Code"

			$speech = $output;
			break;
		case 'action-issue-remark'
			// api for creating ticket 

			$speech = "Yout ticket ID is "+$ticketID;
			break;

		case 'action-ticket-status-response'

			//api for showing ticket status
				$speech = "Your present ticket status is "+$ticketStatus;
				break;	
		default:
			$speech = "Sorry,i didn't get that"
			break;
	}
    
    $response = new \stdclass();
    $response->speech = "";
    $response->source = "webhook";
    echo json_encode($response);

}

else
{
	echo "Method not alllowed";
}

?>