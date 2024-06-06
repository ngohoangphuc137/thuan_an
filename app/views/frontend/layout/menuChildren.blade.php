<ul class="sub-menu-level2">
    @foreach ($menutreeUser2 as $key => $menu)
        @if (isset($id_category))
            @if ($menu['id_parent'] == $id_category)
                <li class="level3"><a href="{{route('danh-muc/').$menu['slugUrl']}}/"
                        style="padding-left:{{$distance * 3}}px;">{{$menu['name_childCategory']}}</a></li>
                @include('frontend.layout.menuChildren', ['id_category' => $menu['id_category'], 'distance' => $key + 1])
            @endif
        @else
            <li class="level3"><a href="{{route('danh-muc/').$menu['slugUrl']}}/">{{$menu['name_childCategory']}}</a></li>
        @endif

    @endforeach
</ul>