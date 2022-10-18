@extends('admin.layouts.includes.master')
@section('title')
تعديل اضافة سنة الدراسية
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">السنة الدراسية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal"
                            action="{{ route('educationalYear.update', $educationalYears->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-3 form-floating">
                                        <input type="text" class="form-control" value="{{ $educationalYears->name }}"
                                            id="name" name="name" required>
                                        <label for="name" class="col-form-label">الاسم</label>
                                    </div>
                                    <div class="col-sm-3 form-floating">
                                        <input type="date" class="form-control mb-3"
                                            value="{{ $educationalYears->dateFrom }}" id="dateFrom"
                                            placeholder="التاريخ" name="dateFrom" required>
                                        <label for="dateFrom" class="col-form-label">من</label>
                                    </div>
                                    <div class="col-sm-3 form-floating">
                                        <input type="date" class="form-control mb-3"
                                            value="{{ $educationalYears->dateTo }}" id="dateTo" placeholder="التاريخ"
                                            name="dateTo">
                                        <label for="dateTo" class="col-form-label">الى</label>
                                    </div>
                                    <div class="form-check col-sm-3">
                                        <label class="switch switch-2-5" for="switch-2-5">
                                            <input type="checkbox" name="active" value="1" @if($educationalYears->active
                                            ==
                                            1)
                                            checked @endif id="switch-2-5">
                                            <span class="slider round slider-2-5"></span>
                                        </label>
                                        <label class="form-check-label" for="switch-2-5">
                                            تفعيل
                                        </label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" title="back">
                                    <i class="fa fa-arrow-left"></i> <a
                                        href="{{ route('educationalYear.create') }}"></a>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
