@extends('admin.layouts.includes.master')
@section('title') تعديل اضافة خزينة @endsection
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
                            <h3 class="card-title header-title">الخزائن</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('treasury.update' , $treasuries->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-3 form-floating">
                                        <input type="text" class="form-control" value="{{$treasuries->name}}"
                                            id="treasury" placeholder="اسم الخزينة" name="name">
                                        <label for="treasury" class="col-form-label">اسم الخزينة</label>
                                    </div>
                                    <div class="col-sm-3 form-floating">
                                        <input type="text" class="form-control"
                                            value="{{$treasuries->treasury_secretary}}" id="honest"
                                            placeholder="امين الخزينة" name="treasury_secretary">
                                        <label for="honest" class="col-form-label">امين الخزينة</label>
                                    </div>
                                    <div class="col-sm-3 form-floating">
                                        <input type="text" class="form-control" step="0.1"
                                            value="{{$treasuries->balance}}" id="value" placeholder="قيمة الخزينة"
                                            readonly name="balance">
                                        <label for="value" class="col-form-label">قيمة الخزينة</label>
                                    </div>
                                    <div class="form-check col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="1" name="active"
                                            @if($treasuries->active == 1) checked @endif
                                        id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
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
                                    <i class="fa fa-arrow-left"></i> <a href="{{route('treasury.create')}}"></a>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
@endsection
