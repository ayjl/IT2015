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
        return view('product.list',
            [
                'products' => $products
            ]
        );
    }

    /**
     * Show a form to create a product.
     *
     * @return Response
     */
    public function create()
    {
        return view('product.create');
    }

}
