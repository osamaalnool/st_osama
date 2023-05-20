<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ProductsTrait;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ProductsTrait;
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $products = Product::paginate(10);
        $categories = Category::all();
        return view('admin.product.index', compact('products', 'categories'));
    }

    public function product_sail()
    {
        $products = Product::select('products.*', DB::raw('COUNT(orders.id) as order_count'))
        ->join('orders', 'orders.product_id', '=', 'products.id')
        ->where('orders.payment_status', 'completed')
         ->orderBy('order_count', 'desc')
        ->paginate(10);

        $categories = Category::all();

        return view('admin.product.sail', compact('products', 'categories'));
    }

    

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:50',
        ]);

        $file_name = $this->saveImage($request->product_img, 'images/products');
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->category_id = $request->category;
        $product->product_price = $request->product_price;
        $product->product_details = $request->product_details;
        $product->product_count = $request->product_count;
        $product->product_img = $file_name;
        $product->created_at = now();
        $product->updated_at = now();
        $product->save();
        return redirect()->back()->with('status', 'تمت اضافة المنتج بنجاح');
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
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
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
        $validated = $request->validate([
            'product_name' => 'required|max:50',
        ]);
        $img=$request->product_img;
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->category_id = $request->category;
        $product->product_price = $request->product_price;
        $product->product_details = $request->product_details;
        $product->product_count = $request->product_count;
        if($img==null) {
            $product->product_img= $product->product_img;
        }else{
            $file_name = $this->saveImage($img, 'images/products');
            $product->product_img = $file_name;
        }
        $product->created_at = now();
        $product->updated_at = now();
        $product->save();
        return redirect()->back()->with('status', 'تمت تعديل الخدمة بنجاح');
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
        $product->delete();
        return redirect()->back()->with('status', 'تم حذف المنتج بنجاح ');
    }
}
