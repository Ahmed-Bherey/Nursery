@extends('admin.layouts.includes.master')
@section('title')
تعديل اضافة موظف
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>اضافة موظف</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('employee.update', $employees->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-md-3 form-floating">
                                            <input required type="text" class="form-control"
                                                value="{{ $employees->name_ar }}" id="name_ar"
                                                placeholder="اسم الطفل باللغة العربية" name="name_ar">
                                            <label for="name_ar" class="col-sm-4 col-form-label">الاسم باللغة
                                                العربية
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="text" class="form-control" value="{{ $employees->name_en }}"
                                                id="name_en" placeholder="اسم الطفل باللغة الانجليزية" name="name_en">
                                            <label for="name_en" class="col-sm-4 col-form-label">الاسم باللغة
                                                الانجليزية
                                            </label>
                                        </div>
                                        <div required class="col-md-3 form-floating">
                                            <input type="number" class="form-control"
                                                value="{{ $employees->id_number }}" id="id_number"
                                                placeholder="الرقم القومى" pattern="[0-9]{14}" minlength="14"
                                                maxlength="14" name="id_number">
                                            <label for="id_number" class="col-sm-4 col-form-label">الرقم القومى
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input required type="text" class="form-control"
                                                value="{{ $employees->address }}" id="address" placeholder="العنوان"
                                                name="address">
                                            <label for="address" class="col-sm-4 col-form-label">العنوان
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input required type="number" class="form-control" id="tel"
                                                placeholder="تليفون الاب" name="tel1" pattern="[0-9]{11}">
                                            <label for="tel" class="col-sm-4 col-form-label">التليفون
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="number" class="form-control" id="tel" placeholder="تليفون الاب"
                                                name="tel2" pattern="[0-9]{11}">
                                            <label for="tel" class="col-sm-4 col-form-label">رقم اخر
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="text" class="form-control"
                                                value="{{ $employees->educational_qualification }}"
                                                id="educational_qualification" placeholder="المؤهل الدراسى"
                                                name="educational_qualification"
                                                pattern="^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$"
                                                title="يجب الا يحتوى على ارقام">
                                            <label for="educational_qualification"
                                                class="col-sm-4 col-form-label">المؤهل الدراسى
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="date" class="form-control"
                                                value="{{ $employees->graducation_date }}" id="graducation_date"
                                                placeholder="تاريخ التخرج" name="graducation_date">
                                            <label for="graducation_date" class="col-form-label">تاريخ التخرج
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="text" class="form-control"
                                                value="{{ $employees->employee_type }}" id="employee_type"
                                                placeholder="نوع الوظيفة" name="employee_type"
                                                pattern="^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$"
                                                title="يجب الا يحتوى على ارقام">
                                            <label for="employee_type" class="col-sm-4 col-form-label">نوع الوظيفة
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input required type="date" class="form-control"
                                                value="{{ $employees->hiring_date }}" id="hiring_date"
                                                placeholder="تاريخ التعيين" name="hiring_date">
                                            <label for="hiring_date" class="col-form-label">تاريخ التعيين </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input required type="number" class="form-control"
                                                value="{{ $employees->main_salary }}" id="main_salary" step="0.1"
                                                placeholder="المرتب الاساسى" name="main_salary">
                                            <label for="main_salary" class="col-sm-4 col-form-label">المرتب الاساسى
                                            </label>
                                        </div>
                                        <div class="form-check col-md-3">
                                            <label class="switch switch-2-5" for="switch-2-5">
                                                <input type="checkbox" name="insurance" value="1"
                                                    @if($employees->insurance ==
                                                1)
                                                checked @endif id="switch-2-5">
                                                <span class="slider round slider-2-5"></span>
                                            </label>
                                            <label class="form-check-label me-3" for="switch-2-5">
                                                حالة التأمين
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="date" class="form-control" id="insurance_date"
                                                placeholder="تاريخ التأمين" value="{{ $employees->insurance_date }}"
                                                name="insurance_date">
                                            <label for="insurance_date" class="col-form-label">تاريخ التأمين
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
                                        <i class="fa fa-arrow-left"></i> <a href="{{ route('employee.create') }}"></a>
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

<script>
    let state = document.getElementById('state-flexCheckDefault');
        let insurance_date = document.getElementById('insurance_date');
        let action = ''
        state.addEventListener("click", () => {
            if (state.checked === true) {
                insurance_date.setAttribute('required', '');
            } else {
                insurance_date.removeAttribute('required');
            }
        })
</script>
<!-- /.content-header -->
@endsection
