<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategories;
use App\Models\Categories;
//use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' =>Product::with('subcategories.categories')
            ->paginate(5)
            ->through(fn ($product) => [
                         'id' => $product->id,
                         'name' => $product->name,
                         'detail' => $product->detail,
                         'sku' => $product->sku,
                         'price' => $product->price,
                         'subcategory' => $product->subcategories->name,
                         'category' => $product->subcategories->categories->name,
                    ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Product/Create', [
            'categories' =>Categories::All(),
            'subcategories' =>Subcategories::where('categories_id', request('category'))->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'category' => ['required'],
            'price' => ['required'],
            'sku' => ['required'],
            'subcategory' => ['required'],
            'detail' => ['required'],
            'photo' => ['required', 'image'],
        ]);
        $product = Product::create([
            'name' => Request::get('name'),
            'subcategories_id' => Request::get('subcategory'),
            'price' => Request::get('price'),
            'sku' => Request::get('sku'),
            'detail' => Request::get('detail'),
            'image_path' => Request::file('photo') ? Request::file('photo')->store('Product') : null,
        ]);
        return Redirect::route('product')->with('success', 'Product created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data=Product::find($product->id);
        $subcategoy=Subcategories::find($data->subcategories_id);
        if(request('category'))
            $subcategories=Subcategories::where('categories_id',request('category'))->get();
        else
            $subcategories=Subcategories::where('categories_id', $subcategoy->categories_id)->get();
        return Inertia::render('Product/Edit',[
            'categories'=> Categories::All(),
            'subcategories' =>$subcategories,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'detail' => $product->detail,
                'sku' => $product->sku,
                'price' => $product->price,
                'subcategory' => $data->subcategories_id,
                'category' => $subcategoy->categories_id,
                'photo' => $product->image_path ? URL::route('image', ['path' => $product->image_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'category' => ['required'],
            'price' => ['required'],
            'sku' => ['required'],
            'subcategory' => ['required'],
            'detail' => ['required'],
            'photo' => ['nullable', 'image'],
        ]);

        $product->update(Request::only('name', 'price', 'sku', 'detail'));
        $product->update(['subcategories_id' => Request::get('subcategory')]);

        if (Request::file('photo')) {
            $product->update(['image_path' => Request::file('photo')->store('product')]);
        }
        return Redirect::route('product')->with('success', 'Product Updated Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Redirect::route('product')->with('success', 'Product Deleted Successful.');
    }
}
