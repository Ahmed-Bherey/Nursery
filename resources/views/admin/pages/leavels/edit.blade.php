@extends('admin.layouts.includes.master')
@section('title') تعديل اضافة مرحلة @endsection
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
                            <h3 class="card-title header-title">اضافة مرحلة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('leavel.update', $leavel->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input type="text" class="form-control" value="{{$leavel->name}}" id="name"
                                            name="name" required>
                                        <label for="name" class="col-form-label">اسم المرحلة</label>
                                    </div>
                                    {{-- <div class="col-sm-4 form-floating">
                                        <input type="number" class="form-control" value="{{$leavel->value}}" id="name"
                                            name="value" required>
                                        <label for="value" class="col-form-label">قيمة المرحلة</label>
                                    </div> --}}
                                    <div class="col-sm-4 form-floating">
                                        <textarea class="form-control" rows="1" id="note" placeholder="ملاحظات"
                                            name="notes">{{$leavel->notes}}</textarea>
                                        <label for="note" class="col-form-label">ملاحظات</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary"   title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{route('leavel.create')}}"></a>
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
