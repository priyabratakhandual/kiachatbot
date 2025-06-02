<?php
$style = [
'mail-border' => 'border: 1px solid black;border-collapse: collapse;width:100%;color:black;',
'mail-border3' => 'border: 1px solid black;border-collapse: collapse;color:black;',
'mail-border2' => 'border: 1px solid black;border-collapse: collapse;padding: 10px;color:black;'
];
?>
<p style="color:black;">Hello Sir</p>
<p style="color:black;">Hope you are doing good!</p>
<p style="color:black;">This is regarding your SOLMAN ticket no : {{$details['ticket_id']}}, Which is in Customer action and need your valuable input to process it further. Below are the details related to your ticket, please login into the Solman portal & provide us required details to serve you quickly.</p>
<table style="{{ $style['mail-border'] }}">
  <tr style="{{ $style['mail-border3'] }}">
    <th style="{{ $style['mail-border2'] }}">ID</th>
    <th style="{{ $style['mail-border2'] }}">Description</th> 
    <th style="{{ $style['mail-border2'] }}">Status</th>
    <th style="{{ $style['mail-border2'] }}">Created On</th>
    <th style="{{ $style['mail-border2'] }}">Created By</th>
    <th style="{{ $style['mail-border2'] }}">Sold-To Party</th>
  </tr>
  <tr style="{{ $style['mail-border3'] }}">
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['ticket_id']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['ticket_desc']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">Customer Action</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['created_on']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['created_by']}}</td>
    <td style="{{ $style['mail-border2'] }}" align="center">{{$details['sold_to_party']}}</td>
  </tr>
</table>
<br>
<p style="color:black;"><b>Note :</b> Please change Ticket status as “<b>In–Process</b>”  from “<b>Customer action</b>”, in case of any further query – I am reachable on below details</p>
<p style="color: black;font-weight:bold;margin:0;">Thanks & Regards</p>
<p style="color: black;margin:0;"><em>Manish  Yadav</em></p>
<p style="color: #1f497d;margin:0;"><em>0124 -4415990</em></p>
<a href='mailto:zzmyadav2@vecv.in'><h3 style="color: blue;margin:0;"><em>zzmyadav2@vecv.in<em><h3></a>

<p style="font-size:0px;">{{time()}}</p>






