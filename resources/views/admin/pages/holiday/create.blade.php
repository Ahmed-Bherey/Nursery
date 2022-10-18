@extends('admin.layouts.includes.master')
@section('title') اضافة اجازة @endsection
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
                            <h3 class="card-title header-title">اضافة اجازة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('holiday.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-sm-6  form-floating">
                                        <input type="date" class="form-control mb-1" id="date" placeholder="التاريخ"
                                            name="date" value="{{date('Y-m-d')}}" required>
                                        <label for="date" class="col-form-label ">التاريخ</label>
                                    </div>
                                    <div class="col-lg-4 col-sm-6  form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="بدايةالاجازة"
                                            required name="holidayStart">
                                        <label for="date" class="col-form-label ">بداية الاجازة</label>
                                    </div>
                                    <div class="col-lg-4 col-sm-6  form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="نهاية الاجازة"
                                            required name="holidayEnd">
                                        <label for="date" class="col-form-label ">نهاية الاجازة</label>
                                    </div>
                                    <div class="col-lg-4 col-sm-6  form-floating">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="classroom_id" id="classroom_id">
                                            <option value="">اختر القاعة</option>
                                            @foreach ($classRooms as $classRoom)
                                            <option value="{{ $classRoom->id }}">{{ $classRoom->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="classroom_id" class="col-form-label ">اختر القاعة</label>
                                    </div>
                                    <div class="col-lg-4 col-sm-6  form-floating">
                                        <select required class="form-control js-example-basic-single"
                                            name="data[addChild_id][]" multiple id="addChild_id">
                                            <option value="">اختر الطفل</option>
                                            {{-- @foreach ($addChlidren as $addChlid)
                                            <option value="{{ $addChlid->id }}">{{$addChlid->name_ar }}
                                            </option>
                                            @endforeach --}}
                                        </select>
                                        <label for="addChild_id" class="col-form-label ">اختر الطفل</label>
                                    </div>
                                    <div class="col-lg-4 col-sm-6  form-floating">
                                        <textarea class="form-control" rows="1" id="note" placeholder="سبب الاجازة ..."
                                            name="holiday_reason"></textarea>
                                        <label for="note" class="col-form-label ">سبب الاجازة</label>
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
                            <h3 class="card-title">اضافة اجازة</h3>
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
                                                        بداية الاجازة </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        نهاية الاجازة </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        القاعة</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الطفل</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        سبب الاجازة</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($holidays as $key => $holiday)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$holiday->date}}</td>
                                                    <td>{{$holiday->holidayStart}}</td>
                                                    <td>{{$holiday->holidayEnd}}</td>
                                                    <td>{{$holiday->classrooms->name}}</td>
                                                    <td>{{$holiday->addChildren->name_ar}}</td>
                                                    <td>{{$holiday->holiday_reason}}</td>
                                                    <td>
                                                        <a href="{{ route('holiday.edit', $holiday->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('holiday.destroy', $holiday->id) }}"
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
        $('select[name="classroom_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('classRoom.holiday.Ajax',['id'=>':id','date'=>':date'])}}';
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
                        $('#addChild_id').empty();
                        $.each(data, function(key, value) {
                            $('#addChild_id').append($(`<option>`, {
                                value: value.id,
                                text: value.name_ar,
                            }));
                        });
                        $('#addChild_id').trigger('change');
                        $('#date').trigger('change');
                    }
                });
            } else {
                $('select[name="classroom_id"]').empty();
            }
        });
        });
</script>



{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('select[name="classroom_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('holiday.absence.Ajax',['id'=>':id','date'=>':date'])}}';
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
                        $('#addChild_id').empty();
                        $.each(data, function(key, value) {
                            $('#addChild_id').append($(`<option>`, {
                                value: value.id,
                                text: value.name_ar,
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
</script> --}}
@endsection
