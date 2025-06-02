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
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DataTables;
use DB;

class TrainerController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainers.index');
    }

    public function trainersTable(Request $request)
    {       
        $query = Admin::where('role','2');

        return DataTables::of($query)    
           ->addColumn("check", function ($query) {  
                return "";
              })
           ->addColumn("user_id", function ($query) {  
                return $query->id;
              })      
            ->addColumn('name', function ($query) {               
                return $query->name;
              })      
            ->addColumn('email', function ($query) {               
                return $query->email;
              })    
            ->addColumn('phone', function ($query) {               
                return $query->phone;
              })     
            ->addColumn('emp_code', function ($query) {               
                return $query->emp_code;
              })     
            ->addColumn('status', function ($query) {      
                if($query->active_status == 'active'){
                    $buttom = ' | <a  href="/active-deactive-trainer/'.$query->id.'" class="btn btn-danger" >Deactivate</a>';
                }else {
                    $buttom = ' | <a  href="/active-deactive-trainer/'.$query->id.'" class="btn btn-success" >Activate</a>';
                }         
                return $query->active_status . ' ' . $buttom;
              })             
            ->addColumn('created_at', function ($query) {               
                return $query->created_at;
              })           
             ->addColumn('action', function ($query) {
                return '<a href="'. URL::to('/goahead/show') .'/'.$query->id.'" class="mr-10" data-toggle="tooltip" title="EDIT" ><i class="fa fa-pencil text-inverse m-r-10"></i></a><a data-toggle="tooltip" title="SETUP" href="'. URL::to('/setup') .'"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a>';
            }) 
            ->editColumn('id', 'ID: {{$id}}')
            ->escapeColumns([])       
            ->addIndexColumn()->make(true);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
            'emp_code' => 'required',
            'password' => 'required|string|nullable',
        ]);

        if($validator->fails()){
            
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()
            ]);

        }else{

        	$trainer = new Admin;
        	$trainer->name= $request->name;
        	$trainer->email= $request->email;
        	$trainer->phone= $request->phone;
        	$trainer->emp_code= $request->emp_code;
        	$trainer->role= 2;
        	$trainer->active_status = 'active';
        	$trainer->password= Hash::make($request->password);
        	$trainer->save();

        	return response()->json([
                'status' => 1,
                'message' => []
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['details'] = VisitPlan::find($id);
        return view('training.show',$data);
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

    public function actDeact(Request $request , $id)
    {
        $trainer = Admin::find($id);
        if($trainer->active_status == 'active'){
            $trainer->active_status = 'deactive';
        }else {
            $trainer->active_status = 'active';
        }
        $trainer->save();
        return redirect()->back()->withErrors(['firstname' => 'Trainer deativated']);
        dd($trainer);
    }
}
