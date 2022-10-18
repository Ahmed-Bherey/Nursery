@extends('admin.layouts.includes.master')
@section('title') المصروفات العامة @endsection
@section('content')
<script src="{{asset('public/select/jquery.min.js')}}"></script>
<!-- CSS forsearching -->
<link href="{{asset('public/select/select2.min.css')}}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{asset('public/select/select2.min.js')}}"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>المصروفات العامة
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{route('generalExpensese.store')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12 form-floating">
                                            <input required type="text" class="form-control" id="name"
                                                placeholder="الاسم" name="name">
                                            <label for="name"
                                                class="col-xxl-6 col-xl-8 col-lg-5 col-md-7 col-sm-4 col-form-label">اسم
                                                المصروف
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12 form-floating">
                                            <select required class="form-control js-example-basic-single d-flex"
                                                name="expensese_type" id="expensese_type">
                                                <option value="">اختر نوع المصروف</option>
                                                <option value="1">ثابت</option>
                                                <option value="2">متغير</option>
                                            </select>
                                            <label for="expensese_type" class="col-form-label">اختر نوع المصروف</label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12 form-floating">
                                            <input type="number" class="form-control" step="0.1" id="price"
                                                placeholder="المبلغ" name="price">
                                            <label for="price"
                                                class="col-xxl-4 col-xl-5 col-lg-4 col-md-6 col-sm-4 col-form-label">المبلغ
                                            </label>
                                        </div>
                                        <div class="form-check col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12 ">
                                            <label class="switch switch-2-5" for="switch-2-5">
                                                <input type="checkbox" value="1" checked name="active" id="switch-2-5">
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
                            <h3 class="card-title " style="float:right; font-weight:bold;">المصروفات العامة</h3>
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
                                                    <th>اسم المصروف</th>
                                                    <th>نوع المصروف</th>
                                                    <th>السعر</th>
                                                    <th>حالة التفعيل</th>
                                                    <th>عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($generalExpenseses as $key => $generalExpensese)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $generalExpensese->name }}</td>
                                                    <td>
                                                        @if($generalExpensese->expensese_type == 1)
                                                        ثابت
                                                        @else
                                                        متغير
                                                        @endif
                                                    </td>
                                                    <td>{{ $generalExpensese->price }}</td>
                                                    <td>
                                                        @if($generalExpensese->active == 0)
                                                        غير مفعل
                                                        @else
                                                        مفعل
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('generalExpensese.edit', $generalExpensese->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('generalExpensese.destroy', $generalExpensese->id) }}"
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
