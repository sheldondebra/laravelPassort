<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){
        $user_id=$request->user()->id;
        $products=Product::where('user_id',$user_id)->get();
        return response([
            'products'=>$products
        ],201);
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|max:255',
            'price'=>'required'
        ]);

        Product::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'user_id'=>$request->user()->id
        ]);
       return response(
              [
                'message'=>'Product Created Successfully'
              ],201
         );
    }

    public function show($id){
        $product=Product::findOrFail($id);
        return response([
            'product'=>$product
        ],201);
    }

    public function update(Request $request,$id){
        $product=Product::findOrFail($id);
        $product->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'user_id'=>$request->user()->id
        ]);
        return response([
            'message'=>'Product Updated Successfully'
        ],201);
    }



    //delete product
    public function destroy($id){
        $product=Product::findOrFail($id);
        $product->delete();
        return response([
            'message'=>'Product Deleted Successfully'
        ],201);
    }
}
