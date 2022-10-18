@extends('admin.layouts.includes.master')
@section('title') تعديل نقل طفل الى قاعة @endsection
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
                            <h3 class="card-title header-title">نقل طفل الي قاعة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('childTransfer.update',$childTransfers->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{$childTransfers->date}}" required>
                                        <label for="date" class="col-form-label">التاريخ </label>
                                    </div>
                                    <div class="col-sm-4 form-floating" hidden>
                                        <select required class="form-control drop js-example-basic-single"
                                            name="level_id" id="level_id">
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}" @if($childTransfers->level_id ==
                                                $level->id)selected @endif>{{ $level->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="level_id" class="col-form-label">اختر المرحلة</label>
                                    </div>
                                    {{-- <div class="col-sm-4 form-floating">
                                        <input required type="text" class="form-control" value="{{$childTransfers->levels->name}}" id="level_id" placeholder="التاريخ"
                                            name="level_id">
                                        <label for="level_id" class="col-form-label n_ro3ya">اسم المرحلة</label>
                                    </div> --}}
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="classroomFrom_id" id="classroomFrom_id">
                                            @foreach($classroomsFrom as $key => $classroomsF)
                                            <option value="{{$classroomsF->id}}" @if($childTransfers->classroomFrom_id == $classroomsF->id) selected @endif>{{$classroomsF->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="classroomFrom_id" class="col-form-label">التحويل من</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control js-example-basic-single" name="addChild_id"
                                            id="addChild_id" size="7">
                                            @foreach($addChildren as $key => $child)
                                            <option value="{{$child->id}}" @if($childTransfers->addChild_id == $child->id) selected @endif>{{$child->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        <label for="addChild_id" class="col-form-label">اختر الطفل</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control drop mt-3 js-example-basic-single"
                                            name="classroomTo_id" id="classroomTo_id">
                                            @foreach($classroomsTo as $key => $classroomsT)
                                            <option value="{{$classroomsT->id}}" @if($childTransfers->classroomTo_id == $classroomsT->id) selected @endif>{{$classroomsT->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="classroomTo_id" class="col-form-label">التحويل الى </label>
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


{{-- <script type="text/javascript">
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
</script> --}}
@endsection
