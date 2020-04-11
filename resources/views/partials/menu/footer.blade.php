<ul>
    <li>Follow Me: </li>
    @foreach ($items as $menu)
    <li><a href="{{$menu->link()}}"><i class="{{$menu->icon_class}}"></i></a></li>
    @endforeach
</ul>