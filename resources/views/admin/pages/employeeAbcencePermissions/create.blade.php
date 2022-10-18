@extends('admin.layouts.includes.master')
@section('title') تسجيل غياب واستأذان @endsection
@section('content')
{{-- <script src="https://code.jquery.com/jquery-3.6.1.js"
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> --}}
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
                        <form class="form-horizontal" action="{{ route('employeeAbcencePermission.store') }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-md-6 form-floating mb-3">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{date('Y-m-d')}}" required>
                                        <label for="date" class="col-form-label n_right2">التاريخ </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="type"
                                            id="type">
                                            <option value="">اختر النوع</option>
                                            <option value="1">غياب</option>
                                            <option value="2">استئذان</option>
                                        </select>
                                        <label for="type" class="col-form-label n_right2">اختر النوع</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating mb-3">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="data[employee_id][]" id="employee_id" multiple>
                                            <option value="">اختر الموظف</option>
                                            {{-- @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name_ar }}
                                            </option>
                                            @endforeach --}}
                                        </select>
                                        <label for="employee_id" class="col-form-label n_right2">اختر الموظف</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 form-floating">
                                        <textarea class="form-control" rows="1" id="note" placeholder="سبب الغياب ..."
                                            name="absence_reason"></textarea>
                                        <label for="note" class="col-form-label n_right2">السبب</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" type="reset">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
            {{-- end card --}}
            {{-- start card table --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">تسجيل الغياب والاستئذان</h3>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        التاريخ </th>
                                                    <td>النوع</td>
                                                    <td>الموظف</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        سبب الغياب</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employeeAbcencePermissions as $key =>
                                                $employeeAbcencePermission)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$employeeAbcencePermission->date}}</td>
                                                    <td>{{$employeeAbcencePermission->employees->name_ar}}</td>
                                                    <td>
                                                        @if($employeeAbcencePermission->type == 1)
                                                        غياب
                                                        @else
                                                        استئذان
                                                        @endif
                                                    </td>
                                                    <td>{{$employeeAbcencePermission->absence_reason}}</td>
                                                    <td>
                                                        <a href="{{ route('employeeAbcencePermission.edit', $employeeAbcencePermission->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('employeeAbcencePermission.destroy', $employeeAbcencePermission->id) }}"
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
                            <!-- /.content-header -->
                        </div>
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
                        $('#employee_id').trigger('change');
                    }
                });
            } else {
                $('select[name="employee_id"]').empty();
            }
        });
        });
</script>
@endsection
