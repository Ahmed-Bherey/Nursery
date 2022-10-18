@extends('admin.layouts.includes.master')
@section('title') تسجيل طفل @endsection
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
                    <div class="card card-info">
                        <div class="card-header header-bg">
                            <h3 class="card-title" style="float: right">تسجيل طفل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form action="{{ route('childRegistration.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class=" col-lg-4 col-md-6 col-sm-6 form-floating mb-3">
                                        <input required type="date" class="form-control" id="registration_date"
                                            value="{{ date('Y-m-d') }}" name="registration_date">
                                        <label for="registration_date" class="col-form-label">تاريخ التسجيل
                                        </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 form-floating mb-3">
                                        <input required type="date" class="form-control" id="acceptance_date"
                                            name="acceptance_date" value="{{ date('Y-m-d') }}">
                                        <label for="acceptance_date" class="col-form-label n_right">تاريخ القبول
                                        </label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="child_id"
                                            id="child_id">
                                            <option value="">اختر الطفل</option>
                                            @foreach($children as $key => $child)
                                            <option value="{{$child->id}}">{{$child->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        <label for="child_id" class="col-form-label">اختر الطفل</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 form-floating mb-3">
                                        <input type="text" readonly class="form-control" id="born_date"
                                            name="born_date">
                                        <label for="born_date" class="c col-form-label">تاريخ
                                            الميلاد
                                        </label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <input type="text" class="form-control" step="0.1" id="age" name="age" readonly>
                                        <label for="age" class="col-form-label">السن عند القبول</label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <input type="text" class="form-control" id="gender" name="gender" readonly>
                                        <label for="gender" class="col-form-label">النوع</label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <input type="text" class="form-control" step="0.1" id="city" name="city"
                                            readonly>
                                        <label for="city" class="col-form-label">محل الميلاد</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="level_id"
                                            id="student_level">
                                            <option value="">اختر المرحلة</option>
                                            @foreach($leavels as $key => $leavel)
                                            <option value="{{$leavel->id}}">{{$leavel->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="student_level" class="col-form-label">المرحلة المسجل بها</label>
                                    </div>
                                </div>
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
                <div class="col-sm-12 col-md-12  col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float:right; font-weight:bold;">تسجيل طفل</h3>
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
                                                    <td>تاريخ التسجيل</td>
                                                    <td>اسم الطفل</td>
                                                    <td>تاريخ القبول</td>
                                                    <td>تاريخ الميلاد</td>
                                                    <th>السن عند القبول</th>
                                                    <th>المرحلة المسجل بها</th>
                                                    <th>عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($childRegistrations as $key => $childRegistration)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$childRegistration->registration_date}}</td>
                                                    <td>{{$childRegistration->children->name_ar}}</td>
                                                    <td>{{ $childRegistration->acceptance_date }}</td>
                                                    <td>{{ $childRegistration->born_date }}</td>
                                                    <td>{{ $childRegistration->age }}</td>
                                                    <td>{{ $childRegistration->levels->name }}</td>
                                                    <td>
                                                        <a href="{{ route('childRegistration.edit', $childRegistration->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('childRegistration.destroy', $childRegistration->id) }}"
                                                            type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            {{-- end table --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card table --}}
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="child_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childRegistration.age.Ajax',['id'=>':id'])}}';
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
                            $('#born_date').empty();
                            $('#born_date').val(data);
                            $('#born_date').trigger('change');
                        }
                    });
                } else {
                    $('select[name="born_date"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="child_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childRegistration.idNum.Ajax',['id'=>':id','acceptance_date'=>':acceptance_date'])}}';
                route = route.replace(':id', stateID).replace(':acceptance_date', $('input[name="acceptance_date"]').val());
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#age').empty();
                            $('#age').val(data);
                            $('#age').trigger('change');
                        }
                    });
                } else {
                    $('select[name="age"]').empty();
                }
            });
        });
</script>
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="child_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childRegistration.gender.Ajax',['id'=>':id'])}}';
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
                            $('#gender').empty();
                            $('#gender').val(data);
                            $('#gender').trigger('change');
                        }
                    });
                } else {
                    $('select[name="gender"]').empty();
                }
            });
        });
</script>
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="child_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childRegistration.city.Ajax',['id'=>':id'])}}';
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
                            $('#city').empty();
                            $('#city').val(data);
                            $('#city').trigger('change');
                        }
                    });
                } else {
                    $('select[name="city"]').empty();
                }
            });
        });
</script>
@endsection
