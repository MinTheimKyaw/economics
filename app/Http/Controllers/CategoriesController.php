<?php

namespace App\Http\Controllers;

use App\Models\Categories;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Categories/Index', [
            'categories' => Categories::orderBy('id','desc')
            ->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
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
            'photo' => ['required', 'image'],
        ]);
        $category = Categories::create([
            'name' => Request::get('name'),
            'image_path' => Request::file('photo') ? Request::file('photo')->store('categories') : null,
        ]);
        return Redirect::route('categories')->with('success', 'Category created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
       
        
        return Inertia::render('Categories/Edit', [
            'categories' => [
                'id' => $categories->id,
                'name' => $categories->name,
                'photo' => $categories->image_path ? URL::route('image', ['path' => $categories->image_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null                
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'photo' => ['nullable', 'image'],
        ]);

        $categories->update(Request::only('name'));

        if (Request::file('photo')) {
            $categories->update(['image_path' => Request::file('photo')->store('categories')]);
        }
        return Redirect::route('categories')->with('success', 'Category Updated Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {
        $categories->delete();

        return Redirect::route('categories')->with('success', 'Category Deleted Successful.');
    }
}
