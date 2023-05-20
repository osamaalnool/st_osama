<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ProductsTrait;
class CategoryController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    use ProductsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|max:50|min:5',
        ]);

        $file_name = $this->saveImage($request->category_img, 'images/categories');
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_img = $file_name;
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();
        return redirect()->back()->with('status', 'تمت اضافة التصنيف بنجاح');
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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|max:50|min:5',
        ]);
        $img= $request->category_img;
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        if ($img==null) {
            $category->category_img=$category->category_img;
        }else{
            $file_name = $this->saveImage($img, 'images/categories');
            $category->category_img = $file_name;
        }
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();
        return redirect()->back()->with('status', 'تمت تعديل التصنيف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('status', 'تم حذف التصنيف بنجاح ');
    }
}
