<script>
    $(document).ready(function () {
        function convertNumber(number) {
            var convert = number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
            return convert
        }
        function debouce(callback, delay) {
            let timeout = null;

            return (...args) => {
                clearTimeout(timeout)
                timeout = setTimeout(() => {
                    callback(...args)
                }, delay);
            }
        }
        function handInputChange(e) {
            var searchText = e.target.value
            if (!searchText.startsWith(' ')) {
                $.ajax({
                    url: '{{route('searchProduct')}}',
                    method: 'post',
                    data: { 'query': searchText },
                    dataType: 'json',
                    success: function (res) {
                        if (res.length > 0) {
                            $('.header-search').show()
                            const item = $.map(res, function (value) {
                                return (`
                            <li class="autocomplete-suggestion">
                                    <a href="{{ route('san-pham/') }}${value.slugUrlProduct}/">
                                        <img class="search-img"
                                            src="{{BASE_URL}}${value.imageDescribe}"
                                            alt="">
                                        <div class="search-name">
                                            ${value.name_product}
                                        </div>
                                        <span class="search-price">
                                            ${convertNumber(value.price)}đ
                                        </span>
                                    </a>
                                </li>
                            `)
                            })
                            $('.list-product-search').html('')
                            $('.list-product-search').append(item)
                        } else {
                            $('.list-product-search').html('')
                            searchText == "" ? $('.header-search').hide() :  $('.header-search').show()
                            const html = '<li class="autocomplete-suggestion"><a><span class="empty-product">Không có sản phẩm nào</span></a></li>' 
                            $('.list-product-search').html(html)
                         
                        }
                    }
                })
            }
            
        }

        $('.input-search').on('input', debouce(handInputChange, 500))
        $(window).click(()=>{
            $('.header-search').hide()
            $('.list-product-search').html('')
        })
        $(window).on('scroll',function(){
            var scrollTop = $(window).scrollTop();
            var locationHeader = $('.boxNavBar').position().top;
            if(scrollTop > 100){
                $('.boxNavBar').addClass('sticky-header');
            }else{
                $('.boxNavBar').removeClass('sticky-header');            
            }
        })

    })
</script>