<?php

namespace App\Http\Controllers;

use App\Models\ProductBuy;
use App\Http\Controllers\Controller;
use App\Models\ProductBuyItem;
use Illuminate\Http\Request;

class ProductBuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productBuys = ProductBuy::all();
        // dd($productBuys);

        return response(['status' => 'success', 'productBuys' => $productBuys, 'code' => '200']);
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
        // dd($request->all());
        $data = [
            'uuid' => uniqid(),
            'sub_total' => $request->sub_total,
            'total' => $request->total,
        ];
        $productBuy = ProductBuy::create($data);
        foreach ($request['productItems'] as  $productItem) {
            ProductBuyItem::create([
                'uuid' => uniqid(),
                'product_buy_id' => $productBuy->id,
                'product_id' => $productItem['product_id'],
                'product_purchase_id' => $productItem['product_purchase_id'],
                'quantity' => $productItem['qty'],
                'price' => $productItem['price'],
                'total' => $productItem['total'],
            ]);
        }

        return response(['status' => 'success', 'productBuy' => $productBuy, 'code' => '200']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductBuy $productBuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = ProductBuy::find($id);
        $productItems = ProductBuyItem::where('product_buy_id', $id)->get();
        // dd($productItems);
        return response(['status' => 'success', 'product' => $product, 'productItems' => $productItems, 'code' => '200']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductBuy $productBuy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductBuy $productBuy)
    {
        //
    }
}
