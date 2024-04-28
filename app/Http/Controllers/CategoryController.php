<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function category_page(){
        return view('pages.dashboard.category-page');
    }

    function list_category(Request $request){
        $user_id=$request->header('user_id');
        return Category::where('user_id',$user_id)->get();
    }

    function category_create(Request $request){
        $user_id=$request->header('user_id');
        $name=$request->input('name');
        return Category::create([
            'name'=>$name,
            'user_id'=>$user_id
        ]);
    }

    function category_delete(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('user_id');
        return Category::where('id',$category_id)->where('user_id',$user_id)->delete();
    }


    function category_by_id(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('user_id');
        return Category::where('id',$category_id)->where('user_id',$user_id)->first();
    }



    function category_update(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('user_id');
        return Category::where('id',$category_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
        ]);
    }



}
