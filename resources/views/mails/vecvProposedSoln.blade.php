<?php
$style = [
'mail-border' => 'border: 1px solid black;border-collapse: collapse;width:100%;color:black;',
'mail-border3' => 'border: 1px solid black;border-collapse: collapse;color:black;',
'mail-border2' => 'border: 1px solid black;border-collapse: collapse;padding: 10px;color:black;'
];
?>
<p style="color:black;">Hello Sir</p>
<p style="color:black;">Hope you are doing good!</p>
<p style="color:black;">This is regarding your SOLMAN ticket no : {{$details['ticket_id']}},we would like  to  inform  you that your requested Support incident  is closed.<br><br>In case of any concern still exists please change ticket status as “In Process”  from  "Proposed Solution" with suitable comments so team will take required action.<br><br>Below are the details related to your ticket,  request to please share feedback on the same.<br><br>Your feedback is important to us, complete this short survey that should take no longer than 2 minutes.<br><br>https://vecv.inhelpdesk.com/feedback<br><br>Please Click on the above link and follow the steps.</p>
<p style="font-size:0px;">{{time()}}</p>
<table style="{{ $style['mail-border'] }}">
  <tr style="{{ $style['mail-border3'] }}">
    <th style="{{ $style['mail-border2'] }}">ID</th>
    <th style="{{ $style['mail-border2'] }}">Description</th> 
    <th style="{{ $style['mail-border2'] }}">Status</th>
    <th style="{{ $style['mail-border2'] }}">Closed On</th>
    <th style="{{ $style['mail-border2'] }}">Created By</th>
    <th style="{{ $style['mail-border2'] }}">Sold-To Party</th>
  </tr>
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['ticket_id']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['ticket_desc']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">Proposed Solution</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['closed_on']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['created_by']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['sold_to_party']}}</td>
  </tr>
</table>
<br>
<p style="color:black;"><b>Note : You can reach out to us for any kind of support required on below contact details.</b></p>
<p style="color: black;font-weight:bold;margin:0;">Thanks & Regards</p>
<p style="color: black;margin:0;"><em>Manish  Yadav</em></p>
<p style="color: #1f497d;margin:0;"><em>0124 -4415990</em></p>
<a href='mailto:zzmyadav2@vecv.in'><h3 style="color: blue;margin:0;"><em>zzmyadav2@vecv.in<em><h3></a>

<p style="font-size:0px;">{{time()}}</p>






