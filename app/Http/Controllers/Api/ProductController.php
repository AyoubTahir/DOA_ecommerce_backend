<?php

namespace App\Http\Controllers\Api;

use App\Services\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryResourse;
use App\Models\Variation;
use App\Repositories\Product\IProductRepository;

class ProductController extends Controller
{
    public function __construct(private IProductRepository $product)
    {
        $this->middleware('auth:sanctum'/*, ['except' => ['index']]*/);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only(['title', 'description','category_id',  'selling_price', 'purchase_price', 'total_stock', 'status']);

        try
        {
            DB::beginTransaction();

            $product = $this->product->create($data);

            if ($request->hasFile('images'))
            {
                foreach($request->file('images') as $image)
                {
                    $imagePath =  Upload::save($image, 'images');

                    $this->product->addImages($product, $imagePath);
                }
            }
            
            $this->product->addVariations($product, $request->variations);

            DB::commit();

            return response()->json([
                'message' => 'Product Created Successfully'
            ], 201);
        }
        catch (\Exception $ex)
        {
            DB::rollback();
            return response()->json([
                'message' => $ex->getMessage()
            ], 400);
        }
    }
}
