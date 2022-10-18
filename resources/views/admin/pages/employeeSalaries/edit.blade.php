@extends('admin.layouts.includes.master')
@section('title') تعديل صرف رواتب الموظفين @endsection
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
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>صرف رواتب الموظفين
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal"
                            action="{{route('employeeSalary.update' , $employeeSalaries->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div class="col-md-3 form-floating">
                                            <input type="date" class="form-control" value="{{$employeeSalaries->date}}"
                                                id="date" name="date">
                                            <label for="date" class="col-form-label">تاريخ الصرف</label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="employee_id" id="employee_id">
                                                <option value="">اختر اسم الموظف</option>
                                                @foreach($employees as $key => $employee)
                                                <option value="{{$employee->id}}" @if($employeeSalaries->employee_id ==
                                                    $employee->id) selected @endif>{{$employee->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="employee_id" class="col-form-label">اختر نوع المصروف</label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <select required class="form-control" name="treasury_id" id="treasury_id">
                                                <option value="">اختر اسم الخزينة</option>
                                                @foreach($treasuries as $key => $treasury)
                                                <option value="{{$treasury->id}}" @if($employeeSalaries->treasury_id ==
                                                    $treasury->id)selected @endif>{{$treasury->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="treasury_id" class="col-form-label">اختر نوع الخزينة</label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input required type="number" class="form-control"
                                                value="{{$employeeSalaries->main_salary}}" step="0.1" id="main_salary"
                                                readonly placeholder="المرتب الاساسى" name="main_salary">
                                            <label for="main_salary" class="col-sm-4 col-form-label">المرتب الاساسى
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input required type="text" class="form-control"
                                                value="{{$employeeSalaries->job_type}}" id="job_type" readonly
                                                placeholder="نوع الوظيفة" name="job_type">
                                            <label for="job_type" class="col-sm-4 col-form-label">نوع الوظيفة
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="number" class="form-control"
                                                value="{{$employeeSalaries->reward}}" step="0.1" id="reward"
                                                placeholder="المكافأة" name="reward">
                                            <label for="reward" class="col-sm-4 col-form-label">المكافأة
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <textarea class="form-control" rows="1" id="note" placeholder="سبب المكافأة"
                                                name="reward_reason">{{$employeeSalaries->reward_reason}}</textarea>
                                            <label for="note" class="col-form-label">سبب المكافأة</label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="number" class="form-control"
                                                value="{{$employeeSalaries->absent_day}}" step="0.1" id="absent_day"
                                                placeholder="عدد ايام الغياب" name="absent_day">
                                            <label for="absent_day" class="col-sm-4 col-form-label">عدد ايام الغياب
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="number" class="form-control"
                                                value="{{$employeeSalaries->discount}}" step="0.1" id="discount"
                                                placeholder="الخصم" name="discount">
                                            <label for="discount" class="col-sm-4 col-form-label">الخصم
                                            </label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input required type="number" class="form-control"
                                                value="{{$employeeSalaries->total_salary}}" step="0.1" id="total_salary"
                                                readonly placeholder="اجمالى الراتب" name="total_salary">
                                            <label for="total_salary" class="col-sm-4 col-form-label">اجمالى الراتب
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
                                            href="{{route('employeeSalary.create')}}"></a>
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
