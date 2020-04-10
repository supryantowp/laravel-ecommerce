@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <a href="#">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shopping Cart</span>
    </div>
</div> <!-- end breadcrumbs -->

<div class="cart-section container">
    <div>

        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{session()->get('success_message')}}
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (Cart::count() > 0)

        <h2>{{Cart::count()}} item(s) in Shopping Cart</h2>

        <div class="cart-table">
            @foreach (Cart::content() as $item)

            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a href="{{route('shop.show', $item->model->slug)}}"><img
                            src="{{asset('img/products/' .$item->model->slug . '.png')}}" alt="item"
                            class="cart-table-img"></a>
                    <div class="cart-item-details">
                        <div class="cart-table-item"><a
                                href="{{route('shop.show', $item->model->slug)}}">{{$item->model->name}}</a></div>
                        <div class="cart-table-description">{{$item->model->details}}</div>
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="cart-table-actions">
                        <form action="{{route('cart.destroy', $item->rowId)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cart-options">Remove</button>
                        </form>
                        <form action="{{route('cart.switchToSafeForLater', $item->rowId)}}" method="post">
                            @csrf
                            <button type="submit" class="cart-options">Save To Later</button>
                        </form>
                    </div>
                    <div>
                        <select class="quantity" data-id="{{$item->rowId}}">
                            @for ($i = 1; $i < 6 * 1; $i++) <option {{$item->qty == $i ? "selected" : ""}}>{{$i}}
                                </option>
                                @endfor
                        </select>
                    </div>
                    <div>{{presentPrice($item->subtotal())}}</div>
                </div>
            </div> <!-- end cart-table-row -->

            @endforeach


        </div> <!-- end cart-table -->



        <div class="cart-totals">
            <div class="cart-totals-left">
                Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like
                figuring out :).
            </div>

            <div class="cart-totals-right">
                <div>
                    Subtotal <br>
                    Tax(10%) <br>
                    <span class="cart-totals-total">Total</span>
                </div>
                <div class="cart-totals-subtotal">
                    {{presentPrice(Cart::subTotal())}} <br>
                    {{presentPrice(Cart::tax())}}<br>
                    <span class="cart-totals-total">{{presentPrice(Cart::total())}}</span>
                </div>
            </div>
        </div> <!-- end cart-totals -->

        <div class="cart-buttons">
            <a href="{{route('shop.index')}}" class="button">Continue Shopping</a>
            <a href="{{route('checkout.index')}}" class="button-primary">Proceed to Checkout</a>
        </div>


        @else

        <h3>No item in cart</h3>
        <div class="spacer"></div>
        <a href="{{route('shop.index')}}" class="button ">Continue Shopping</a>
        <div class="spacer"></div>


        @endif


        @if (Cart::instance('saveForLater')->count() > 0)

        <h2>{{Cart::count()}} item(s) in Shopping Cart</h2>


        <div class="saved-for-later cart-table">

            @foreach (Cart::content() as $item)
            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a href="{{route('shop.show', $item->model->slug)}}"><img
                            src="{{asset('img/products/' .$item->model->slug . '.png')}}" alt="item"
                            class="cart-table-img"></a>
                    <div class="cart-item-details">
                        <div class="cart-table-item"><a
                                href="{{route('shop.show', $item->model->slug)}}">{{$item->model->name}}</a></div>
                        <div class="cart-table-description">{{$item->model->details}}</div>
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="cart-table-actions">
                        {{-- <a href="#">Remove</a> <br> --}}
                        <form action="{{route('saveForLater.destroy', $item->rowId)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cart-options">Remove</button>
                        </form>
                        {{-- <a href="#">Move to Cart</a> --}}
                        <form action="{{route('saveForLater.switchToCart', $item->rowId)}}" method="post">
                            @csrf
                            <button type="submit" class="cart-options">Save To Cart</button>
                        </form>
                    </div>
                    {{-- <div>
                            <select class="quantity">
                                <option selected="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div> --}}
                    <div>{{presentPrice($item->model->price)}}</div>
                </div>
            </div> <!-- end cart-table-row -->
            @endforeach

        </div> <!-- end saved-for-later -->

        @else
        <h3>No item in save later</h3>
        @endif
    </div>

</div> <!-- end cart-section -->

@include('partials.might-like')


@endsection

@section('extra-js')
<script src="{{asset('js/app.js')}}"></script>
<script>
    const classname = document.querySelectorAll('.quantity')

    Array.from(classname).forEach(function(element){
        element.addEventListener('change', function(){
            const id = element.getAttribute('data-id');

            axios.patch(`cart/${id}`, {
                quantity: this.value
            })
            .then(function (response) {
                window.location.href = '{{route('cart.index')}}'
            })
            .catch(function (error) {
                window.location.href = '{{route('cart.index')}}'
            });
        })
    })
</script>
@endsection