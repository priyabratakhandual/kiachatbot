<table>
    <thead>
        <tr>
            <th>Activity ID</th>
            <th>Act_date_from</th>
            <th>Act_date_to</th>
            <th>Activity Type</th>
            <th>Region</th>
            <th>Dealer Code</th>
            <th>Module</th>
            <th>Trainer name</th>
            <th>Status</th>
            <th>DMS Employe ID</th>
            <th>Attendie Name</th>
            <th>Attendie Designation</th>
            <th>Location</th>
            <th>Attendie Mobile</th>
            <th>Feedback Question</th>
            <th>Feedback Answere</th>            
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{$item->activity_id}}</td>
                <td>{{$item->act_date_from}}</td>
                <td>{{$item->act_date_to}}</td>
                <td>{{$item->activity_type}}</td>           
                <td>{{$item->region}}</td>           
                <td>{{$item->dealer_code}}</td>           
                <td>{{$item->module}}</td>           
                <td>{{$item->trainer_name}}</td>           
                <td>{{$item->status}}</td>           
                <td>{{$item->dms_employee_id}}</td>           
                <td>{{$item->name}}</td>           
                <td>{{$item->designation}}</td>           
                <td>{{$item->location}}</td>           
                <td>{{$item->mobile_no}}</td>           
                <td>{{$item->feedback_question}}</td>           
                <td>{{$item->feedback_answer}}</td>           
            </tr>            
        @endforeach
    </tbody>
</table>