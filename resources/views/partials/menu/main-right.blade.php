<ul>
    @guest
    <li><a href="{{route('register')}}">Sign Up</a></li>
    <li><a href="{{route('login')}}">Login</a></li>
    @else
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    </li>
    <li>
        <a href="{{route('cart.index')}}">Cart
            @if (Cart::instance('default')->count() > 0)
            <span class="cart-count"><span>{{Cart::instance('default')->count()}}</span></span>
            @endif
        </a>
    </li>
    @endguest
</ul>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>