<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Add(Request $request)
    {
        $request->validate([
            'prodname' => 'required|string',
            'prodprice' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'img' => 'nullable|file',
        ]);

        $user = new Product;
        $user->prodname = $request->input('prodname');
        $user->prodprice = $request->input('prodprice');
        $user->description = $request->input('description');
        $user->category = $request->input('category');

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->img = 'images/' . $imageName;
        }

        $user->save();

        return response()->json(['message' => 'Product created successfully'], 201);
    }

    public function fetch()
    {
        $fetch = Product::all();
        return response()->json($fetch);
    }

    public function view($id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product
            ],200 );
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product found'
            ],404 );
        }

    }

    public function edit($id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product
            ],200 );
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product found'
            ],404 );
        }

    }

    public function delete($id)
    {
     Product::find($id)->delete();
    }



}
