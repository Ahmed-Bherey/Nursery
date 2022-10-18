@extends('admin.layouts.includes.master')
@section('title')
صرف رواتب الموظفين
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
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>صرف رواتب الموظفين
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('employeeSalary.create') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                                id="date" name="date">
                                            <label for="date" class="col-form-label me-3">تاريخ الصرف</label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="employee_id" id="employee_id">
                                                <option value="">اختر اسم الموظف</option>
                                                @foreach ($employees as $key => $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name_ar }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <label for="employee_id" class="col-form-label me-3"> اسم الموظف
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="treasury_id" id="treasury_id">
                                                <option value="">اختر اسم الخزينة</option>
                                                @foreach ($treasuries as $key => $treasury)
                                                <option value="{{ $treasury->id }}">{{ $treasury->name }}&nbsp; الرصيد:
                                                    ({{$treasury->balance}}) </option>
                                                @endforeach
                                            </select>
                                            <label for="treasury_id" class="col-form-label ">اختر نوع الخزينة</label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <input required type="number" class="form-control main_salary" step="0.1"
                                                readonly id="main_salary" placeholder="المرتب الاساسى"
                                                name="main_salary">
                                            <label for="main_salary" class="col-form-label me-3">المرتب الاساسى
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <input required type="text" class="form-control" id="job_type" readonly
                                                placeholder="نوع الوظيفة" name="job_type">
                                            <label for="job_type" class="col-form-label me-3">نوع الوظيفة
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <input type="number" class="form-control reward" step="0.1" id="reward"
                                                placeholder="المكافأة" name="reward">
                                            <label for="reward" class="col-form-label me-3">المكافأة
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <textarea class="form-control" rows="1" id="note" placeholder="سبب المكافأة"
                                                name="reward_reason"></textarea>
                                            <label for="note" class="col-form-label me-3">سبب المكافأة</label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <input type="number" class="form-control" step="0.1" id="absent_day"
                                                placeholder="عدد ايام الغياب" name="absent_day">
                                            <label for="absent_day" class="col-form-label me-3">عدد ايام الغياب
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <input type="number" class="form-control discount" step="0.1" id="discount"
                                                placeholder="الخصم" name="discount">
                                            <label for="discount" class="col-form-label me-3">الخصم
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg4 col-md-6 col-12 form-floating">
                                            <input required type="number" class="form-control total_salary" step="0.1"
                                                readonly id="total_salary" placeholder="اجمالى الراتب"
                                                name="total_salary">
                                            <label for="total_salary" class="col-form-label me-3">اجمالى الراتب
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
                                                    <td>تاريخ الصرف</td>
                                                    <td>اسم الموظف</td>
                                                    <td>المرتب الاساسى</td>
                                                    <td>نوع الوظيفة</td>
                                                    <td>المكافئة</td>
                                                    <td>سبب المكافئة</td>
                                                    <td>عدد ايام الغياب</td>
                                                    <td>الخصم</td>
                                                    <td>اجمالي الراتب</td>
                                                    <th>عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employeeSalaries as $key => $employeeSalary)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $employeeSalary->date }}</td>
                                                    <td>{{ $employeeSalary->employees->name_ar }}</td>
                                                    <td>{{ $employeeSalary->main_salary }}</td>
                                                    <td>{{ $employeeSalary->job_type }}</td>
                                                    <td>{{ $employeeSalary->reward }}</td>
                                                    <td>{{ $employeeSalary->reward_reason }}</td>
                                                    <td>{{ $employeeSalary->absent_day }}</td>
                                                    <td>{{ $employeeSalary->discount }}</td>
                                                    <td>{{ $employeeSalary->total_salary }}</td>
                                                    <td>
                                                        <a href="{{ route('employeeSalary.edit', $employeeSalary->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('employeeSalary.destroy', $employeeSalary->id) }}"
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
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="employee_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('employeeSalary.Ajax', ['id' => ':id']) }}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#main_salary').empty();
                            $('#main_salary').val(data);
                            $('#main_salary').trigger('change');
                        }
                    });
                } else {
                    $('select[name="main_salary"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="employee_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('employeeSalary.Ajax', ['id' => ':id']) }}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#total_salary').empty();
                            $('#total_salary').val(data);
                            $('#total_salary').trigger('change');
                        }
                    });
                } else {
                    $('select[name="total_salary"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="employee_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('employeeJobAjax.Ajax', ['id' => ':id']) }}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#job_type').empty();
                            $('#job_type').val(data);
                            $('#job_type').trigger('change');
                        }
                    });
                } else {
                    $('select[name="employee_id"]').empty();
                }
            });
        });
</script>

<script>
    let main_salary = document.querySelector('.main_salary'),
            discount = document.querySelector('.discount'),
            reward = document.querySelector('.reward'),
            total_salary = document.querySelector('.total_salary');
        main_salary.addEventListener('keyup', calculate)
        discount.addEventListener('keyup', calculate)
        reward.addEventListener('keyup', calculate)

        function calculate (){
            total_salary.value = main_salary.value * 1 + reward.value * 1 - discount.value * 1
        }
</script>
@endsection
