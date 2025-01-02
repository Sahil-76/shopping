<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\Category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['categories'] = Category::with('brands', 'subcategory')->get();

        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['brands'] = brand::get();

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required',
        ],
            ['name' => 'Category name is required',
            ]);
        $enc = Crypt::encrypt($request->name);
        // dd($enc);
        $data = new Category;
        $data->name = $enc;
        $data->save();

        return redirect()->route('categories.index')->with('success', 'Role Added Successfuly!');
    }

    public function edit($id)
    {
        $data['category'] = Category::find($id);
        $data['brands'] = brand::get();

        return view('admin.category.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name' => 'Category name is required',
        ]);
        $data = Category::findorfail($id);
        $data->name = Crypt::encrypt($request->name);
        $data->save();

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfuly!');
    }



    public function subindex()
    {
        $categories = subcategory::with('categories')->get();

        return view('admin.category.subindex', compact('categories'));
    }

    public function subcreate()
    {
        $categories = Category::get();

        return view('admin.category.subcategory', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function substore(Request $request, subcategory $subcategroy)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
        $name = Crypt::encrypt($request->name);
        $id = Crypt::decrypt($request->category_id);
        $data = new Subcategory;
        $data->name = $name;
        $data->category_id = $id;
        $data->save();

        return redirect()->route('sub.category.index')->with('success', 'Subcategory Added Successfuly!');
    }

    public function get_subcategories($id)
    {
        $subcategories = Subcategory::where('category_id', $id)->get(['id', 'name']);

        // Decrypt the names before sending the response
        $subcategories = $subcategories->map(function ($subcategory) {
            $subcategory->name = ucfirst(Crypt::decrypt($subcategory->name));

            return $subcategory;
        });

        return response()->json($subcategories);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Category::with('brands')->findOrFail($id);
        $data->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfuly!');
    }

}
