<script>
    $(document).ready(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        const deleteProduct = $('.deleteProduct')
        // for (let i = 0; i < deleteProduct.length; i++) {
        //     let element = deleteProduct[i];
        //     $(element).on('click',function(){
        //         const id = $(this).attr('data-product')
        //         $(`#box${id}`).remove()
        //     })
        // }
        $('.table-bordered').on('click', '.deleteProduct', function () {
            const id = $(this).attr('data-product')
            confirm("Bạn có chắc muốn xóa không (Chú ý:Nếu bạn xác nhận xóa thì các phần liên quan tới sản phẩm này sẽ bị xóa cùng)")
                ? $.ajax({
                    url: '{{route('deleteProduct')}}',
                    method: 'post',
                    data: { 'idProduct': id },
                    success: function (res) {
                        
                        //const data = JSON.parse(res);
                        console.log(res);
                            $(`#box${id}`).remove()
                            // Toast.fire({
                            //     icon: 'success',
                            //     title: 'Lưu thành công'
                            // })
                    }
                })
                : ''
        })
    })
</script>