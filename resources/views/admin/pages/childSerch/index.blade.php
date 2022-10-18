@extends('admin.layouts.includes.master')
@section('title')بحث@endsection
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
                            <h3 class="card-title" style="float: right">بحث الاطفال</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form action="{{ route('children.data.show') }}" method="GET">
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="level_id"
                                            id="level_id">
                                            <option value="">اختر المرحلة</option>
                                            @foreach($levels as $key => $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="level_id" class="col-form-label ">اختر المرحلة</label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single"
                                            name="classRoom_id" id="classRoom_id">
                                            <option value="">اختر القاعة</option>
                                            @foreach($classRooms as $key => $classRoom)
                                            <option value="{{$classRoom->id}}">{{$classRoom->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="classRoom_id" class="col-form-label ">اختر القاعة</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select required class="form-control js-example-basic-single" name="active"
                                            id="active">
                                            <option value="">اختر الحالة</option>
                                            <option value="1">الكل</option>
                                            <option value="2">مفعل</option>
                                            <option value="3">غير مفعل</option>
                                        </select>
                                        <label for="name" class=" col-form-label">اختر الحالة
                                        </label>
                                    </div>
                                </div>
                                @isset($children)
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
                                                            <th>اسم الطلاب</th>
                                                            <th>العنوان</th>
                                                            <td>تاربخ الميلاد</td>
                                                            <td>رقم تليفون الاب</td>
                                                            <td>الديانة</td>
                                                            <td>النوع</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($children as $key => $child)
                                                        <tr class="odd">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $child->add_chlids->name_ar }}</td>
                                                            <td>{{ $child->add_chlids->address }}</td>
                                                            <td>{{
                                                                App\Models\ChildRegistration::where('child_id',$child->add_chlids->id)->value('born_date')
                                                                }}</td>
                                                            <td>{{$child->add_chlids->father_tel}}</td>
                                                            <td>
                                                                @if($child->add_chlids->religion == 1)
                                                                مسلم
                                                                @else
                                                                مسيحى
                                                                @endif
                                                            </td>
                                                            <td>{{App\Models\ChildRegistration::where('child_id',$child->add_chlids->id)->value('gender')}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endisset
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" onclick="history.back()" type="submit">
                                    <i class="fas fa-undo"></i>
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
@endsection
