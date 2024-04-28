<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function customer_page(){
        return view('pages.dashboard.customer-page');
    }

    function customer_create(Request $request){
        $user_id=$request->header('user_id');
        return Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'user_id'=>$user_id
        ]);
    }


    function list_customer(Request $request){
        $user_id=$request->header('user_id');
        return Customer::where('user_id',$user_id)->get();
    }


    function customer_delete(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('user_id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->delete();
    }


    function customer_by_id(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('user_id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->first();
    }


     function Customer_update(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('user_id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
        ]);
    }

}
