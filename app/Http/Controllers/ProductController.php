<?php namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the list of products.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products',
            [
                'products' => $products
            ]
        );
    }

}
