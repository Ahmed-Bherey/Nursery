@extends('admin.layouts.includes.master')
@section('title') تعديل اضافة غياب @endsection
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
                        <form class="form-horizontal" action="{{ route('absence.update' , $absences->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{$absences->date}}" required>
                                        <label for="date" class="col-form-label">التاريخ </label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="type" id="type">
                                            <option value="">اختر النوع</option>
                                            <option value="1" @if ($absences->type == 1) selected @endif>غياب</option>
                                            <option value="2" @if ($absences->type == 2) selected @endif>استئذان</option>
                                        </select>
                                        <label for="type" class="col-form-label">اختر النوع</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control drop js-example-basic-single" name="classroom_id"
                                            id="classroom_id">
                                            <option value="">اختر القاعة</option>
                                            @foreach ($classRooms as $classRoom)
                                            <option value="{{ $classRoom->id }}" @if ($absences->classroom_id ==
                                                $classRoom->id) selected @endif>{{ $classRoom->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="classroom_id" class="col-form-label">اختر القاعة</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control js-example-basic-single" name="addChild_id" id="addChild_id">
                                            <option value="">اختر الطفل</option>
                                            @foreach ($addChlidren as $addChlid)
                                            <option value="{{ $addChlid->id }}" @if ($absences->addChild_id == $addChlid->id) selected @endif>{{$addChlid->name_ar }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="addChild_id" class="col-form-label">اختر الطفل</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <textarea class="form-control" rows="1" id="note" placeholder="سبب الغياب ..."
                                            name="absence_reason">{{$absences->absence_reason}}</textarea>
                                        <label for="note" class="col-form-label">سبب الغياب</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary"   title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{route('absence.create')}}"></a>
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
                        $('#classroom_id').trigger('change');
                    }
                });
            } else {
                $('select[name="classroom_id"]').empty();
            }
        });
        });
</script>
@endsection
