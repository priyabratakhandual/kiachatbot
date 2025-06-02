<?php
$style = [
'mail-border' => 'border: 1px solid black;border-collapse: collapse;width:100%;color:black;',
'mail-border3' => 'border: 1px solid black;border-collapse: collapse;color:black;',
'mail-border2' => 'border: 1px solid black;border-collapse: collapse;padding: 10px;color:black;'
];
?>
<p style="color:black;">Hello Team,</p>
<p style="color:black;">I have recieved a new lead, details are as follows</p>
<p style="color:black;"></p>
<table style="{{ $style['mail-border'] }}">
  <tr style="{{ $style['mail-border3'] }}">
    <th style="{{ $style['mail-border2'] }}">Questions</th>
    <th style="{{ $style['mail-border2'] }}">Responses</th>
  </tr>
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Username</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['formData']['username']}}</td>
  </tr>
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Organisation</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['formData']['organisation']}}</td>
  </tr>
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Mobile Number</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['formData']['mobile_no.']}}</td>
  </tr>
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Email</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['formData']['email']}}</td>
  </tr>
  @if(strpos($details['previousValues']['two'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Please select which type of chatbot service you are looking for?</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['two']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['three'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Please select the topic!!</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['three']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['four'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Please mention the purpose of this bot (e.g. Lead Generation bot, Helpdesk bot, Survey/Feedback bot, etc)</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['four']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['twelve'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Please describe the industry usage of this bot</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['twelve']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['five'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Will there be any FAQ based training of bot to reply to?</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['five']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['six'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Please enter the numer of FAQ that will be used to train bot on</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['six']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['seven'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">At what platform do you want this chatbot to be deployed on? (Web/Mobile/Social Media Platform/3rd Party Tool)</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['seven']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['eight'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Please provide approximate number of message interactions/request by users.</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['eight']}}</td>
  </tr>
  @endif
  @if(strpos($details['previousValues']['nine'], 'previousValue') == false)
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">Can you provide an approximate value of how many user will be using this bot monthly?</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['previousValues']['nine']}}</td>
  </tr>
  @endif
</table>
<br>
<p style="color: black;font-weight:bold;margin:0;">Thanks & Regards</p>
<p style="color: black;margin:0;"><em>Botgo Chatbot</em></p>

<p style="font-size:0px;">{{time()}}</p>






