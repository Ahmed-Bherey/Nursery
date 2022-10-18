@extends('admin.layouts.includes.master')
@section('title') تعديل تسجيل غياب واستأذان @endsection
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
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">تسجيل الغياب والاستئذان</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal"
                            action="{{ route('employeeAbcencePermission.update' , $employeeAbcencePermissions->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{$employeeAbcencePermissions->date}}" required>
                                        <label for="date" class="col-form-label">التاريخ</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control js-example-basic-single" name="type"
                                            id="type">
                                            <option value="">اختر النوع</option>
                                            <option value="1" @if($employeeAbcencePermissions->type == 1) selected
                                                @endif>غياب</option>
                                            <option value="2" @if($employeeAbcencePermissions->type == 2) selected
                                                @endif>استئذان</option>
                                        </select>
                                        <label for="type" class="col-form-label">اختر النوع</label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control drop" name="employee_id" id="employee_id">
                                            <option value="">اختر الموظف</option>
                                            @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" @if($employeeAbcencePermissions->
                                                employee_id == $employee->id) selected @endif>{{ $employee->name_ar }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="employee_id" class="col-form-label">اختر الموظف</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <textarea class="form-control" rows="1" id="note" placeholder="سبب الغياب ..."
                                            name="absence_reason">{{$employeeAbcencePermissions->absence_reason}}</textarea>
                                        <label for="note" class="col-form-label">السبب</label>
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
                                        href="{{route('employeeAbcencePermission.create')}}"></a>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="type"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('employeeAbcencePermission.treasuryAjax',['date'=>':date'])}}';
            route = route.replace(':id', stateID).replace(':date', $('input[name="date"]').val());
            if (stateID) {
                $.ajax({
                    beforeSend: function(x) {
                        return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                    },
                    url: route,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#employee_id').empty();
                        $.each(data, function(key, value) {
                            $('#employee_id').append($(`<option>`, {
                                value: value.id,
                                text: value.name_ar,
                            }));
                        });
                        $('#type').trigger('change');
                    }
                });
            } else {
                $('select[name="employee_id"]').empty();
            }
        });
        });
</script>
@endsection
