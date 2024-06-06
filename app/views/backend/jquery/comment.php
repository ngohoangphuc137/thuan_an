<script>
    $(document).ready(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        function loadComment() {
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
    loadComment()
    // block form comment
    $('.comments-area').on('click', '.replyUser', function () {
        $('.reply-user').html('')
        const nameUser = $(this).attr('data-nameUser')
        $(this).closest('.li_comment_user').find('.reply-user').append(`
            <form id="FormReplyUser">
                <div data- class="title-formReplyUser d-flex align-items-center">
                    <p class="replyFrom">Phản hồi đến
                        <trong>${nameUser}</trong>
                    </p>
                     <p class="closeComment" style="padding-left: 10px;">Hủy</p>
                </div>
                <label for="">Bình luận *</label>
                <textarea class="form-control" name="" id="reply-msg"
                    cols="30" rows="3"></textarea>
                <button type="button" class="btn btn-danger by-2 mt-2 btn-submitComment">Phản hồi</button>
            </form>
            `)
    })
    // clean form comment
    $('.comments-area').on('click', '.closeComment', function () {
        $('.reply-user').html('')
    })
    $(document).on('click', '.btn-submitComment', function () {
        const idComment = $(this).closest('.li_comment_user').find('.replyUser').attr('data-idComment')
        const idProduct = $(this).closest('.li_comment_user').find('.replyUser').attr('data-idProduct')
        const commentContent = $(this).closest('.li_comment_user').find('#reply-msg').val();
        const name = 'admin'
        const data = { 'name_user': name, 'idComment': idComment, 'idProduct': idProduct, 'commentContent': commentContent }
        if (commentContent !== "") {
            $.ajax({
                url: '{{route('replyComment')}}',
                method: 'post',
                data: data,
                success: function (res) {
                    const data = JSON.parse(res);
                    loadComment()
                    $('.reply-user').html('')
                    if (data.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Gửi bình luận thành công'
                        })
                    }
                }
            })
        }
    })
    
    $('.comments-area').on('click','.btn-remove-comment',function(){
        const idProduct = $(this).attr('data-idproduct')
        confirm("Bạn có chắc muốn xóa không") ?
        $.ajax({
            url:'{{ route('deleteComment') }}',
            method:'post',
            data:{'idProduct':idProduct},
            success:function(){
                loadComment()
                Toast.fire({
                    icon: 'success',
                    title: 'Xóa bình luận thành công'
                })
            }
        })
        : ''

    })
    })
</script>