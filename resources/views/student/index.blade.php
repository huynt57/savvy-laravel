@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Hệ thống quản lý sinh viên
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>
                    Danh sách sinh viên
                </h4>
            </div>
            <div class="col-md-6">
                <a href="<?php echo url('student/addstudent') ?>">
                    <button type="button" class="btn btn-primary" style="float: right">
                        Nhập sinh viên mới
                    </button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="float: left">
                <h5>
                    Đang xem <span id="number-curr">10</span>/<?php echo $records ?> sinh viên
                </h5>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="find-student" style="width: 370px; ">
                    
                </div>
            </div>
            <div class="col-md-2" >
                <div class="form-group">
                    
                    <button class="btn btn-default" id="search" style="float: right">Tìm</button>
                </div>
            </div>
        </div>
        <?php if (Session::get('message') != ""): ?>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="alert alert-success" role="alert">
                        <?php echo Session::get('message'); ?>
                    </div>

                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="student-info">
                    <thead>
                        <tr>
                            <th>
                                Mã sinh viên
                            </th>
                            <th>
                                Họ tên
                            </th>
                            <th>
                                Ngày sinh 
                            </th>
                            <th>
                                Giới tính
                            </th>
                            <th>
                                Địa chỉ
                            </th>
                            <th>
                                Hành động
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-student">
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td>
                                    <?php echo $student->student_code ?>
                                </td>
                                <td>
                                    <?php echo $student->name ?>
                                </td>
                                <td>
                                    <?php echo $student->dob ?>
                                </td>
                                <td>
                                    <?php echo $student->gender ?>
                                </td>
                                <td>
                                    <?php echo $student->address ?>
                                </td>
                                <td>
                                    <a href="<?php echo url('student/delete_edit?id=' . $student->id) ?>">Sửa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="col-lg-6 col-lg-offset-6">
                    <ul class="pagination" style="float: right">
                        <li id="previous"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>

                        <?php 
                        $page = 0;
                        if($records % 2 == 0) $page = $records / 2;
                        else $page = $records / 2 + 1;
                        for ($i = 1; $i <= $page; $i++): ?>

                            <li curr = "<?php echo $i - 1 ?>" id="page-<?php echo $i ?>"><a href="javascript:void(0)" onclick="paginate(<?php echo $i - 1 ?>, <?php echo $records ?>)"><?php echo $i ?> <span class="sr-only" >(current)</span></a></li>

                        <?php endfor; ?>
                        <li id="next"><a href="#" aria-label="Next"><span aria-hidden="true">&#187;</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        var total = <?php echo $records ?>;
        total = parseInt(total);
        $('#number-curr').html(2);
        $('#page-1').addClass('active');
        $('#previous').click(function() {
            var num = $('.pagination').find('li[class="active"]').attr('curr');
            console.log(num);
            if (num - 1 > -1) {
                paginate(num - 1, total);
            }
        });

        $('#next').click(function() {
            var num = $('.pagination').find('li[class="active"]').attr('curr');
            num = parseInt(num);
            if (num + 1 < (total / 2)) {
                paginate(num + 1, total);
            }
        });



        $('#search').click(function() {
            var query = $('#find-student').val();
            $.ajax({
                beforeSend: function() {
                    $('#table-student').html('<img style = "margin: 0 auto"src = "<?php echo url() . '/images/ajax-loader.gif' ?>" />');
                },
                type: 'POST',
                url: 'student/search',
                data: {query: query},
                dataType: 'json',
                success: function(response) {
                    $('#table-student').empty();
                    $('#table-student').html("Không có dữ liệu");
                    if (response.length > 0) {
                        $('#table-student').empty();
                        var i;
                        for (i = 0; i < response.length; i++)
                        {
                            $('#table-student').append(
                                    '<tr><td>' +
                                    response[i].student_code
                                    + '</td>' +
                                    '<td>' +
                                    response[i].name
                                    + '</td>' +
                                    '<td>' +
                                    response[i].dob
                                    + '</td>' +
                                    '<td>' +
                                    response[i].gender
                                    + '</td>' +
                                    '<td>' +
                                    response[i].address
                                    + '</td>' +
                                    '<td>' +
                                    '<a href="<?php echo url('student/delete_edit?id=') ?>' + response[i].id + '">Sửa</a>' +
                                    '</td>' +
                                    '</tr>'
                                    );
                        }
                    } else {

                    }
                }
            });
        })
    });
    function paginate(num, total) {
        num = parseInt(num);
        id = num + 1;
        if (id * 2 < total) {
            $('#number-curr').html(id * 2);
        } else {
            $('#number-curr').html(total);
        }
        $('.pagination').find('li').removeClass('active');
        $('#page-' + id).addClass('active');
        $.ajax({
            beforeSend: function() {
                $('#table-student').html('<img style = "margin: 0 auto"src = "<?php echo url() . '/images/ajax-loader.gif' ?>" />');
            },
            type: 'POST',
            url: 'student/paginate',
            data: {current: num},
            dataType: 'json',
            success: function(response) {
                $('#table-student').empty();
                var i;
                for (i = 0; i < response.length; i++)
                {
                    $('#table-student').append(
                            '<tr><td>' +
                            response[i].student_code
                            + '</td>' +
                            '<td>' +
                            response[i].name
                            + '</td>' +
                            '<td>' +
                            response[i].dob
                            + '</td>' +
                            '<td>' +
                            response[i].gender
                            + '</td>' +
                            '<td>' +
                            response[i].address
                            + '</td>' +
                            '<td>' +
                            '<a href="<?php echo url('student/delete_edit?id=') ?>' + response[i].id + '">Sửa</a>' +
                            '</td>' +
                            '</tr>'
                            );
                }
            }
        });
    }
</script>
@endsection
