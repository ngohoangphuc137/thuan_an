<div class="megamenu mobile-sub-menu">
    <ul class="sub-menu-level1">
        @foreach ($menutreeUser2 as $menu)
            @if ($menu['lever'] == 0)
                <li class="level2"><a href="{{route('danh-muc/').$menu['slugUrl']}}/"><strong>{{$menu['name_childCategory']}}</strong></a>
                 @include('frontend.layout.menuChildren',['id_category'=>$menu['id_category'],'distance'=>0])
                </li>
            @endif
        @endforeach
    </ul>
</div>