<header>
    <div class="top-nav container">
        <div class="logo"><a href="/">Laravel Ecommerce</a></div>
        @if (! request()->is('checkout'))
        {{menu('main', 'partials.menu.main')}}
        @endif
    </div> <!-- end top-nav -->
</header>