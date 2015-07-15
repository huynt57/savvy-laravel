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
            <?php if(Session::get('message') != ""):?>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="alert alert-success" role="alert">
                        <?php echo Session::get('message'); ?>
                    </div>

                </div>
            </div>
            <?php endif;?>
        </div>
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
                    <tbody>
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
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('#student-info').DataTable();
    });
</script>
@endsection
