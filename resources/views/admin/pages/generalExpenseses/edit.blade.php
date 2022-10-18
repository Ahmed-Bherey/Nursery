@extends('admin.layouts.includes.master')
@section('title')
تعديل المصروفات العامة
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
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>المصروفات العامة
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal"
                            action="{{ route('generalExpensese.update', $generalExpenseses->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-md-3 form-floating">
                                            <input required type="text" class="form-control"
                                                value="{{ $generalExpenseses->name }}" id="name" placeholder="الاسم"
                                                name="name">
                                            <label for="name" class="col-sm-3 col-form-label">اسم المصروف
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="expensese_type" id="expensese_type">
                                                <option value="">اختر نوع المصروف</option>
                                                <option value="1" @if ($generalExpenseses->expensese_type == 1) selected
                                                    @endif>ثابت</option>
                                                <option value="2" @if ($generalExpenseses->expensese_type == 2) selected
                                                    @endif>متغير</option>
                                            </select>
                                            <label for="expensese_type" class="col-form-label">اختر نوع المصروف</label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="number" class="form-control"
                                                value="{{ $generalExpenseses->price }}" step="0.1" id="price"
                                                placeholder="المبلغ" name="price">
                                            <label for="price" class="col-md-3 col-form-label">المبلغ
                                            </label>
                                        </div>
                                        <div class="form-check col-md-3">
                                            <label class="switch switch-2-5" for="switch-2-5">
                                                <input type="checkbox" name="active" value="1"
                                                    @if($generalExpenseses->active ==
                                                1)
                                                checked @endif id="switch-2-5">
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
                                        <i class="fa fa-arrow-left"></i> <a
                                            href="{{ route('generalExpensese.create') }}"></a>
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
