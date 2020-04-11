@extends('layout')

@section('title', $product->name)

@section('extra-css')

@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <a href="{{url('/')}}">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <a href="{{route('shop.index')}}">Shop</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Macbook Pro</span>
    </div>
</div> <!-- end breadcrumbs -->

<div class="product-section container">
    <div>
        <div class="product-section-image">
            <img src="{{ productImage($product->image) }}" alt="product">
        </div>

        <div>
            @foreach (json_decode($product->images, true) as $item)
            {{$item}}
            @endforeach
        </div>
    </div>

    <div class="product-section-information">
        <h1 class="product-section-title">{{$product->name}}</h1>
        <div class="product-section-subtitle">{{$product->details}}</div>
        <div class="product-section-price">{{$product->presentPrice()}}</div>

        <p>
            {!! $product->description !!}
        </p>

        <p>&nbsp;</p>

        <form action="{{route('cart.store')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}">
            <input type="hidden" name="name" value="{{$product->name}}">
            <input type="hidden" name="price" value="{{$product->price}}">
            <button class="button button-plain">Add to Cart</button>
        </form>
    </div>
</div> <!-- end product-section -->

@include('partials.might-like')


@endsection