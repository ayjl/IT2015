@extends('app')

@section('content')
<div class="container">
    <div class="button-row">
        <a href="{{URL::route('home')}}" class="btn btn-default">Back</a>
    </div>

    <div class="row">
        <div class="col-sm-4 clearfix">
            <div class="product-image product-image-show pull-left" style="background-image:url('{{URL::to($product->image)}}')"></div>
        </div>
        <div class="col-sm-8">
            <h1>{{$product->name}}</h1>
            <small>SKU: {{$product->stock_number}}</small>
            <small class="{{$product->available? 'available' : 'unavailable'}}">{{$product->available? 'Available' : 'Unavailable'}}</small>
            <h4>
                ${{$product->price}}
            </h4>
            <p>{!!nl2br(e($product->description))!!}</p>
        </div>
    </div>
</div>
@endsection
