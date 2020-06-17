<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
            $products = Product::all();
            return ProductResource::collection($products);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Product|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        if ($request->title == ''| $request->title == ''| $request->price == '' && $request->price == '' ) {
            
            return response()->json([
                'message' => 'Thêm trường dữ liệu bị thiếu'
            ], 400);
        } else{
            $product = Product::create($request->all());
            return new ProductResource($product);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return bool
     */
    public function update(Request $request, Product $product)
    {   
        if ($request->title == ''| $request->title == ''| $request->price == '' && $request->price == '' ) {
            
            return response()->json([
                'message' => 'Trường dữ liệu bị thiếu'
            ], 401);
        } else{
            $product->update($request->all());
            return response()->json([
                'message' => 'Cập nhật thành công'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Xóa thành công'
        ], 200);
    }
}