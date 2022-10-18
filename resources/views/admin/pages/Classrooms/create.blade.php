@extends('admin.layouts.includes.master')
@section('title')
اضافة قاعة
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
                        <form class="form-horizontal" action="{{ route('classroom.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-lg-4 col-md-6  form-floating">
                                            <input type="text" class="form-control" id="name" placeholder="الاسم"
                                                required name="name">
                                            <label for="name"
                                                class="col-sm-4 col-form-labelcol-xxl-5 col-xl-5 col-lg-7 col-md-8 col-12 col-form-label n_right2">اسم
                                                القاعة
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6  form-floating d-flex">
                                            <select required class="form-control js-example-basic-single"
                                                name="level_id" id="level_id" class="w-100">
                                                <option value="">اختر المرحلة</option>
                                                @foreach ($levels as $key => $level)
                                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="name" class=" col-form-label">اسم المرحلة
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6  form-floating">
                                            <input required type="number" class="form-control" id="student_count"
                                                placeholder="عدد الطلاب" name="student_count">
                                            <label for="student_count"
                                                class="col-sm-4 col-form-labelcol-xxl-5 col-xl-5 col-lg-7 col-md-8 col-12 col-form-label n_right2">عدد
                                                الطلاب
                                            </label>
                                        </div>
                                        <div class="col-lg-4 col-md-6  form-floating">
                                            <textarea class="form-control" rows="1" id="notes" placeholder="ملاحظات ..."
                                                name="notes"></textarea>
                                            <label for="notes"
                                                class="col-sm-4 col-form-labelcol-xxl-5 col-xl-5 col-lg-7 col-md-8 col-12 col-form-label n_right2">ملاحظات</label>
                                        </div>
                                        <div class=" col-lg-4 col-md-6 ">
                                            <label class="switch switch-2-5" for="switch-2-5">
                                                <input type="checkbox" value="1" name="active"
                                                    id="switch-2-5" checked>
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
                                    <button type="reset" class="btn bg-secondary">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card border border-1 mt-3 bg-light">
                        <div class="card-header">
                            <h3 class="card-title " style="float:right; font-weight:bold;">اضافة قاعة</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <th>اسم القاعة</th>
                                                    <th>اسم المرحلة</th>
                                                    <th>عدد الطلاب</th>
                                                    <th>حالة التفعيل</th>
                                                    <th>ملاحظات</th>
                                                    <th>عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($classrooms as $key => $classroom)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $classroom->name }}</td>
                                                    <td>{{ $classroom->levels->name }}</td>
                                                    <td>{{ $classroom->student_count }}</td>
                                                    <td>
                                                        @if ($classroom->active == 0)
                                                        غير مفعل
                                                        @else
                                                        مفعل
                                                        @endif
                                                    </td>
                                                    <td>{{ $classroom->notes }}</td>
                                                    <td>
                                                        <a href="{{ route('classroom.edit', $classroom->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('classroom.destroy', $classroom->id) }}"
                                                            type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<!-- /.content-header -->
@endsection
