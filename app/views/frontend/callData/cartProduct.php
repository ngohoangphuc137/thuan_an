<script>
    $(document).ready(function () {

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });

        function getdata() {
            $.ajax({
                url: '{{ route('getCartProduct') }}',   
                method: 'get',
                success: function (res) {
                    const data = JSON.parse(res)
                    if (data.status == 200) {
                        const { getProductIN, sessionCart } = data.data;

                        const convertObjectQuanity = Object.keys(sessionCart).map(key => parseInt(sessionCart[key]['quanity']));
                        const convertObjectPrice = Object.keys(sessionCart).map(key => (parseInt(sessionCart[key]['quanity']) * parseInt(sessionCart[key]['price'])));

                        const totalProduct = convertObjectQuanity.reduce(function (total, quanity) {
                            return total + quanity
                        }, 0)

                        const totalPrice = convertObjectPrice.reduce(function (total, price) {
                            return total + price
                        }, 0)
                        const listProduct = $.map(getProductIN, function (value, index) {
                            const totalPrice = sessionCart[value['id_product']]['price'] * sessionCart[value['id_product']]['quanity']
                            return `
                            <tr>
                                   <td>
                                   <p class="remove-cart-product" data-idProduct="${value['id_product']}">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="lucide lucide-circle-x"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                                    </p>
                                    </td>
                                    <td>
                                        <div>
                                        <img width="70px" src="{{ BASE_URL }}${value['imageDescribe']}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                    <p>${value['name_product']}</p>
                                    </td>
                                    <td>
                                        <div class="base-price price-box"> <span class="price">${convertNumber(sessionCart[value['id_product']]['price'])}đ</span> </div>
                                    </td>
                                    <td>
                                        <div class="input-box">
                                            <div class="product-qty">
                                                <div class="custom-qty">
                                                    <button class="reduced pre-items" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-minus">
                                                            <path d="M5 12h14" />
                                                        </svg>
                                                    </button>
                                                    <input type="text" style="max-width: 45px;" class="input-text qty"
                                                        title="Qty" data-quanity="${value['quanity']}" name=quanity[${value['id_product']}]
                                                        value="${sessionCart[value['id_product']]['quanity']}" min="1" maxlength="8" id="qty" name="qty">
                                                    <button class="increase nex-items" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-plus">
                                                            <path d="M5 12h14" />
                                                            <path d="M12 5v14" />
                                                        </svg>
                                                    </button>
                                                </div>

                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-box">${convertNumber(totalPrice)}đ</div>
                                    </td>

                                    <td><a href=""><i title="Remove Item From Cart" data-id="100"
                                                class="fa fa-trash cart-remove-item"></i></a></td>
                                </tr>
                            `
                        })
                        $('.tbody-cart').html('')
                        $('.tbody-cart').append(listProduct)
                        $('.cart-notification').html('')
                        $('.cart-notification').append(totalProduct)
                        $('.total-price').html('')
                        $('.total-price').append(convertNumber(totalPrice) + 'đ')
                    }
                },
                error: function (xhr, status, error) {
                    // Handle AJAX error
                    console.log("AJAX request failed. Status: " + status + ", Error: " + error);
                }
            })
        }
        function convertNumber(number) {
            var convert = number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
            return convert
        }
        getdata()
        // quanity product
        $('.tbody-cart').on('click', '.pre-items', function () {
            var quanityInput = $(this).closest('.product-qty').find('#qty');
            var currentValue = parseInt(quanityInput.val());
            if (currentValue <= 1) {
                return
            }
            var qunty = currentValue - 1;
            quanityInput.val(qunty)
        })
        $('.tbody-cart').on('click', '.nex-items', function () {
            var quanityInput = $(this).closest('.product-qty').find('#qty');
            var quanityProdutc = parseInt(quanityInput.attr('data-quanity'))
            var currentValue = parseInt(quanityInput.val());
            if (currentValue < quanityProdutc) {
                var qunty = currentValue + 1;
                quanityInput.val(qunty)
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: 'Vượt qua số sản phẩm'
                })
            }

        })
        $('.tbody-cart').on('input', '#qty', function () {
            var value = parseInt($(this).val());
            var quanityProdutc = parseInt($(this).attr('data-quanity'))
            isNaN(value) || value == 0 ? $(this).val(1) : $(this).val(value)
            if (quanityProdutc < value) {
                $(this).val(1)
                Toast.fire({
                    icon: 'warning',
                    title: 'Vượt qua số sản phẩm'
                })
            }
        })
        // delete product from cart
        $('.tbody-cart').on('click', '.remove-cart-product', function () {
            const id_product = $(this).attr('data-idProduct')
            $.ajax({
                url: '{{ route('deleteCart') }}',
                method: 'post',
                data: { 'id_product': id_product },
                success: function (res) {
                    const data = JSON.parse(res)
                    if (data.data == true) {
                        getdata()
                        Toast.fire({
                            icon: 'success',
                            title: 'Xóa thành công'
                        })
                    } else {
                        window.location.reload();
                    }
                }
            })
        })
        // updata quanity product from cart 
        $('.updata-product-cart').on('click', function () {
            const formCart = $('#form-table-cart')[0]
            const formData = new FormData(formCart);
            $.ajax({
                url: '{{ route('updataCart') }}',
                method: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    getdata()
                    Toast.fire({
                        icon: 'success',
                        title: 'Cập nhật thành công'
                    })
                }
            })

        })
    })
</script>