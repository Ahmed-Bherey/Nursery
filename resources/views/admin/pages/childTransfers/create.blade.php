@extends('admin.layouts.includes.master')
@section('title')
    نقل طفل الى قاعة
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('public/select/jquery.min.js') }}"></script>
    <!-- CSS forsearching -->
    <link href="{{ asset('public/select/select2.min.css') }}" rel="stylesheet" />
    <!-- JS for searching -->
    <script src="{{ asset('public/select/select2.min.js') }}"></script>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                {{-- start card --}}
                <div class="row mt-1">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header header-bg">
                                <h3 class="card-title header-title">نقل طفل الي قاعة</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('admin.layouts.alerts.success')
                            @include('admin.layouts.alerts.error')
                            <form class="form-horizontal" action="{{ route('childTransfer.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    {{-- row 1 --}}
                                    <div class="row mb-3">
                                        <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                            <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                                name="date" value="{{ date('Y-m-d') }}" required>
                                            <label for="date" class="col-form-label n_ro3ya">التاريخ </label>
                                        </div>
                                        <div
                                            class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 row m-0 p-0 mb-3 selectValShow">
                                            <div class="col-9 form-floating">
                                                <select required class="form-control drop js-example-basic-single"
                                                    name="classroomFrom_id" id="classroomFrom_id">
                                                    <option value="">التحويل من</option>
                                                    @foreach ($classroomsFrom as $classroomFrom)
                                                    <option value="{{ $classroomFrom->id }}">{{ $classroomFrom->name }}
                                                    </option>
                                                @endforeach
                                                </select>
                                                <label for="expenses_type" class="col-form-label n_right2">
                                                    التحويل من</label>
                                            </div>
                                            <div class="col-3 form-floating">
                                                <input type="text" class="form-control" id="dataCount"
                                                    placeholder="اجمالي " readonly>
                                                {{-- <span id="dataCount"> </span> --}}
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                            <select required class="form-control js-example-basic-single" name="addChild_id"
                                                id="addChild_id">
                                                <option value="">اختر طفل</option>
                                            </select>
                                            <label for="addChild_id" class="col-form-label n_ro3ya">اختر طفل </label>
                                        </div>
                                        <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                            <select required class="form-control drop js-example-basic-single"
                                                name="classroomTo_id" id="classroomTo_id">
                                                <option value=""> التحويل الي </option>
                                                @foreach ($classroomsTo as $classroomTo)
                                                    <option value="{{ $classroomTo->id }}">{{ $classroomTo->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="level_id" class="col-form-label n_ro3ya">التحويل الي </label>
                                        </div>
                                        <div class="col-xl-2 col-xxl-2 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                            <input type="number" class="form-control" id="count" placeholder="اجمالي "
                                                name="total" readonly>
                                            <label for="pay" class="col-form-label">عدد الطلاب الحاليين</label>
                                        </div>
                                        <div class="col-xl-2 col-xxl-2 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                            <input type="number" class="form-control" id="paid" placeholder="اجمالي "
                                                name="total" readonly>
                                            <label for="pay" class="col-form-label">الكثافة المتاحة</label>
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
                                <h3 class="card-title">نقل طفل الي قاعة</h3>
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
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            اسم الطفل</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            التحويل من</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            التحويل الى</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            عمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($childTransfers as $key => $childTransfer)
                                                        <tr class="odd">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $childTransfer->date }}</td>
                                                            <td>{{ $childTransfer->addChildren->name_ar }}</td>
                                                            <td>{{ $childTransfer->classroomsFrom->name }}</td>
                                                            <td>{{ $childTransfer->classroomsTo->name }}</td>
                                                            <td>
                                                                <a href="{{ route('childTransfer.edit', $childTransfer->id) }}"
                                                                    type="submit" class="btn bg-secondary"><i
                                                                        class="far fa-edit" aria-hidden="true"></i></a>
                                                                <a href="{{ route('childTransfer.destroy', $childTransfer->id) }}"
                                                                    hidden type="submit"
                                                                    onclick="return confirm('Are you sure?')"
                                                                    class="btn btn-danger"><i
                                                                        class="fas fa-trash-alt"></i></a>
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

    <script>
        var $drops = $('.drop');
        $drops.change(function() {
            $drops.find("option").show();
            $drops.each(function(index, el) {
                var val = $(el).val();
                if (val) {
                    var $other = $drops.not(this);
                    $other.find("option[value=" + $(el).val() + "]").hide();
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="classroomFrom_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childTransfer.childTransferAjax', ['id' => ':id']) }}';
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
                            $('#addChild_id').empty();
                            $.each(data, function(key, value) {
                                $('#addChild_id').append($(`<option>`, {
                                    value: value.addChlid_id,
                                    text: value.add_chlids.name_ar,
                                }));
                            });
                            $('#addChild_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="addChild_id"]').empty();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="level_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childRoom.classRoom.ajax', ['id' => ':id']) }}';
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
                            $('#classroomFrom_id').empty();
                            $.each(data, function(key, value) {
                                $('#classroomFrom_id').append($(`<option>`, {
                                    value: value.id,
                                    text: value.name,
                                }));
                            });
                            $('#classroomFrom_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="classroomFrom_id"]').empty();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="level_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childRoom.classRoom.ajax', ['id' => ':id']) }}';
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
                            $('#classroomTo_id').empty();
                            $.each(data, function(key, value) {
                                $('#classroomTo_id').append($(`<option>`, {
                                    value: value.id,
                                    text: value.name,
                                }));
                            });
                            $('#classroomTo_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="classroomTo_id"]').empty();
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="classroomTo_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childTransfer.count.ajax', ['id' => ':id']) }}';
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
                            $('#count').empty();
                            $('#count').val(data);
                            $('#count').trigger('change');
                        }
                    });
                } else {
                    $('select[name="count"]').empty();
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="classroomTo_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childTransfer.paid.ajax', ['id' => ':id']) }}';
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
                            $('#paid').empty();
                            $('#paid').val(data);
                            $('#paid').trigger('change');
                        }
                    });
                } else {
                    $('select[name="paid"]').empty();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="classroomFrom_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('childTransfer.count.ajax', ['id' => ':id']) }}';
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
                            $('#dataCount').empty();
                            $('#dataCount').val(data);
                            $('#dataCount').trigger('change');
                        }
                    });
                } else {
                    $('select[name="dataCount"]').empty();
                }
            });
        });
    </script>
@endsection
