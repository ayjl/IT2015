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

    <form method="POST" action="{{URL::route('admin.product.store')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

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
            <label for="image" class="control-label required">Image</label>
            <input id="image" name="image" type="file" class="form-control" required>
        </div>

        <input type="submit" value="Save" class="btn btn-primary">
    </form>
</div>

@endsection
