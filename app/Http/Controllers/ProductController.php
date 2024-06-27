<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Product;
use App\Models\ProductQuantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand', 'unit', 'tax','productQties.warehouse','attachments'])->latest()->get();
           return response()->json([
              'success' => true,
              'message' => 'Products List',
              'data'    => $products
          ]);

        return $products;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validate = Validator::make($request->all(), [
        'name' => 'required',
        'sku' => 'required',
        'symbology' => 'required',
        'brand_id' => 'required',
        'category_id' => 'required',
        'unit_id' => 'required',
        'price' => 'required',
        'qty' => 'required',
        'alert_qty' => 'required',
        'tax_method' => 'required',
        'tax_id' => 'required',
        'has_stock' => 'required',
        'has_expired_date' => 'required',
        'details' => 'required'
    ]);

    if ($validate->fails()) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Validation Error!',
            'data' => $validate->errors(),
        ], 403);
    }

    $product = new Product();
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->symbology = $request->symbology;
    $product->brand_id = $request->brand_id;
    $product->category_id = $request->category_id;
    $product->unit_id = $request->unit_id;
    $product->price = $request->price;
    $product->qty = $request->qty;
    $product->alert_qty = $request->alert_qty;
    $product->tax_method = $request->tax_method;
    $product->tax_id = $request->tax_id;
    $product->has_stock = $request->has_stock;
    $product->has_expired_date = $request->has_expired_date;
    $product->details = $request->details;
    $product->save();

    if (isset($request->product_qties)) {
        foreach ($request->product_qties as $value) {
            $productQty = new ProductQuantity();
            $productQty->product_id = $product->id;
            $productQty->warehouse_id = $value['warehouse_id'];
            $productQty->qty = $value['qty'];
            $productQty->save();
        }
    }

    if (isset($request->attachments)) {
        foreach ($request->attachments as $value) {
            $attachment = new Attachment();
            $attachment->url = $value['url'] ?? 'null';
            $attachment->state = $value['state'] ?? 'null';
            $attachment->lable = $value['lable'] ?? 'null';
            $attachment->file = $value['file'] ?? 'null';
            $attachment->content_type = $value['content_type'] ?? 'null';
            $attachment->user = $value['user'] ?? 'null';
            $product->attachments()->save($attachment);
        }
    }

    $response = [
        'status' => 'success',
        'message' => 'Product stored successfully.',
    ];

    return response()->json($response, 201);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products = Product::findOrFail($id);
            if (is_null($products)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product Details',
                    'data'    => null
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Product',
                'data'    => $products
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validate = Validator::make($request->all(), [
        'name' => 'required',
        'sku' => 'required',
        'symbology' => 'required',
        'brand_id' => 'required',
        'category_id' => 'required',
        'unit_id' => 'required',
        'price' => 'required',
        'qty' => 'required',
        'alert_qty' => 'required',
        'tax_method' => 'required',
        'tax_id' => 'required',
        'has_stock' => 'required',
        'has_expired_date' => 'required',
        'details' => 'required'
    ]);

    if ($validate->fails()) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Validation Error!',
            'data' => $validate->errors(),
        ], 403);
    }

    $product = Product::findOrFail($id);
    $product->update([
        'name' => $request->name,
        'sku' => $request->sku,
        'symbology' => $request->symbology,
        'brand_id' => $request->brand_id,
        'category_id' => $request->category_id,
        'unit_id' => $request->unit_id,
        'price' => $request->price,
        'qty' => $request->qty,
        'alert_qty' => $request->alert_qty,
        'tax_method' => $request->tax_method,
        'tax_id' => $request->tax_id,
        'has_stock' => $request->has_stock,
        'has_expired_date' => $request->has_expired_date,
        'details' => $request->details
    ]);

    ProductQuantity::where('product_id', $id)->delete();

    if (isset($request->product_qties)) {
        foreach ($request->product_qties as $value) {
            $productQty = new ProductQuantity();
            $productQty->product_id = $id;
            $productQty->warehouse_id = $value['warehouse_id'];
            $productQty->qty = $value['qty'];
            $productQty->save();
        }
    }

    Attachment::where('attachmentable_id', $id)->delete();

    if (isset($request->attachments)) {
        foreach ($request->attachments as $value) {
            $attachment = new Attachment();
            $attachment->url = $value['url'] ?? 'null';
            $attachment->state = $value['state'] ?? 'null';
            $attachment->lable = $value['lable'] ?? 'null';
            $attachment->file = $value['file'] ?? 'null';
            $attachment->content_type = $value['content_type'] ?? 'null';
            $attachment->user = $value['user'] ?? 'null';
            $product->attachments()->save($attachment);
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Product updated successfully',
        'data' => $product
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        $qty=  ProductQuantity::where('product_id',$id)->get();
        if ($qty){
            ProductQuantity::where('product_id',$id)->delete();
        }

        return response("Product deleted successfully");


    }
}
