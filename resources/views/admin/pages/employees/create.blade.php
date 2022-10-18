@extends('admin.layouts.includes.master')
@section('title')
اضافة موظف
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
                        <form class="form-horizontal" action="{{ route('employee.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="text" class="form-control" id="name_ar"
                                                placeholder="اسم الطفل باللغة العربية" name="name_ar">
                                            <label for="name_ar" class=" col-form-label me-3 ">الاسم باللغة
                                                العربية
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input type="text" class="form-control" id="name_en"
                                                placeholder="اسم الطفل باللغة الانجليزية" name="name_en">
                                            <label for="name_en" class=" col-form-label me-3">الاسم باللغة
                                                الانجليزية
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="number" class="form-control" id="id_number"
                                                placeholder="الرقم القومى" name="id_number" pattern="[0-9]{14}">
                                            <label for="id_number" class=" col-form-label  me-3">الرقم القومى
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="text" class="form-control" id="address"
                                                placeholder="العنوان" name="address">
                                            <label for="address" class=" col-form-label  me-3">العنوان
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="text" class="form-control" id="tel"
                                                placeholder="تليفون الاب" name="tel1" pattern="[0-9]{11}"
                                                title="رقم التليفون يجب ان يكون 11 رقم">
                                            <label for="tel" class=" col-form-label  me-3">التليفون

                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input type="number" class="form-control" id="tel" placeholder="تليفون الاب"
                                                name="tel2" pattern="[0-9]{11}">
                                            <label for="tel" class=" col-form-label me-3">رقم اخر
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="text" class="form-control "
                                                id="educational_qualification" placeholder="المؤهل الدراسى"
                                                name="educational_qualification"
                                                pattern="^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$"
                                                title="يجب الا يحتوى على ارقام">
                                            <label for="educational_qualification" class=" col-form-label me-3">المؤهل
                                                الدراسى
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input type="date" class="form-control" id="graducation_date"
                                                placeholder="تاريخ التخرج" name="graducation_date">
                                            <label for="graducation_date" class="col-form-label me-3">تاريخ التخرج
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="text" class="form-control" id="employee_type"
                                                placeholder="نوع الوظيفة" name="employee_type"
                                                pattern="^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-\s_]*$"
                                                title="يجب الا يحتوى على ارقام">
                                            <label for="employee_type" class=" col-form-label me-3">نوع
                                                الوظيفة
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="date" class="form-control" id="hiring_date"
                                                name="hiring_date">
                                            <label for="hiring_date" class="col-form-label me-3">تاريخ التعيين
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input required type="number" class="form-control" id="main_salary"
                                                placeholder="المرتب الاساسى" name="main_salary" step="0.1">
                                            <label for="main_salary" class=" col-form-label me-3">المرتب
                                                الاساسى
                                            </label>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-6  form-floating">
                                            <input type="date" class="form-control" id="insurance_date"
                                                placeholder="تاريخ التأمين" name="insurance_date">
                                            <label for="insurance_date" class="col-form-label me-3">تاريخ التأمين
                                            </label>
                                        </div>
                                        <div class=" col-xl-3 col-lg-4 col-md-6 d-flex">
                                            <label class="switch switch-2-5" for="switch-2-5">
                                                <input type="checkbox" value="1" class="state-flexCheckDefault" name="insurance"
                                                    id="switch-2-5">
                                                <span class="slider round slider-2-5"></span>
                                            </label>
                                            <label class="form-check-label me-3" for="switch-2-5">
                                                حالة التأمين
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
                            <h3 class="card-title " style="float:right; font-weight:bold;">اضافة موظف</h3>
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
                                                    <th>الاسم باللغة العربية</th>
                                                    <th>الاسم باللغة الانجليزية</th>
                                                    <th>الرقم القومي</th>
                                                    <th>العنوان</th>
                                                    <th>رقم الهاتف</th>
                                                    <th>المؤهل الدراسى</th>
                                                    <th>تاريخ التخرج</th>
                                                    <th>نوع الوظيفة</th>
                                                    <th>تاريخ التعيين</th>
                                                    <th>المرتب الاساسى</th>
                                                    <th>التأمين</th>
                                                    <th>عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $key => $employee)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $employee->name_ar }}</td>
                                                    <td>{{ $employee->name_en }}</td>
                                                    <td>{{ $employee->id_number }}</td>
                                                    <td>{{ $employee->address }}</td>
                                                    <td>{{ $employee->tel1 }}</td>
                                                    <td>{{ $employee->educational_qualification }}</td>
                                                    <td>{{ $employee->graducation_date }}</td>
                                                    <td>{{ $employee->employee_type }}</td>
                                                    <td>{{ $employee->hiring_date }}</td>
                                                    <td>{{ $employee->main_salary }}</td>
                                                    <td>
                                                        @if ($employee->insurance == 0)
                                                        غير مؤمن
                                                        @else
                                                        مؤمن
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('employee.edit', $employee->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('employee.destroy', $employee->id) }}"
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

<script>
    let state = document.getElementsByClassName('state-flexCheckDefault');
        let flexSwitchCheckDefault = document.getElementById('flexSwitchCheckDefault');
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
