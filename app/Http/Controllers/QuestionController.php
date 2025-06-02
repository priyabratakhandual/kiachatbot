<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\FeedBackMaster;


class QuestionController extends Controller
{

    public function index(){
        $data = FeedBackMaster::all();
        return view('questions.index', compact('data'));
    }


    public function create(){
        return view('questions.create');
    }


    public function edit($id){

        $data = FeedBackMaster::find($id);
        return view('questions.edit', compact('data'));
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
             'question_text'=> 'required',
             'question_type' => 'required',
             'status' => 'required',
            //  'required' => 'required',
          ]);
      
          if ($validator->fails()) {
      
            return response()->json([
              'status' => 0,
              'message' => $validator->errors(),
              'data' => null
            ]);
            
          } else {

             $data = $request->all();
             $insertData = FeedBackMaster::create($data);
              return response()->json([
                'status' => 1,
                'data' => $insertData,
                'message' => 'successfully saved!!'
              ]);
          }
    }

    public function update(Request $request, $id){
          // dd($request->all());
        $validator = Validator::make($request->all(), [
            'question_text'=> 'required',
            'question_type' => 'required',
            'status' => 'required',
            // 'required' => 0,
          ]);
      
          if ($validator->fails()) {
      
            return response()->json([
              'status' => 0,
              'message' => $validator->errors(),
              'data' => null
            ]);
            
          } else {
             $updateData = FeedBackMaster::find($id);
             $updateData->question_text = $request->get('question_text');
             $updateData->question_type = $request->get('question_type');
             $updateData->status = $request->get('status');
            //  $updateData->required = $request->get('required');
             $updateData->save();
              
              return response()->json([
                'status' => 1,
                'data' => $updateData,
                'message' => 'successfully saved!!'
              ]);
          }
    }

    public function delete($id){
        $deleteData = FeedBackMaster::destroy($id);
         
        return response()->json([
            'status' => 1,
            'data' => $deleteData,
            'message' => 'data has been deleted successfully!!'
          ]);     
    }

}
