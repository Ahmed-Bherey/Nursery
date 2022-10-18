@extends('admin.layouts.includes.master')
@section('title')
تعديل اضافة قاعة
@endsection
@section('content')
<script src="{{ asset('public/select/jquery.min.js') }}"></script>
<!-- CSS forsearching -->
<link href="{{ asset('public/select/select2.min.css') }}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{ asset('public/select/select2.min.js') }}"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>اضافة قاعة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('classroom.update', $classrooms->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-md-4 form-floating">
                                            <input type="text" class="form-control" value="{{ $classrooms->name }}"
                                                id="name" placeholder="الاسم" name="name">
                                            <label for="name" class="col-sm-4 col-form-label">اسم القاعة
                                            </label>
                                        </div>
                                        <div class="col-md-4 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="level_id" id="level_id">
                                                <option value="">اختر المرحلة</option>
                                                @foreach ($levels as $key => $level)
                                                <option value="{{ $level->id }}" @if ($classrooms->level_id ==
                                                    $level->id) selected @endif>
                                                    {{ $level->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="name" class="col-sm-4 col-form-label">اسم المرحلة
                                            </label>
                                        </div>
                                        <div class="col-md-4 form-floating">
                                            <input required type="number" class="form-control"
                                                value="{{ $classrooms->student_count }}" id="student_count"
                                                placeholder="عدد الطلاب" name="student_count">
                                            <label for="student_count" class="col-sm-4  col-form-label">عدد الطلاب
                                            </label>
                                        </div>
                                        <div class="col-sm-4 mt-3 form-floating">
                                            <textarea class="form-control" rows="1" id="notes" placeholder="ملاحظات ..."
                                                name="notes">{{ $classrooms->notes }}</textarea>
                                            <label for="notes" class=" col-form-label">ملاحظات</label>
                                        </div>
                                        <div class="col-sm-4 mt-3 d-flex">
                                            <label class="switch switch-2-5" for="switch-2-5">
                                                <input type="checkbox" value="1" @if($classrooms->active ==
                                                1)
                                                checked @endif
                                                name="active" id="switch-2-5">
                                                <span class="slider round slider-2-5"></span>
                                            </label>
                                            <label class="form-check-label" for="switch-2-5">
                                                تفعيل
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-success-2 mr-3">
                                        <i class="fa fa-check text-light" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn bg-secondary" title="back">
                                        <i class="fa fa-arrow-left"></i> <a href="{{ route('classroom.create') }}"></a>
                                    </button>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
