@extends('app')

@section('content')
<div class="container">
    <h1>
        Products
        @if(strpos(Request::url(), 'admin') !== false)
        <a href="{{URL::route('admin.product.create')}}" class="btn btn-primary">New Product</a>
        @endif
    </h1>

    @foreach($products as $product)
        <p>{{$product->name}}</p>
    @endforeach
</div>
@endsection
