<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products_read')->only(['index','show']);
        $this->middleware('permission:products_create')->only(['create','store']);
        $this->middleware('permission:products_update')->only(['edit','update']);
        $this->middleware('permission:products_delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductRequest $request)
    {
        $products = Product::when($request->search,function ($q) use ($request) {
            return $q->whereTranslationLike('name','%'.$request->search.'%')
                ->orWhereTranslationLike('description', '%'.$request->search.'%');
        })->when($request->category,function ($q) use ($request) {
            return $q->whereCategoryId($request->category);
        })->get();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.form.index',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $image_name = 'no-img.png';
        if ($request->has('image')){
            $image_name = $request->image->hashName();
            ImageManagerStatic::make($request->image)
                ->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('uploads/product_images/'.$image_name));
        }
        $data = $this->fillTranslation($request);
        $data['image'] = $image_name;

        Product::create($data);
        Session::flash('success',__('message.add'));
        return redirect()->route('dashboard.product.index');
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
        $categories = Category::all();
        return view('dashboard.products.form.index',compact(['product','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        if ($request->has('image')){

            if ($product->image !== 'no-img.png')
                Storage::disk('public_uploads')->delete('product_images/'.$product->image);

            $image_name = $request->image->hashName();
            ImageManagerStatic::make($request->image)
                ->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('uploads/product_images/'.$image_name));
        }else{
            $image_name = $product->image;
        }

        $data = $this->fillTranslation($request);
        $data['image'] = $image_name;

        $product->update($data);
        Session::flash('success',__('message.edit'));
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image !== 'no-img.png')
            Storage::disk('public_uploads')->delete('product_images/'.$product->image);
        $product->delete();
        Session::flash('success',__('message.delete'));
        return redirect()->route('dashboard.product.index');
    }

    public function fillTranslation($request)
    {

        $data = [];
        foreach (config('translatable.locales') as $locale){
            $data[$locale]['name'] = $request->$locale['name'];
            $data[$locale]['description'] = $request->$locale['description'];
        }
        $data['category_id'] = $request->category_id;
        $data['purchase_price'] = $request->purchase_price;
        $data['sale_price'] = $request->sale_price;
        $data['stock'] = $request->stock;
        return $data;
    }
}
