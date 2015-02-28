@extends('app')

@section('content')
<div class="container">
    @if(isset($product->id))
    <h1>Edit Product</h1>
    @else
    <h1>Create Product</h1>
    @endif

    @if(sizeof($errors->all()) != 0)
       <div class="alert alert-danger">
       @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
       @endforeach
       </div>
    @endif

    <form method="POST" action="{{isset($product->id)? URL::route('admin.product.update', ['id'=>$product->id]) : URL::route('admin.product.store')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @if(isset($product->id))
        <input type="hidden" name="_method" value="PUT">
        @endif

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name" class="control-label required">Product name</label>
                    <input id="name" name="name" type="text" class="form-control" required value="{{ old('name', $product->name) }}">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="stock_number" class="control-label required">Stock number</label>
                    <input id="stock_number" name="stock_number" type="text" class="form-control" required value="{{ old('stock_number', $product->stock_number) }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="control-label required">Description</label>
            <textarea id="description" name="description" type="text" class="form-control" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="price" class="control-label required">Price</label>
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input id="price" name="price" type="number" step="0.01" class="form-control" required value="{{ old('price', $product->price) }}">
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="stock_number" class="control-label required">Availability</label>
                    <div class="checkbox">
                        <label>
                            <input name="available" type="checkbox" value="1" {{old('available', $product->available)? 'checked':''}}>Available
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="control-label {{isset($product->id)? '':'required'}}">Image</label>
            <input id="image" name="image" type="file" class="form-control" {{isset($product->id)? '':'required'}}>
        </div>

        @if(isset($product->id))
        <div class="product-image" style="background-image:url('{{URL::to($product->image)}}')"></div>
        @endif

        <div class="button-row">
            <input type="submit" value="Save" class="btn btn-primary pull-left">
            <a href="{{URL::route('admin.home')}}" class="btn btn-default pull-left">Back</a>
            <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#ModalDelete">Delete</a>
        </div>
    </form>

    @if(isset($product->id))
    <div id="ModalDelete" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">Delete Product?</h3>
                </div>
                <div class="modal-body">
                    <div class="modal-controls">
                    <form method="POST" action="{{URL::route('admin.product.destroy', ['id'=>$product->id])}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-default no-disable" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form> 
                </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
