<?php

namespace App\Http\Controllers;


use App\Mail\OTPMail;
use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    function user_login(){
        return view('pages.auth.login-page');
    }

    function user_registration(){
        return view('pages.auth.registration-page');
    }
    function send_otp_page(){
        return view('pages.auth.send-otp-page');
    }
    function verify_otp_page(){
        return view('pages.auth.verify-otp-page');
    }

    function reset_password_page(){
        return view('pages.auth.reset-pass-page');
    }

    function ProfilePage(){
        return view('pages.dashboard.profile-page');
    }



    function user_registration_core(Request $request){
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        $firstName=$request->firstName;
        $lastName=$request->lastName;
        $email=$request->email;
        $mobile=$request->mobile;
        $password=$request->password;
        $encrp_password=md5(sha1($email.$password));

        try {
            User::create([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'mobile' => $mobile,
                'password' =>$encrp_password,
            ]);

            return redirect('/user_login')->with('success','User Registration Successfully ! Please Login');

        } catch (Exception $e) {

                return back()->with('error', 'User Registration Failed');


        }
    }

    function user_login_core(Request $request){
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $email=$request->email;
        $password=$request->password;

        $encrp_password=md5(sha1($email.$password));

       $count=User::where('email','=',$email)
            ->where('password','=',$encrp_password)
            ->select('id')->first();

       if($count!==null){
           // User Login-> JWT Token Issue
          $token=JWTToken::generateToken($email,$count->id);

        return redirect('dashboard')->with('success',' Welcome To Dashboard !User  Successfully  Login')->cookie('token',$token,time()+60*24*30);
       }
       else{

        return back()->with('error','User Login Error Please ! Login Right Info');

       }

    }

    function send_otp(Request $request){
        $validated = $request->validate([
            'email' => 'required'
        ]);

        $email=$request->email;
        $otp=rand(100000,999999);
        $count=User::where('email',$email)->count();

        if($count==1){
            // OTP Email Address
           Mail::to($email)->send(new OTPMail($otp));
            // OTO Code Table Update
            User::where('email',$email)->update(['otp'=>$otp]);
            return redirect('/verify_otp_page')->with('success','6 Digit OTP Code has been send to your email !')->with('email',$email);


        }
        else{
            return back()->with('error','Please Enter Right Email !');

        }
    }

    function verify_otp_core(Request $request){

        $validated = $request->validate([
            'otp' => 'required'
        ]);
        $email=$request->header('email');
        $otp=$request->otp;
        $count=User::where('email',$email)
            ->where('otp',$otp)->count();

        if($count==1){
            // Database OTP Update
            User::where('email',$email)->update(['otp'=>'0']);

            // Pass Reset Token Issue
            $token=JWTToken::createTokenForSetPassword($email);
            return redirect('/reset_password_page')->with('success','OTP Verification Successful')->cookie('token',$token,60*24*30)->with('email',$email);
        }
        else{
            return back()->with('error','OTP Not Mach');
        }
    }

    function reset_password_core(Request $request){
        $validated = $request->validate([
            'password' => 'required',
            'cpassword' => 'required_with:password|same:password'
        ]);

            $email=$request->email;
            $password=$request->password;
            $encrp_password=md5(sha1($email.$password));

               User::where('email',$email)->update(['password'=>$encrp_password]);

                return redirect('/user_login')->with('success','Reset Password Success');

    }

    function logout(){
        return redirect('/user_login')->cookie('token','',-1);
    }


    function UserProfile(Request $request){
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ],200);
    }

    function UpdateProfile(Request $request){
        try{
            $email=$request->header('email');
            $firstName=$request->input('firstName');
            $lastName=$request->input('lastName');
            $mobile=$request->input('mobile');
            $password=$request->input('password');
            User::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'mobile'=>$mobile,
                'password'=>$password
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ],200);

        }catch (Exception $exception){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Wrong',
            ],200);
        }
    }

}
