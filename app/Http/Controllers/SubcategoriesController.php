<?php

namespace App\Http\Controllers;

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

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
        return Inertia::render('SubCategories/Index', [
            'subcategoriess' => Subcategories::with('categories')
            ->paginate(5)
            ->through(fn ($subcategories) => [
                'id' => $subcategories->id,
                'name' => $subcategories->name,
                'category' => $subcategories->categories->name,
           ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('SubCategories/Create',[
            'categories'=> Categories::orderBy('id','desc')->get()
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
            'photo' => ['required', 'image'],
        ]);
        $category = Subcategories::create([
            'name' => Request::get('name'),
            'categories_id' => Request::get('category'),
            'image_path' => Request::file('photo') ? Request::file('photo')->store('Subcategories') : null,
        ]); 
        return Redirect::route('subcategories')->with('success', 'Sub Category created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Subcategories::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategories $Subcategories)
    {
        return Inertia::render('SubCategories/Edit',[
            'categories'=> Categories::orderBy('id','desc')->get(),
            'subcategories' => [
                'id' => $Subcategories->id,
                'name' => $Subcategories->name,
                'categories_id' => $Subcategories->categories_id,
                'photo' => $Subcategories->image_path ? URL::route('image', ['path' => $Subcategories->image_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategories $Subcategories)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'category' => ['required'],
            'photo' => ['nullable', 'image'],
        ]);

        $Subcategories->update(Request::only('name'));
        $Subcategories->update(['categories_id' => Request::get('category')]);

        if (Request::file('photo')) {
            $Subcategories->update(['image_path' => Request::file('photo')->store('subcategories')]);
        }
        return Redirect::route('subcategories')->with('success', 'Category Updated Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategories $Subcategories)
    {
        $Subcategories->delete();
        return Redirect::route('categories')->with('success', 'Category Updated Successful.');
    }
}
