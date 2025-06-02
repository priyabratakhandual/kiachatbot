<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;



class FeedbackExport implements FromView
{
    protected $from, $to;

    /**
    * @return \Illuminate\Support\Collection
    */   
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        // $query = DB::connection('kia_activity')->table('attendies')
        // ->select('activity.activity_id' , 'activity.plan_date as act_date_from', 'activity.plan_date as act_date_to', 'activity.activity_type' , 'activity.region' , 
        // 'activity.dealer_code' , 'activity.module' , 'activity.trainer_name', 'activity.status', 'attendies.dms_employee_id' , 'attendies.name' , 'attendies.designation' , 
        // 'attendies.location' , 'attendies.mobile_no', 'feedback_master.question_text as feedback_question' , 'feedbacks.answer as feedback_answer')
        // ->join('feedbacks', 'attendies.id', '=', 'feedbacks.attendie_id')
        // ->join('activity', 'activity.id', '=', 'attendies.activity_id')
        // ->join('feedback_master', 'feedback_master.id', '=', 'feedbacks.question_id')
        // ->whereBetween('activity.plan_date_start', [$this->from, $this->to])
        // ->orderBy('attendies.name', "ASC")
        // ->get();
        // // dd($query);

        $sql = "SELECT activity.activity_id , activity.plan_date as act_date_from, activity.plan_date as act_date_to, activity.activity_type , activity.region , 
        activity.dealer_code , activity.module , activity.trainer_name, activity.status, attendies.dms_employee_id , attendies.name , attendies.designation , 
        attendies.location , attendies.mobile_no, feedback_master.question_text as feedback_question , feedbacks.answer as feedback_answer
        FROM attendies 
        LEFT JOIN feedbacks ON attendies.id = feedbacks.attendie_id 
        LEFT JOIN activity ON activity.id = attendies.activity_id 
        LEFT JOIN feedback_master ON feedback_master.id = feedbacks.question_id        
        WHERE activity.plan_date_start >= '" . $this->from . "' AND activity.plan_date_start <= '" . $this->to . "'";
        $data = DB::connection('kia_activity')->select($sql);        

        return view('activity.activity-feedback-table', [
            'data' => $data
        ]);
    }
}
