<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\confirmed;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct list page
    public function list(){
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')
        ->paginate(5);
        $order = Order::get();
        return view('admin.category.list',compact('categories','order'));
    }

    //direct category create page
    public function createPage(){
        $order = Order::get();
        return view('admin.category.create',compact('order'));
    }

    //creating items
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createdSuccess'=>'New Category added']);
    }

    //delete
    public function delete($id,Request $request){
        Category::where('id',$id)->delete();
        return back()->with(['deletedSuccess'=>'List deleted']);
    }

    //edit
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updatedSuccess'=>'List Updated']);
    }


    //category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=> 'required|min:4|unique:categories,name,'.$request->categoryId
        ])->validate();
    }
    //request category data
    private function requestCategoryData($request){
        return [
            'name'=> $request -> categoryName
        ];
    }

}

