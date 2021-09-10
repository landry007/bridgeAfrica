<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $products = Product::withTrashed()->with('category')->latest()->paginate();
    //    dd(  $products  );
        return view('products.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            "name" => "required",
            "nature" => "required",
            "price" => "required",
            "quantity" => "required",
            "category" => "required",
        ]);

        // return $request->all();
        $imageName = Carbon::now()->format('Y-M-D-m') . '-' . Str::slug($request->input('name')) . '.'
            . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $image_url = url('public/images/' . $imageName);
        $productData = array_merge($request->only([ "name", "nature", "price", "quantity","description" ]),
            ["image_url" => $image_url,"category_id" => $request->input('category'), "user_id"=>Auth::id() ]) ;

       $product =  Product::create($productData);
        return redirect(route('product.index'))
            ->with('success', 'You have successfully create your product.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id )
    {
        $product = Product::withTrashed()->with('category')-> where('id', $id)->first();
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('category')-> where('id', $id)->first();
        $categories = Category::all();

        return view('products.update', compact('product', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $validity = !empty( $request->input('validity'))? $request->input('validity') :$product->validity ;
        $product->update([
            "name" => $request->input('name'),
            "nature"=> $request->input('nature', $product->nature ),
            "price" => $request->input('price') ,
            "quantity" => $request->input('quantity') ,
            "validity" => $validity ,
            "category_id" => $request->input('category', $product->validity )
        ]);

        return redirect(route('product.index'))
            ->with('success', ' Product have been successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->delete();

        return redirect(route('product.index'))
            ->with('success', ' Product have been successfully deleted.');
    }
    public function restore($id)
    {
        Product::where('id', $id)->restore();

        return redirect(route('product.index'))
            ->with('success', ' Product have been successfully restored.');
    }
}
