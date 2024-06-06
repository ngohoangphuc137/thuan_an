<script>
    $(document).ready(function () {
        // Summernote
        $('#summernote-post').summernote({
            tabsize: 2,
            height: 400,
            callbacks: {
                onImageUpload: function (image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function (target) {
                    deleteFile(target[0].src)
                }
            }
        })

        function uploadImage(image) {
            let out = new FormData();
            out.append('file', image, image.name);
            $.ajax({
                url: '{{ route('uploadFile') }}',
                method: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: out,
                success: function (img) {
                    const data = JSON.parse(img);
                    if (data.status == 'error') {
                        alert('file ảnh đã có');
                    } else {
                        $('#summernote-post').summernote('insertImage', data.file);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function deleteFile(image) {
            const imgSrc = image;
            $.ajax({
                url: '{{ route('deleteFile') }}',
                method: 'post',
                data: { 'imgSrc': imgSrc },
                success: function (opt) {
                }
            })
        }


        $('.Avatar-post').on('click', function () {
            $('#file-image').click();
        })
        $('#file-image').on('change', function () {
            const file = this.files[0];
            var render = new FileReader();
            render.onload = function (event) {
                var content = event.target.result;
                $('#image-div .avatar').remove()
                $('#image-div').append(`<img class="avatar" src="${content}" alt="">`)
            }
            render.readAsDataURL(file);

        })
    })
</script>