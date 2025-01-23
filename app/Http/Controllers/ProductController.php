<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductPurchase;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $productBateches = ProductPurchase::all();


        return response(['status' => 'success', 'products' => $products, 'productBateches' => $productBateches, 'code' => '200']);
    }


    public function producBatche($id)
    {
        $productBateches = ProductPurchase::where('id', $id)->get();
        // dd($productBateches);

        return response(['status' => 'success', 'productBateches' => $productBateches, 'code' => '200']);
    }

    public function productDetails($batchId)
    {

        $product = ProductPurchase::where('id', $batchId)->first();

        return response(['status' => 'success', 'product' => $product, 'code' => '200']);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
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
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
