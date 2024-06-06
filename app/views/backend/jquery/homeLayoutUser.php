<script>
    $(document).ready(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        let table = $("#example3").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
        function fetchData() {
            $.ajax({
                url: "{{ route('getdata') }}",
                method: 'post',
                cache: false,
                success: function (res) {
                    const data = JSON.parse(res)
                    const listNameTitle = $.map(data.listNameTitle, function (value) {
                        return `<option value="${value.id_category}" data-title="${value.name_category}">${value.name_category}</option>`
                    })

                    $('#nameTitle').html('');
                    $('#nameTitle').append(listNameTitle);
                    table.clear().draw()
                    $.each(data.getLayout, function (index, value) {

                        table.row.add([
                            `<p class="idLayout" data-id="${value.id_layout}">${index + 1}</p>`,
                            value.title,
                            value.limitProduct + ' sản phẩm',
                            value.name_layout,
                            value.priority==0 ? 'Chưa sắp xếp' : value.priority,
                            `<div class="btn-act">
                           <button type="button" class="btn btn-outline-primary btn-updata" value="${value.id_layout}" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i
                             class="fas fa-edit"></i></button>
                           <button type="button" class="btn btn-outline-danger btn-delete" value="${value.id_layout}"><i
                             class="far fa-trash-alt"></i></button>
                        </div>
                        `,
                        ]).draw(false)
                    })
                }
            })
        }
        fetchData()
        $('.btn-moreLayout').on('click', function () {
            const insertLayout = $('#insertLayout')[0]
            let nameTitle = $(this).closest('#insertLayout').find('#nameTitle').children('option:selected').attr('data-title')
            const fromData = new FormData(insertLayout);
            fromData.append('nameTitle', nameTitle)
            $.ajax({
                url: '{{ route('insertLayout') }}',
                method: "post",
                data: fromData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    const data = JSON.parse(res);
                    if (data.status == 200) {
                        insertLayout.reset();
                        fetchData()
                        $('.close').trigger('click')
                        Toast.fire({
                            icon: 'success',
                            title: 'Thêm thành công'
                        })
                    }
                }
            })
        })
        $('.tableLayout').on('click', '.btn-updata', function () {
            let idlayout = $(this).val();
            $.ajax({
                url: '{{ route('getDataLayoutId') }}',
                method: "post",
                data: { idlayout },
                success: function (res) {
                    const data = JSON.parse(res)
                    $('#idLayout').val(data.id_layout)
                    $('.titleLayout').html(data.title)
                    $('#updataNumberProduct').val(data.limitProduct)
                    let option = $('#updataInterfaceType option')
                    option.each(function () {
                        $(this).removeAttr('selected');
                    });
                    const optionStatus = option.filter(function (index, option) {
                        return option.value == data.name_layout;
                    })
                    optionStatus.attr('selected', 'true')

                }
            })
        })

        $('.btn-updataLayout').on('click', function () {
            const updataLayoutHome = $('#updataLayoutHome')[0];
            const formData = new FormData(updataLayoutHome);
            $.ajax({
                url: '{{ route('updataLayout') }}',
                method: "post",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    const data = JSON.parse(res);
                    if (data.status == 200) {
                        fetchData()
                        $('.close').trigger('click')
                        Toast.fire({
                            icon: 'success',
                            title: 'Sửa thành công'
                        })
                    }
                }
            })
        })

        $('.tableLayout').on('click', '.btn-delete', function () {
            let idlayout = $(this).val();
            confirm('Bạn có chắc muốn xóa không (nếu xóa các sản phẩm trang chủ bên giao diện người dùng sẽ mất)')
                ? $.ajax({
                    url: '{{ route('deleteLayout') }}',
                    method: "post",
                    data: { idlayout },
                    success: function (res) {
                        const data = JSON.parse(res)
                        if (data.status == 200) {
                            fetchData()
                            Toast.fire({
                                icon: 'success',
                                title: 'Xóa thành công'
                            })
                        }
                    }
                })
                : '';
        })
        $('#saveLayout').on('click', function () {
            var array = [];
            $.each($('#sortable tr'), function (index, value) {
                let dataId = $(value).find('.sorting_1 .idLayout').attr('data-id');
                array.push(dataId);
            })
            const data = array.toString();
            $.ajax({
                url: '{{ route('updataLayout') }}',
                method: 'post',
                data: { data },
                success: function (res) {
                    const data = JSON.parse(res)
                    if (data.status == 200) {
                        fetchData()
                        Toast.fire({
                            icon: 'success',
                            title: 'Lưu layout thành công'
                        })
                    }
                }
            })
        })

    })

</script>