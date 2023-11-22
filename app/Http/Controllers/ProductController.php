<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //list page
    public function list(){

        $products = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(5);
        $order = Order::get();
        return view('admin.product.product-list',compact('products','order'))->with(['createdSuccess'=>'Created']);
    }
    //create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        $order = Order::get();
        return view('admin.product.createproduct',compact('categories','order'));
    }


    //create
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        if($request->hasFile('image')){
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return redirect()->route('product#list')->with(['created'=> 'Product Created']);
    }
    //delete
    public function delete($id,Request $request){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Deleted']);
    }

    //detail or read
    public function details(Request $request){
        $details = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$request->id)->first();
        $order = Order::get();
        return view('admin.product.product-detail',compact('details','order'));
    }

    //update page
    public function updatePage($id){
        $details = Product::where('id',$id)->first();
        $category = Category::get();
        $order = Order::get();
        return view('admin.product.update-page',compact('details','category','order'));
    }

    //update
    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        $data = $this->requestProductInfo($request);

        $oldImageName = Product::where('id',$request->id)->first();
        $oldImage = $oldImageName -> image;

       if($request->hasFile('image')){
        if($oldImage != null){
            Storage::delete('public/'. $oldImage);
        }

        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] = $fileName;
       }

        Product::where('id',$request->id)->update($data);
        return redirect()->route('product#list')->with(['updated'=>'Product Updated']);
    }

    private function requestProductInfo($request){
        return [
            'category_id'=>$request->category,
            'name'=> $request->name,
            'description'=>$request->description,
            'waiting_time'=>$request->waitingTime,
            'price'=>$request->price
        ];
    }

    //validator product

    private function productValidationCheck($request,$action){
       $validation = [
            'name'=>'required|min:5|unique:products,name,'.$request->id,
            'category'=>'required',
            'description'=>'required|min:10',
            'price'=>'required',
            'waitingTime'=>'required'
       ];
       $validation['image'] = $action == 'create' ? 'required|mimes:jpg,jpeg,png,webp|file' :'mimes:jpg,ipeg,png,webp|file';

       Validator::make($request->all(), $validation)->validate();
    }
}
