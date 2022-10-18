@extends('admin.layouts.includes.master')
@section('title') اضافة غياب @endsection
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
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">اضافة غياب</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('absence.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{date('Y-m-d')}}" required>
                                        <label for="date" class="col-form-label ">التاريخ </label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <select required class="form-control " name="type" id="type">
                                            <option value="">اختر النوع</option>
                                            <option value="1">غياب</option>
                                            <option value="2">استئذان</option>
                                        </select>
                                        <label for="type" class="col-form-label">اختر النوع</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <select required class="form-control drop js-example-basic-single" name="classroom_id"
                                            id="classroom_id">
                                            <option value="">اختر القاعة</option>
                                            @foreach ($classRooms as $classRoom)
                                            <option value="{{ $classRoom->id }}">{{ $classRoom->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="classroom_id" class="col-form-label ">اختر القاعة</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 form-floating ">
                                        <select required class="form-control js-example-basic-single" name="data[addChild_id][]" id="addChild_id" multiple>
                                            <option value="">اختر الطفل</option>
                                            {{-- @foreach ($addChlidren as $addChlid)
                                            <option value="{{ $addChlid->id }}">{{$addChlid->name_ar }}
                                            </option>
                                            @endforeach --}}
                                        </select>
                                        <label for="addChild_id" class="col-form-label ">اختر الطفل</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 form-floating ">
                                        <textarea class="form-control" rows="1" id="note" placeholder="سبب الغياب ..."
                                            name="absence_reason"></textarea>
                                        <label for="note" class="col-form-label ">السبب</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary"  type="reset">
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
                            <h3 class="card-title">اضافة غياب</h3>
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
                                                        القاعة</th>
                                                        <td>النوع</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الطفل</th>
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
                                                @foreach ($absences as $key => $absence)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$absence->date}}</td>
                                                    <td>{{$absence->classrooms->name}}</td>
                                                    <td>
                                                        @if($absence->type == 1)
                                                            غياب
                                                        @else
                                                            استئذان
                                                        @endif
                                                    </td>
                                                    <td>{{$absence->addChildren->name_ar}}</td>
                                                    <td>{{$absence->absence_reason}}</td>
                                                    <td>
                                                        <a href="{{ route('absence.edit', $absence->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('absence.destroy', $absence->id) }}"
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
            var route = '{{ route('classRoom.absence.Ajax',['id'=>':id','date'=>':date'])}}';
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
                $('select[name="classroom_id"]').empty();
            }
        });
        });
</script>





{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('select[name="type"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('children.absence.Ajax',['id'=>':id','date'=>':date'])}}';
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
