@extends('admin.layouts.includes.master')
@section('title')
    تعديل اضافة مديونية لمرحلة
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
                {{-- {{-- start card --}}
                <div class="row mt-1">
                    <div class="col-sm-12 col-lg-12 ">
                        <div class="card">
                            <div class="card-header header-bg">
                                <h3 class="card-title header-title">تعديل مديونيه لمرحله </h3>

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('admin.layouts.alerts.success')
                            @include('admin.layouts.alerts.error')
                            <form class="form-horizontal"
                                action="{{ route('IndebtednessLevels.update', $IndebtednessLevel->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-4 form-floating mt-3">
                                            <input type="text" class="form-control" id="date" placeholder=""
                                                name="name" readonly required
                                                value="{{ $IndebtednessLevel->childs->name_ar }}">
                                            <label for="date" class="col-form-label"> اسم الطفل </label>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 form-floating mt-3">
                                            <input type="text" class="form-control" id="date" placeholder=""
                                                name="name" readonly value="{{ $IndebtednessLevel->name }}" required>
                                            <label for="date" class="col-form-label"> الاسم </label>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-4 form-floating mt-3">
                                            <select required class="form-control" name="level_id" disabled id="level_id">
                                                @foreach ($levels as $key => $level)
                                                    <option value="{{ $level->id }}"
                                                        @if ($IndebtednessLevel->level_id == $IndebtednessLevel->level_id) selected @endif>
                                                        {{ $level->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="namestore" class="col-form-label"> اختر المرحله
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4 form-floating mt-3">
                                            <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="note" id="n">{{ $IndebtednessLevel->note }}</textarea>
                                            <label for="n" class=" col-form-label"> ملاحظات </label>
                                        </div>
                                        <div class="col-md-4 form-floating mt-3">
                                            <input type="number" class="form-control" step="0.1" id="pay"
                                                value="{{ $IndebtednessLevel->amount }}" name="amount" readonly>
                                            <label for="pay" class="col-form-label">الاجمالى</label>
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
                                            href="{{ route('IndebtednessLevels.create') }}"></a>
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
