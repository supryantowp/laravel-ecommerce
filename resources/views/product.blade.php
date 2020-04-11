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
            <img src="{{ productImage($product->image) }}" alt="product" class="active" id="curentImage">
        </div>

        <div class="product-section-images ">

            <div class="product-section-thumbnail selected">
                <img src="{{productImage($product->image)}}" alt="">
            </div>
            @if ($product->images)
            @foreach (json_decode($product->images, true) as $item)
            <div class="product-section-thumbnail ">
                <img src="{{productImage($item)}}" alt="">
            </div>
            @endforeach
            @endif
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

@section('extra-js')
<script>
    const curnImage = document.querySelector('#curentImage')
    let images = document.querySelectorAll('.product-section-thumbnail')

    images.forEach(element => element.addEventListener('click', thumbnailClick))

    function thumbnailClick(e)
    {
        curnImage.classList.remove('active')
        
        curnImage.addEventListener('transitionend', () => {
            curnImage.src = this.querySelector('img').src
            curnImage.classList.add('active')
        })

        images.forEach(element => element.classList.remove('selected'))
        this.classList.add('selected')
    }

</script>
@endsection