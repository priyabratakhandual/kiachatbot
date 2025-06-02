<?php

namespace App\Helpers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Validator;
use Carbon\Carbon;
use App\Admin;
use App\Role;
use App\Activity;
use App\Logs;
use App\Dealer_master;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DataTables;
use DB;


class ActivityDealerController extends Controller
{    
    
    public function index()
    { 
        return view('dealers.index');
    }



    public function create()
    { 
        $data['regions'] = Activity::select('region')->groupBy('region')->get();
        return view('dealers.create',$data);
    }


    public function show($id)
    {   
        $data['trainers'] = Admin::where('role',2)->get();
        $data['details'] = Activity::find(base64_decode($id));
        $data['dealers'] = Dealer_master::all();

        if($data['trainers'] && $data['details'])
          return view('activity.show',$data);
        else
          return redirect('/login');
    }

    public function store(Request $request){
        
                $validator = Validator::make($request->all(), [
                    'region' => 'required',
                    'dealer_code_add' => 'required',
                    'dealer_name' => 'required',
                ]);

            if($validator->fails()){
                
                return response()->json([
                    'status' => 0,
                    'message' => $validator->errors()
                ]);

            }else{

              $dealer = new Dealer_master;
              $dealer->Region = $request->region;
              $dealer->Dealer_code = $request->dealer_code_add;
              $dealer->Dealership_Name = $request->dealer_name;
              if($dealer->save()){

                return response()->json([
                    'status' => 1,
                    'message' => 'success'
                ]);

              }else{
                
                return response()->json([
                    'status' => 0,
                    'message' => 'error'
                ]);

              }

            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
