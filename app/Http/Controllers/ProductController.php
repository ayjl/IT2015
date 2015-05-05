<?php namespace App\Http\Controllers;

use App\Product;

use \File;
use \Input;
use \Redirect;
use \Request;
use \Session;
use \Validator;

class ProductController extends Controller {

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
     * Show the specified product.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(!isset($product)){
            return Redirect::route('home');
        }

        return view('product.show',
            [
                'product' => $product
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
     * Store a new product.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
           'name'           => 'required|string|max:100'
           ,'description'   => 'required|string'
		   ,'brian'  		 => 'required|string'
           ,'price'         => 'required|numeric|min:0|max:9999999.99'
           ,'image'         => 'required|image|max:1024'
           ,'stock_number'  => 'required|alpha_num|size:10'
           ,'available'     => 'in:1'
        ];

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
			$product->brian			= Input::get('brian');
            $product->price         = Input::get('price');
            $product->image         = '/images/'.$fileName;
            $product->stock_number  = Input::get('stock_number');
            $product->available     = Input::get('available', false);

            $product->save();

            return Redirect::route('admin.product.edit', $product->id)
                ->with('data', ['alert'=>'Product saved', 'alertType'=>'success']);
        }

        return Redirect::route('admin.product.create')->withInput()->withErrors($validator);
    }

    /**
     * Show a form to edit the specified product.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if(!isset($product)){
            return Redirect::route('admin.home');
        }

        $data = Session::get('data', null);

        return view('product.form',
            [
                'product' => $product,
                'data'    => $data
            ]
        );
    }

    /**
     * Update the specified product.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = [
           'name'           => 'required|string|max:100'
           ,'description'   => 'required|string'
		   ,'brian'			=> 'required|string'
           ,'price'         => 'required|numeric|min:0|max:9999999.99'
           ,'image'         => 'image|max:1024'
           ,'stock_number'  => 'required|alpha_num|size:10'
           ,'available'     => 'in:1'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes())
        {
            $product = Product::find($id);

            if(!isset($product)){
                return Redirect::route('admin.home');
            }

            if(Input::hasFile('image'))
            {
                $file = public_path().$product->image;
                
                if(File::exists($file)) {
                    File::delete($file);
                }

                $image = Input::file('image');
                $fileLocation = public_path().'/images/';
                $fileName = uniqid().'.'.$image->getClientOriginalExtension();
                $image->move($fileLocation, $fileName);

                $product->image = '/images/'.$fileName;
            }

            $product->name          = Input::get('name');
            $product->description   = Input::get('description');
			$product->brian			= Input::get('brian');
            $product->price         = Input::get('price');
            $product->stock_number  = Input::get('stock_number');
            $product->available     = Input::get('available', false);

            $product->save();

            return Redirect::route('admin.product.edit', $id)
                ->with('data', ['alert'=>'Product saved', 'alertType'=>'success']);
        }

        return Redirect::route('admin.product.edit', [$id])->withInput()->withErrors($validator);
    }

    /**
     * Delete the specified product.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if(isset($product))
        {
            $file = public_path().$product->image;

            if(File::exists($file)) {
                File::delete($file);
            }

            $product->delete();
        }

        return Redirect::route('admin.home');
    }
}
