@extends('admin.layouts.includes.master')
@section('title') اضافة طفل الى قاعة @endsection
@section('content')
    <script src="{{asset('public/select/jquery.min.js')}}"></script>
    <!-- CSS forsearching -->
    <link href="{{asset('public/select/select2.min.css')}}" rel="stylesheet"/>
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
                            <h3 class="card-title" style="float: right">اضافة طفل الى قاعة</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form action="{{ route('childRoom.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="level_id"
                                            id="level_id">
                                            <option value="">اختر المرحلة</option>
                                            @foreach($levels as $key => $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="level_id" class="col-form-label n_right">اختر المرحلة</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single"
                                            name="classRoom_id" id="classRoom_id">
                                            <option value="">اختر القاعة</option>
                                        </select>
                                        <label for="classRoom_id" class="col-form-label">اخنر القاعة</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single"
                                            name="addChlid_id[]" id="addChlid_id" multiple size="7">
                                            <option value="" hidden>اختيار مجموعة من الاطفال</option>
                                        </select>
                                        <label for="addChlid_id" class="col-form-label">اختر الاطفال</label>

                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <input type="number" class="form-control" id="count" placeholder="عدد الطلاب الحاليين"
                                            name="total" readonly>
                                        <label for="pay" class="col-form-label">عدد الطلاب الحاليين</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <input type="number" class="form-control" id="paid" placeholder="الكثافة الحالية"
                                            name="total" readonly>
                                        <label for="pay" class="col-form-label">الكثافة الحالية</label>
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
            <div class="row mt-1">
                <div class="col-sm-12 col-md-12  col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float:right; font-weight:bold;">اضافة طفل الى قاعة</h3>
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
                                                    <td>اختر المرحلة</td>
                                                    <td>اختر القاعة</td>
                                                    <td>مجموعة الاطفال</td>
                                                    <th>عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($childRooms as $key => $childRoom)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$childRoom->levels->name}}</td>
                                                    <td>{{ $childRoom->classRooms->name }}</td>
                                                    <td>{{ $childRoom->add_Chlids->name_ar }}</td>
                                                    <td>
                                                        <a href="{{ route('childRoom.edit', $childRoom->id) }}" hidden
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('childRoom.destroy', $childRoom->id) }}"
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
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="level_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('childRoom.Ajax',['level'=>':level'])}}';
            route = route.replace(':level', stateID);
            if (stateID) {
                $.ajax({
                    beforeSend: function(x) {
                        return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                    },
                    url: route,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#addChlid_id').empty();
                        $.each(data, function(key, value) {
                            $('#addChlid_id').append($(`<option>`, {
                                value: value.id,
                                text: value.name_ar,
                            }));
                        });
                        $('#addChlid_id').trigger('change');
                    }
                });
            } else {
                $('select[name="addChlid_id"]').empty();
            }
        });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="level_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('childRoom.classRoom.ajax',['id'=>':id'])}}';
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
                        $('#classRoom_id').empty();
                        $.each(data, function(key, value) {
                            $('#classRoom_id').append($(`<option>`, {
                                value: value.id,
                                text: value.name,
                            }));
                        });
                        $('#classRoom_id').trigger('change');
                    }
                });
            } else {
                $('select[name="classRoom_id"]').empty();
            }
        });
        });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="classRoom_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('childRoom.count.ajax',['id' => ':id']) }}';
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
        $('select[name="classRoom_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('childRoom.paid.ajax',['id' => ':id']) }}';
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
@endsection

