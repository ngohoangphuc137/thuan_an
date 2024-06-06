<script>
    $(document).ready(function () {
        const BASE_URL = "<?php echo BASE_URL ?>"
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        let dataCategory = $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        function fechData() {
            output = "";
            $.ajax({
                url: `{{ route('getallCategory') }}`,
                method: "GET",
                cache: false,
                success: function (res) {
                    const data = JSON.parse(res)
                    dataCategory.clear().draw()
                    $('.selectCategory').html('<option value="">Mời chọn danh mục</option>')
                    $.each(data[0], function (index, value) {
                        dataCategory.row.add([
                            `<p>${index + 1}</p>`,
                            value[1],
                            value[2],
                            value[4],
                            `${value[3] == 1 ? '<span class="badge badge-primary">Dang hiển thị</span>' : '<span class="badge badge-warning">Đã bị ẩn</span>'}`,
                            `<div class="btn-act">
                           <button type="button" class="btn btn-outline-primary btn-updata" value="${value[0]}" data-toggle="modal" data-target="#staticBackdrop"><i
                             class="fas fa-edit"></i></button>
                           <button type="button" class="btn btn-outline-danger btn-delete" value="${value[0]}"><i
                             class="far fa-trash-alt"></i></button>
                        </div>
                        `,
                        ]).draw(false)
                    })

                    for (let i = 0; i < data[1].length; i++) {
                        output += `<option value="${data[1][i].value}" >${data[1][i].text}</option>`
                    }
                    //  $('.selectCategory').remove(output)

                    $('.selectCategory').append(output)
                }
            })
        }
        fechData()

        $.validator.addMethod("noSpace", function (value, element) {
            // Kiểm tra nếu giá trị nhập vào bắt đầu bằng dấu cách
            if (/^\s/.test(value)) {
                return false;
            }
            return true;
        });
        $('#formCategort').validate({
            rules: {
                categoryName: {
                    required: true,
                    noSpace: true
                }
            },
            messages: {
                categoryName: {
                    required: "* Vui lòng nhập vào giá trị",
                    noSpace: "* Vui lòng không nhập dấu cách đầu tiên",
                },
            },
        });

        // Thêm danh mục sản phẩm
        $('#click').on('click', function () {
            var selectCategory = $('.selectCategory').val()
            var categoryMain = 0;
            if (selectCategory !== "") {
                categoryMain = selectCategory
            }
            if ($('#formCategort').valid()) {
                $('.close').trigger('click')
                var namCate = $('#categoryName').val()
                $.ajax({
                    url: "{{ route('moreCategory') }}",
                    method: "POST",
                    data: {
                        namCate,
                        categoryMain
                    },
                    success: function (res) {
                        fechData()
                        $('#formCategort')[0].reset();
                        Toast.fire({
                            icon: 'success',
                            title: 'Thêm thành công'
                        })
                    }
                })
            }
        })

        // xóa danh mục
        $("#example2").on("click", ".btn-delete", function () {
            const idcategory = $(this).val();
            if (confirm(
                "Bạn có chắc muốn xóa không (Nếu xóa sẽ ảnh hưởng tới các chức năng liên quan khác)")) {
                $.ajax({
                    url: `{{ route('deleteCategory') }}`,
                    method: 'POST',
                    data: {
                        idcategory
                    },
                    success: function (res) {
                        const data = JSON.parse(res)
                        fechData()
                        if (data.status == 200) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Xóa thành công'
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Xóa thất bại'
                            })
                        }
                    }
                })
            }
        })
        // sửa danh mục
        $('#example2').on('click', '.btn-updata', function () {
            const idCategory = $(this).val();
            const statusCategory = $('.statusCategory option');
            const MenutreeSelect = $('.optionMenutree');
           
            $.ajax({
                url: `${BASE_URL}getIdCategory/${idCategory}`,
                method: 'POST',
                success: function (res) {
                    const data = JSON.parse(res)
                    const [getIdData] = data[0]
                    const [...menuTree] = data[1]

                    $('#idCategory').val(getIdData.id_category)
                    $('#NameCategory').val(getIdData.name_category)
                    $('.optionMenutree').html('<option value="0">Thuộc cấp cha</option>')

                    const filterMenutree = menuTree.filter(function (option) {
                        return getIdData.id_category !== option.value
                    })
                    const optionMenutree = $.map(filterMenutree, function (val, index) {
                        return (
                            `<option value="${val.value}" ${getIdData.id_parent == val.value ? 'selected' : ''} >${val.text}</option>`
                        )
                    })
                    MenutreeSelect.append(optionMenutree)

                    statusCategory.each(function () {
                        $(this).removeAttr('selected');
                    });

                    const optionStatus = statusCategory.filter(function (option) {
                        return option === getIdData.status;
                    })

                    optionStatus.attr('selected', 'true')
                }
            })
        })

        $('#updataCategory').on('click', function () {
            const idCategory = $('#idCategory').val();
            const NameCategory = $('#NameCategory').val();
            const optionMenutree = $('#optionMenutree').val();
            const statusCategory = $('#statusCategory').val();
            $.ajax({
                url: '{{ route('updataCategory') }}',
                method: 'POST',
                data: { idCategory, NameCategory, optionMenutree, statusCategory },
                success: function (res) {
                    const data = JSON.parse(res)
                    $('.close').trigger('click');
                    if (data.status == 200) {
                        fechData()
                        Toast.fire({
                            icon: 'success',
                            title: 'Cập nhật thành công'
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Cập nhật thất bại'
                        })
                    }
                }
            })

        })

    })
</script>