<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Product::with('category');

    if ($request->input('status')) {
        $status = Crypt::decrypt($request->input('status'));
        
        if ($status == 'active') {
            $query->where('products_status', 'active');
        } elseif ($status == 'inactive') {
            $query->where('products_status', 'inactive');
        }
    }

    $data['products'] = $query->get(); 
    
    return view('admin.products.index', $data);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get();
        // dd($categories);
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data['encryptedata']=Crypt::encrypt($request->all());
        // $data['decrypted']=Crypt::decrypt($data['encryptedata']);
        $request->validate([
            'product_id'=>'required|unique:products,product_id',
            'link'=>'required',
            'name'=>'required',
            'description'=>'required',
            'image'=>'required',
            'status'=>'required',
            'category_id'=>'required',

        ],[
            'product_id.required'=>'Product id is required',
            'product_id.unique'=>'Product id is already exist',
            'link.required'=>'Link is required',
            'name.required'=>'Name is required',
            'description.required'=>'Description is required',
            'image.required'=>'Image is required',
            'status.required'=>'Status is required',
            'category_id.required'=>'Category is required',
            ]);
            $url=Crypt::encrypt($request->link);
            $img=Crypt::encrypt($request->image);
            $data= new Product();
            $data->product_id=$request->product_id;
            $data->link=$url;
            $data->name=$request->name;
            $data->description=$request->description;
            $data->image=$img;
            $data->products_status=$request->status;
            $data->category_id=$request->category_id;
            $data->save();
            return redirect()->route('products.index')->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id=Crypt::decrypt($id);
        $data=Product::with('category')->findOrFail($id);
        $categories=Category::get();
        return view('admin.products.edit',compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Crypt::decrypt($id);

        $request->validate([
            'link' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
            'category_id' => 'required',
        ], [
            'link.required' => 'Link is required',
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'status.required' => 'Status is required',
            'category_id.required' => 'Category is required',
        ]);

        $data = Product::findOrFail($id);

        try {
            $data->link = Crypt::encrypt($request->link);

            if (!empty($request->image)) {
                $data->image = Crypt::encrypt($request->image);
            }

            $data->product_id = $request->product_id;
            $data->name = $request->name;
            $data->description = $request->description;
            $data->products_status = $request->status;
            $data->category_id = $request->category_id;

            $data->save();

            return redirect()->back()->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Error updating product');
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
