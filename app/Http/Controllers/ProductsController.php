<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        // DD($products);

        return response() -> json(['products'=>$products]);
    }

    public function show($id)
    {
        //inventory変更前の設定
        // $products = Product::join('product_inventories', 'products.id', '=', 'product_inventories.product_id')
        //                 ->where('category_id', $id)
        //                 ->where('product_inventories.inventory', '>', 0)
        //                 ->get();

        $products = Product::where('category_id', $id)
                            ->where('inventory', '>', 0)
                            ->where('status_id', 1)
                            ->get();

        if($products->isEmpty()){
            return response() -> json(['product' => [], 'item' => "", 'quantity'=> ""]);
        }else{
            $product = $products[0];
            // $inventory = $product->inventory()->first();
            // $inventoryQuantity = $inventory->inventory;
            $inventoryQuantity = $product->inventory;

            return response() -> json(['product' => $products, 'item' => $product, 'inventory'=> $inventoryQuantity]);
        }

        // dd($products[0]);

        // foreach($products as $product){
        //     $inventory = $product->inventory()->first();
        //     $quantity = $inventory->quantity;
        // }

        // DD($product);
        
        // return response() -> json(['product' => $products, 'item' => $product, 'quantity'=> $quantity]);

        //  return view ('test', ['product'=>$product]);
    }

    public function inventory($id)
    {
        $product = Product::find($id);

        // DD($id);

        // $inventory = $product->inventory()->first();

        // $inventoryQuantity = $inventory->inventory;
        $inventoryQuantity = $product->inventory;

        return response() -> json(['inventory' => $inventoryQuantity]);

    }

    // public function addToCart(Request $request, $id){

    //     $product = Product::find($id);

    //     $quantity = request('quantity');

    //     if(!$product){
    //         abord(404);
    //     }

    //     $cart = session()->get('cart');

    //     //if cart is empty then this the first product
    //     if(!$cart) {
    //         $cart = [
    //             $id => [
    //                 "name" = $product->name,
    //                 "quantity" = $quantity,
    //                 "price" => $product->price,
    //             ]
    //         ];

    //         session()->put('cart', $cart);
    //     }

    //     return response() -> json(['products'=>$products]);

    // }

    public function fetchProducts()
    {
        // $products = Product::with('inventory')->get();

        // DD($products);

        $products = Product::with('status')->get();
        // DD($products);

        return response() -> json(['products' => $products]);
    }

    public function fetchProduct($id)
    {
        // $product = Product::with('inventory')
        //                 ->where('products.id', $id)
        //                 // ->select(
        //                 //     'products.id',
        //                 //     'products.name',
        //                 //     'products.slug',
        //                 //     'products.size',
        //                 //     'products.price',
        //                 //     'product_inventories.inventory'
        //                 // )
        //                 ->first();

        $product = Product::join('statuses', 'statuses.id', '=', 'products.status_id')
                        ->where('products.id', $id)
                        ->select(
                            'products.id',
                            'products.name',
                            'products.slug',
                            'products.size',
                            'products.price',
                            'products.inventory',
                            'products.image',
                            'statuses.status',
                        )
                        ->first();

        //$total = $product->orders('quantity')->count();
        $total = $product->orders('quantity')->sum('quantity');

        // DD($total);

        return response() -> json(['product' => $product, 'total' => $total]);
    }

    public function updateInventory(Request $request)
    {
        $request ->validate([
            'id' => 'required',
            'inventory' => "required"
        ]);
        
        $id = request('id');
        // $inventory = request('inventory');

        // DD($id);
        // DD($inventory);

        // $inventory = ProductInventory::where('product_id', $id)
        //                 ->first();

        // $inventory->inventory = request('inventory');

        $product = Product::where('id', $id)->first();
        // DD($product);
        $product->inventory = request('inventory');
        $product -> update();

        // $newInventory = $inventory->inventory;
        $newInventory = $product->inventory;

        return response() -> json(['inventory' => $newInventory]);
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

        $product = new Product();
        $product->name = request('name');
        $product->size = request('size');
        $product->slug= request('slug');
        $product->price = request('price');
        $product->category_id = request('category_id');
        $product->inventory = request('inventory');
        $product->status_id = request('status_id');

        $category_id = request('category_id');

        $category = Category::where('id', $category_id)->first();

        // $image = Category::where('id', $category_id)->image->first();

        $product->image = $category->image;

        $product-> save();

        
        

        // $newCategory = $category->status()->first();

        // return response() -> json(['category' => $newCategory]);
        
    }

    public function updateStatus(Request $request)
    {
        $request ->validate([
            'id' => 'required',
            'status_id' => 'required'
        ]);

        $id = request('id');
        $product = Product::find($id);

        $product -> status_id = request('status_id');
        $product -> update();

        $updatedStatus = $product->status()->first()->status;

        return response() -> json(['status' => $updatedStatus]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    // public function show(Order $order)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
