<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Expectation;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category' ,'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // Request Marge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data= $request->except('image');
        $data['image']= $this->uploadImage($request);     
        // Mass assigament
        $categories= Category::create($data);

        // PRG
        return Redirect::route('dashboard.categories.index')
                ->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $category = Category::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('dashboard.categories.index')
                    ->with('info', 'Record not found!');
        }

        $parents  = Category::where('id', '<>', $id)
        ->where(function($query) use ($id) {
            $query->whereNull('parent_id')
                  ->orWhere('parent_id', '<>', $id);
                })
        ->get();
        
        return view('dashboard.categories.edit', compact('category', 'parents'));
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
        $categories= Category::findOrFail($id);

        $old_image= $categories->image;
        $data= $request->except('image');

        $data['image']= $this->uploadImage($request);

        if($old_image && ($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }

        $categories->update($data);
        return Redirect::route('dashboard.categories.index')->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= Category::findOrFail($id);
        $category->delete();

        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        // Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Deleted!');
    }

    protected function uploadImage(Request $request) {
        if(!$request->hasFile('image')){
            return;
        }
        
        $file= $request->file('image'); //uploadedfile object
        $path= $file->store('uploads', [
            'disk' => 'public'
        ]);
        
        return $path;
    }
}
