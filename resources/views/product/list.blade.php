@extends('app')

@section('content')
<div class="container">
    <h1>
        Products
        @if(strpos(Request::url(), 'admin') !== false)
        <a href="{{URL::route('admin.product.create')}}" class="btn btn-primary">New Product</a>
        @endif
    </h1>

    <ul class="products-list">
        @foreach($products as $product)
        <li>
            <a href="{{URL::route(strpos(Request::url(), 'admin')? 'admin.product.edit' : 'product.show', ['id'=>$product->id])}}">
                <h2>{{$product->name}}</h2>
                <div class="product-image" style="background-image:url('{{URL::to($product->image)}}')"></div>
                <p>Ming: {{$product->ming}}</p>
                <p>${{$product->price}} - <small class="{{$product->available? 'available' : 'unavailable'}}">{{$product->available? 'Available' : 'Unavailable'}}</small></p>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection
