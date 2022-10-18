@extends('admin.layouts.includes.master')
@section('title') تعديل اضافة طفل الى قاعة @endsection
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
                        <form action="{{ route('childRoom.update' , $childRooms->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="level_id" id="level_id">
                                            <option value="">اختر المرحلة</option>
                                            @foreach($levels as $key => $level)
                                            <option value="{{$level->id}}" @if($childRooms->level_id == $level->id)
                                                selected @endif>{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="level_id" class="col-form-label">اختر المرحلة</label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="addChlid_id[]" id="addChlid_id"
                                            multiple size="7">
                                            @if($childRooms->addChlid_id != "")
                                            <option value="{{$childRooms->addChlid_id}}">
                                                {{$childRooms->add_chlids->name_ar}}</option>
                                            @endif
                                        </select>
                                        <label for="addChlid_id" class="col-form-label">اختر الاطفال</label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="classRoom_id" id="classRoom_id">
                                            <option value="">اختر القاعة</option>
                                            @foreach($classRooms as $key => $classRoom)
                                            <option value="{{$classRoom->id}}" @if ($childRooms->classRoom_id ==
                                                $classRoom->id) selected @endif>{{$classRoom->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="classRoom_id" class="col-form-label">اخنر القاعة</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{route('childRoom.create')}}"></a>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
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
                                value: value.child_id,
                                text: value.children.name_ar,
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
@endsection
