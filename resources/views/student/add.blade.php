@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3>
                Hệ thống quản lý sinh viên
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h4 style="float: left">
                Nhập sinh viên mới
            </h4>
            <a href="<?php echo url('student') ?>" style="float: right"><h5>Trở về danh sách sinh viên</h5></a>
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
        <div class="col-md-4 col-md-offset-4">
            <form role="form" method="POST" action="<?php echo url('student/addstudent') ?>" id="add-form">
                <div class="form-group required">

                    <label for="student-code" class="control-label">
                        Mã sinh viên
                    </label>
                    <input type="text" class="form-control" id="student-code" name="student-code" required />
                    <div class="help-block with-errors"></div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group required">

                    <label for="student-name" class="control-label">
                        Họ tên
                    </label>
                    <input type="text" class="form-control" id="student-name" name="student-name" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group required">

                    <label for="student-dob" class="control-label">
                        Ngày sinh
                    </label>
                    <input type="date" class="form-control" id="student-dob" name="student-dob" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group required">

                    <label for="student-gender" class="control-label">
                        Giới tính
                    </label> <br>
                    <label><input type="radio" name="male" checked="checked">Nam</label>
                    <label><input type="radio" name="female">Nữ</label>
                </div>

                <div class="form-group required">

                    <label for="student-address" class="control-label">
                        Địa chỉ
                    </label>
                    <input type="text" class="form-control" id="student-address" name="student-address" required/>
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Nhập</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#add-form').validator({
            disable: true,
        });
    });
</script>
@endsection