<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        $subcategory = Subcategory::latest()->get();
        $category = Category::latest()->get();
        $product = Product::latest()->get();
        return view('pages.admin.product', compact('subcategory', 'category', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);
        
        try {
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(724,480)->save('uploads/product/'.$name_gen);
            $save_url = 'uploads/product/'.$name_gen;

            $product = new Product();
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = $save_url;
            $product->save();

            $notification=array(
                'message'=>'Product Created Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {   

            $notification=array(
                'message'=>'Something went wrong',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubCate($subcat_id)
    {
        $subcate = Subcategory::where('category_id', $subcat_id)->orderBy('name' , 'ASC')->get();
        return json_encode($subcate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productData = Product::find($id);
        $subcategory = Subcategory::latest()->get();
        $category = Category::latest()->get();
        $product = Product::latest()->get();
        return view('pages.admin.product', compact('productData', 'subcategory', 'category', 'product'));
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
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif',
        ]);
        
        $old_img = $request->old_image;
        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(724,480)->save('uploads/product/'.$name_gen);
            $save_url = 'uploads/product/'.$name_gen;

            $product = Product::find($id);
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = $save_url;
            $product->save();
        } else {
            $product = Product::find($id);
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->save();
        }
        
        $notification=array(
            'message'=>'Product Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.products')->with($notification);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            unlink($product->image);
            $product->delete();
        }

        $notification=array(
            'message'=>'Product Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
