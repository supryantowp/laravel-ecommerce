<div class="might-like-section">
    <div class="container">
        <h2>You might also like...</h2>
        <div class="might-like-grid">
            @foreach ($mightAlsoLike as $like)
            <a href="{{route('shop.show', $like->slug)}}" class="might-like-product">
                <img src="{{ productImage($like->image) }}" alt="product">
                <div class="might-like-product-name">{{$like->name}}</div>
                <div class="might-like-product-price">{{$like->presentPrice()}}</div>
            </a>
            @endforeach
        </div>
    </div>
</div>