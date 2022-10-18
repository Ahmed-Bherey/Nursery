@extends('admin.layouts.includes.master')
@section('title') بحث طلاب بالاسم @endsection
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
                            <h3 class="card-title" style="float: right">بحث بالاسم</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form action="{{ route('children.data.name.show') }}" method="GET">
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="child_id"
                                            id="child_id">
                                            <option value="">اختر الطفل</option>
                                            @foreach($children as $key => $child)
                                            <option value="{{$child->id}}">{{$child->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        <label for="child_id" class="col-form-label ">اختر الطفل</label>
                                    </div>
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
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>اسم الطالب</th>
                                        <th>اسم المرحلة</th>
                                        <th>اسم القاعة</th>
                                        <th>رقم هاتف الاب</th>
                                        <th>رقم هاتف الام</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <td>@isset($childd){{$childd->name_ar}}@endisset</td>
                                        <td>@isset($childRoom){{$childRoom->levels->name}} @endisset</td>

                                        <td>@isset($childRoom){{$childRoom->classRooms->name}}@endisset</td>
                                        <td>@isset($childd){{$childd->father_tel}}@endisset</td>
                                        <td>@isset($childd){{$childd->mother_tel}}@endisset</td>
                                        <td>
                                            @isset($child) <a href="{{ route('addChild.edit', $child->id) }}"
                                                type="submit" class="btn bg-secondary"><i class="far fa-edit"
                                                    aria-hidden="true"></i></a>@endisset
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
@endsection