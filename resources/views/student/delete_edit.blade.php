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
                Sửa thông tin sinh viên
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
            <form role="form" method="post" action="<?php echo url('student/edit') ?>" id="edit-form">

                <div class="form-group">

                    <label for="student-code">
                        Mã sinh viên
                    </label>
                    <input type="text" class="form-control" id="student-code" name="student-code"  value="<?php echo $student->student_code ?>" required="" readonly="readonly"/>
                    <div class="help-block with-errors"></div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="<?php echo $student->id ?>">
                <div class="form-group required">

                    <label for="student-name" class="control-label">
                        Họ tên
                    </label>
                    <input type="text" class="form-control" id="student-name" name="student-name" value="<?php echo $student->name ?>" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group required">

                    <label for="student-dob" class="control-label">
                        Ngày sinh
                    </label>
                    <input type="date" class="form-control" id="student-dob" name="student-dob" value="<?php echo $student->dob ?>" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group required">

                    <label for="student-gender" class="control-label">
                        Giới tính
                    </label> <br>
                    
                        <label><input type="radio" name="gender" value="male" <?php if ($student->gender == "Nam") echo 'checked="checked"' ?> >Nam</label>
                        <label><input type="radio" name="gender" value="female"<?php if ($student->gender == "Nữ") echo 'checked="checked"' ?>>Nữ</label>
                   

                </div>
                <div class="radio">

                </div>
                <div class="form-group required">

                    <label for="student-address" class="control-label">
                        Địa chỉ
                    </label>
                   <input type="text" class="form-control" id="student-address" name="student-address" value="<?php echo $student->address ?>" required/>
                    <div class="help-block with-errors"></div>
                </div>


                <button type="submit" class="btn btn-default" name="type" value="delete"  onclick="if(!confirm('Bạn có chắc chắn muốn xóa sinh viên: Mã sinh viên: <?php 
                echo $student->student_code?>, Họ tên: <?php echo $student->name ?> ??')){return false;}">
                    Xóa
                </button>
                <button type="submit" class="btn btn-default" style="float: right" name="type" value="edit">
                    Sửa
                </button>

            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#edit-form').validator({
            disable: true,
        });
    });
</script>
@endsection