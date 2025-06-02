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
use App\User;
use App\Role;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Datatables;


class FrontendController extends Controller
{   


    public function adminLogin(Request $request){
        if(Session::has('user_details')){
          switch (Session::get('user_details')[0]['role']) {
            case 'manager':
                  return redirect('/dashboard');
              break;
           case 'trainee':
                  return redirect('/coach_Dash');
              break;
            default:
                 return redirect('/');
              break;
          }
        }else{
            return view('auth.login');
        }
      
    }

    public function loginAuthentication(Request $request){

       $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|nullable',
            ]);

        if($validator->fails()){
               return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $credentials = $request->only('email', 'password');
            // echo '<pre>';
            // print_r($credentials);die;
            try{
                if (! $token = JWTAuth::attempt($credentials)) {

                    return redirect()->back()->with('error_loggin','Invalid credentials')->withInput();                    
                }
            }catch (JWTException $e) {
                return redirect()->back()->with('error_loggin','Something went wrong')->withInput();
            }
            //echo 'i am here';die;
            $currentUser = Auth::user();
            // echo '<pre>';
            // print_r($currentUser);die;
            if(!empty($currentUser)){
                if($currentUser->active_status == 'active'){

                    $user = array(
                        'user_id' => $currentUser->id,
                        'user_name' => $currentUser->f_Name . " " . $currentUser->l_Name,
                        'email' => $currentUser->email,
                        'role' => getRoleNameById($currentUser->role),
                        'first_Time' => $currentUser->first_time_login,
                        'timezone' => getTimeZoneOnce()
                    );
                     Session::push('user_details', $user);
                    return redirect('/login');  
                }else{
                    Auth::logout();
                    return redirect('/login')->with('error_loggin','You are not allowed to login');
                }
            }else{
                Auth::logout();
                return redirect('/login')->with('error_loggin','Your account has been deleted,Please contact to super admin');
            }      
        } 
    }


    public function password_set(Request $request){
      if(Session::has('user_Email')){

          $messages = [
            'password.regex' => 'The password format is invalid. It should be of minimum 6 digits and must contain 1 Upper case, 1 Lower case, 1 numeric & 1 Special character',
          ];

          $validator = Validator::make($request->all(), [
                'password' => 'required| min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|nullable',
            ], $messages);

        if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $ab = User::where('email',Session::get('user_Email'))->first();
             User::where('email',Session::get('user_Email'))->update(['password' => Hash::make(Input::get('password'))]);

            if(!Session::has('reset')){
              
                $data = TempReg::where('user_Email',Session::get('user_Email'))->first();
                $data->status = 2;
                $data->save();

                if($ab->role != 99){
                   $details['name'] = $ab->f_Name . ' ' . $ab->l_Name;
                   if($ab->subscription_details->get_plan_name['plan_name'] == 'Affiliate'){
                      Mail::to($ab->email)->send(new welcomeAffiliate($details));
                   }else{
                      Mail::to($ab->email)->send(new welcomePremier($details));
                   }
                }else{
                  $details['name'] = $ab->f_Name . ' ' . $ab->l_Name;
                  Mail::to($ab->email)->send(new welcomeAcademy($details));
                }
                   

            }else{
               Session::forget('reset');
            }
 
            Session::forget('user_Email');
           \Cookie::queue(\Cookie::forget('thank_you_url'));
           \Cookie::queue(\Cookie::forget('webinarID'));
           \Cookie::queue(\Cookie::forget('ref_id'));

            Session::flash('flash', 'WELCOME, PLEASE LOGIN');
            return redirect('/login');
         }

      }else{

            return redirect('/login');
      }

    }

    public function forgetpswdmail(Request $request,$token){
      $token = explode('-',base64_decode($token));
      if(count($token) == 2){

        $email = $token[0];
        $user = User::select('id','email','forget_pswd_token')->where('email',$email)->first();
        if($user !== null){
                  if($token[1] == $user->forget_pswd_token){

                    $time = explode('-',base64_decode($token[1]));
                    
                      if((time() - $time[1])<86400){

                         $user->forget_pswd_token = null;
                         $user->save();
                         Session::put('user_Email',$user->email);
                         Session::put('reset',true);
                         return redirect('/password');

                      }else{
                        dd("LINK EXPIRED");
                      }

                    }else{
                      dd("PLEASE RETRY, Link can not work");
                    }
        }else{
          dd("wrong url, make sure the url is same as in mail");
        }
      }else{
        dd("wrong url, make sure the url is same as in mail");
      }

    }

    public function forgetpswd(Request $request){
        $validator = Validator::make($request->all(), [
                'email' => 'required|email',
        ]);

        if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $user = User::where('email',$request->email)->first();
            if($user == null){
              return redirect()->back()->withErrors(['Email does not exists']);
            }else{   

                    $token = base64_encode(rand(1000000,9999999).'-'.time());
                    $user->forget_pswd_token = $token;
                    $user->save();

                    $tok = base64_encode($request->email.'-'.$token);

                    $link = url("/forgetpswdmail/{$tok}");
                     $data = array(
                       'name'=>$user->f_Name . ' ' . $user->l_Name,
                       'link'=>  $link
                       );
                      Mail::send('cronMails.forget_pswd', $data, function($message) {
                         $message->to(Input::get('email'))->subject('Password Request');
                         $message->from('dreamearner@gmail.com','DREAM EARNERS');
                      });
                      Session::flash('message', "Please check your mail to change password");
                      return redirect()->back();
            }
        }
    }


    public function logout(Request $request){
        Auth::logout();
        if(Session::has('user_details')){
            $user = User::find(Session::get('user_details')[0]['user_id']);
            $user->last_login_at = date('Y-m-d H:i:s');
            if($user->login_count == null){
             $user->login_count = 1;
            }else{
             $user->login_count = $user->login_count+1;
            }
            $user->save();
            $request->session()->flush('user_details');
            return redirect('/login');
        }
            return redirect('/login');

    }


}
