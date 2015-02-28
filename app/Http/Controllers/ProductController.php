<?php namespace App\Http\Controllers;

use App\Product;
use \Validator;
use \Input;
use \Redirect;

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
        return view('product.form', 
            [
                'product' => new Product
            ]);
    }

    /**
     * Store the product.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
           'name'           => 'required|string|max:100'
           ,'description'   => 'required|string'
           ,'price'         => 'required|numeric'
           ,'image'         => 'required|image|max:1024'
           ,'stock_number'  => 'required|alpha_num|size:10'
           ,'available'     => 'in:1'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes())
        {
            $image = Input::file('image');
            $fileLocation = public_path().'/images/';
            $fileName = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move($fileLocation, $fileName);

            $product = new Product;
            $product->name          = Input::get('name');
            $product->description   = Input::get('description');
            $product->price         = Input::get('price');
            $product->image         = 'images/'.$fileName;
            $product->stock_number  = Input::get('stock_number');
            $product->available     = Input::get('available', false);

            $product->save();

           return Redirect::route("admin.product.edit", [$product->id]);
        }
        
        return Redirect::route('admin.product.create')->withInput()->withErrors($validator);
    }

    /**
     * Show a form to edit an existing product.
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.form',
            [
                'product' => $product
            ]
        );
    }

}
