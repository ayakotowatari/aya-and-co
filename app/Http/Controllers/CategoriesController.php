<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;
use Storage;
use Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNotNull('name')
                        ->where('status_id', '=', 1)
                        ->get();

        // $products = Product::get();
        
        return response() -> json(['categories' => $categories]);
    }

    public function fetchCategories()
    {
        $categories = Category::with('status')
                        ->whereNotNull('name')
                        ->get();

        return response() -> json(['categories' => $categories]);
    }

    public function fetchEachCategory($id)
    {
        // $category = Category::with('status')->find($id);

        $category = Category::join('statuses', 'statuses.id', '=', 'categories.status_id')
                        ->where('categories.id', $id)
                        ->select(
                            'categories.id', 
                            'categories.name',
                            'categories.subtitle',
                            'categories.details', 
                            'categories.description', 
                            'categories.season',
                            'categories.ingredients',
                            'categories.image',
                            'statuses.status'
                        )                
                        ->first($id);

        return response() -> json(['category' => $category]);
    }

    public function editSubtitle(Request $request)
    {
        $request ->validate([
            'id' => 'required',
            'subtitle' => 'required',
        ]);

        $id = request('id');
        
        $category = Category::find($id);

        $category -> subtitle = request('subtitle');
        $category->update();

        $updatedSubtitle = $category -> subtitle;

        return response() -> json(['subtitle' => $updatedSubtitle]);

    }

    public function editDetails(Request $request)
    {
        $request ->validate([
            'id' => 'required',
            'details' => 'required',
        ]);

        $id = request('id');
        
        $category = Category::find($id);

        $category -> details = request('details');
        $category->update();

        $updatedDetails = $category -> details;

        return response() -> json(['details' => $updatedDetails]);

    }

    public function editDescription(Request $request)
    {
        $request ->validate([
            'id' => 'required',
            'description' => 'required',
        ]);

        $id = request('id');
        
        $category = Category::find($id);

        $category -> description = request('description');
        $category->update();

        $updatedDescription = $category -> description;

        return response() -> json(['description' => $updatedDescription]);

    }

    public function editSeason(Request $request)
    {
        $request ->validate([
            'id' => 'required',
            'season' => 'required',
        ]);

        $id = request('id');
        
        $category = Category::find($id);

        $category -> season = request('season');
        $category->update();

        $updatedSeason = $category -> season;

        return response() -> json(['season' => $updatedSeason]);

    }

    public function editIngredients(Request $request)
    {
        $request ->validate([
            'id' => 'required',
            'ingredients' => 'required',
        ]);

        $id = request('id');
        
        $category = Category::find($id);

        $category -> ingredients = request('ingredients');
        $category->update();

        $updatedIngredients = $category -> ingredients;

        return response() -> json(['ingredients' => $updatedIngredients]);

    }

    public function editImage(Request $request)
    {    
        $request->validate([
            'id' => 'required',
            'image' => 'required'
        ]);
    
        $image = $request->file('image');
        // $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
        $disk = Storage::disk('s3');
    
        $path = $disk->putFile('category', $image, 'public');
        // $path = $disk->putFile('category', $image);
        // $filename = ltrim($path, 'public/');
    
        $category->image = $path;

        $category->save();

        return response() -> json(['category' => $category]);

    }



   



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request ->validate([
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = request('name');
        $category->subtitle = request('subtitle');
        $category->details = request('details');
        $category->description = request('description');
        $category->season = request('season');
        $category->ingredients = request('ingredients');
        $category->status_id = request('status_id');

        $image = $request->file('image');
        // $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる

        if(!$image){
            $category->image = null;
        }else{
            $disk = Storage::disk('s3');

            $path = $disk->putFile('category', $image, 'public');
            // $filename = ltrim($path, 'public/');

            $category->image = $path;
        }

        $category -> save();

        // $newCategory = $category->status()->first();

        // return response() -> json(['category' => $newCategory]);
        
    }
    
    public function fetchCategoryStatuses()
    {

        $statuses = Status::whereIn('id', [1, 16, 17])
                        ->get();

        // DD($statuses);

        return response() -> json(['statuses' => $statuses]);
    }

    public function updateCategoryStatus(Request $request)
    {
        
        $request ->validate([
            'id' => 'required',
            'status_id' => 'required',
        ]);

        $id = request('id');

        $category = Category::find($id);
        $category -> status_id = request('status_id');

        $category -> update();

        $updatedStatus = $category->status()->first()->status;

        return response() -> json(['status' => $updatedStatus]);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function show(Category $category)
    // {
    //     //
    //     $category->load('products');

    //     return $category;
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
