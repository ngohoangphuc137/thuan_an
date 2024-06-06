<script>
    $(document).ready(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        function commentData() {
            $.ajax({
                url: '{{route('getComment/'.$getProductSlugUrl->id_product)}}',
                method: 'get',
                success: function (res) {
                    const data = JSON.parse(res)
                    $('.comments-area').html("");
                    $('.comments-area').append(data);
                }
        })
    }
    commentData()
    $('.pre').on('click', function () {
        var quanityInput = $(this).closest('.product-qty').find('#qty');
        var currentValue = parseInt(quanityInput.val());
        if (currentValue <= 1) {
            return
        }
        var qunty = currentValue - 1;
        quanityInput.val(qunty)
    })
    $('.next').on('click', function () {
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
    $('#qty').on('input', function () {
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
    $('.qty-buy-now').on('input', function () {
        let value = $(this).val();
        let price = $(this).closest('#formBuynow').find('.total-price').attr('data-totalprice')
        let totalqty = $(this).attr('data-totalqty')
        if (value <= totalqty) {
            let totalprice = (price * $(this).val()).toString();
            let formateNumber = totalprice.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
            $('.total-price').html(formateNumber)
        } else {
            $(this).val(totalqty)
            Toast.fire({
                icon: 'warning',
                title: 'Vượt qua số sản phẩm'
            })
        }
    })

    function validateEmail(value) {
        // Kiểm tra nếu giá trị nhập vào bắt đầu bằng dấu cách
        let regexEmail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if (!regexEmail.test(value)) {
            return false;
        }
        return true;
    };

    $('#btn-buynow').on('click', function () {
      let flag = true;
      let receiver = $('#receiver').val()
      let phone_number = $('#phone_number').val()
      let email = $('#email').val()
      let addrest = $('#addrest').val()
        if(receiver == "" || phone_number == "" || email == "" || addrest == ""){
            flag =false
            $('.form-message').html('')
            $('.form-message').append('Các trường phải nhập hết')
        }
        if(flag == true){
            $('.form-message').html('')
            let id_product = $(this).attr('data-id');
            let price = $('.total-price').attr('data-totalprice');
            const formBuynow = $('#formBuynow')[0]
            const formData = new FormData(formBuynow)
            formData.append('idProduct',id_product);
            formData.append('price',price);
            $.ajax({
                url:"{{ route('buyNow') }}",
                method:"post",
                cache: false,
                contentType: false,
                processData: false,
                data:formData,
                success:function(){
                   formBuynow.reset();
                   $('.clode-model').trigger('click');
                    Toast.fire({
                   icon: 'success',
                   title: 'Mua thành công'
                  })
                }
            })
             
        }
       
      
    })

    $('.userNotLoggedIn').on('click', function () {
        alert('Quý khách chưa đăng nhập xin hay đăng nhập hoặc đăng ký tài khoản đề mua hàng của chúng tôi.Cảm ơn!');
    })
    $('.btn-addCart').on('click', function () {
        const idProduct = $(this).attr('data-idProduct')
        const datatotalqty = $(this).attr('data-totalqty')
        const price = $('.total-price').attr('data-totalprice');
        const formAddCart = $('#formAddCart')[0];
        const formData = new FormData(formAddCart);
        formData.append('idProduct', idProduct)
        formData.append('price', price)
        formData.append('totalqty', datatotalqty)
        $.ajax({
            url: '{{ route('addcart') }}',
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function () {
                window.location.reload(true)
                window.scrollTo(0, 0);
            }

        })
    })

    $('.btn-submitComent').on('click',function(){
        const idProduct = $(this).attr('data-idProduct')
        const formUserComment = $('#formUserComment')[0]
        const formData =new FormData(formUserComment)
        formData.append('idProduct',idProduct)
        $.ajax({
            url:"{{ route('replyComment') }}",
            method:'post',
            data:formData,
            contentType:false,
            processData:false,
            success:function(){
                formUserComment.reset()
                commentData();
            }
        });
    })
})
</script>