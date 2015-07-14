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
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form role="form" method="POST" action="<?php echo url('student/addstudent') ?>">

                <div class="form-group">

                    <label for="student-code">
                        Mã sinh viên
                    </label>
                    <input type="text" class="form-control" id="student-code" name="student-code"  value="<?php echo $student->student_code ?>"/>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">

                    <label for="student-name">
                        Họ tên
                    </label>
                    <input type="text" class="form-control" id="student-name" name="student-name" value="<?php echo $student->name ?>"/>
                </div>
                <div class="form-group">

                    <label for="student-dob">
                        Ngày sinh
                    </label>
                    <input type="date" class="form-control" id="student-dob" name="student-dob" value="<?php echo $student->dob ?>"/>
                </div>
                <div class="form-group">

                    <label for="student-gender">
                        Giới tính
                    </label> <br>
                    <label><input type="radio" name="male" <?php if ($student->gender == "Nam") echo 'checked="checked"' ?> >Nam</label>
                    <label><input type="radio" name="female" <?php if ($student->gender == "Nữ") echo 'checked="checked"' ?>>Nữ</label>
                </div>
                <div class="radio">

                </div>
                <div class="form-group">

                    <label for="student-address">
                        Địa chỉ
                    </label>
                    <input type="text" class="form-control" id="student-address" name="student-address" value="<?php echo $student->address ?>" />
                </div>


                <button type="submit" class="btn btn-default">
                    Xóa
                </button>
                <button type="submit" class="btn btn-default" style="float: right">
                    Sửa
                </button>

            </form>
        </div>
    </div>
</div>
@endsection