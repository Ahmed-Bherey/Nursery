@extends('admin.layouts.includes.master')
@section('title')
اضافة طفل
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg mb-3">
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>اضافة طفل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('addChild.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="name_ar"
                                                placeholder="اسم الطفل باللغة العربية" name="name_ar"
                                                title="هذا الحقل لابد ان يكون حروف فقط">
                                            <label for="name_ar" class=" col-form-label">اسم الطفل
                                                بالكامل (ع)
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input type="text" class="form-control" id="name_en"
                                                placeholder="اسم الطفل باللغة الانجليزية" name="name_en"
                                                title="هذا الحقل لابد ان يكون حروف فقط">
                                            <label for="name_en" class=" col-form-label">اسم الطفل باللغة الانجليزية
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="id_number"
                                                placeholder="الرقم القومى" name="id_number" pattern="\d*"
                                                title="الرقم غير صحيح" {{-- maxlength="14" minlength="14" --}}>
                                            <label for="id_number" class=" col-form-label">الرقم القومى
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="address"
                                                placeholder="العنوان" name="address">
                                            <label for="address" class=" col-form-label">العنوان
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="father_name"
                                                placeholder="اسم الاب" name="father_name"
                                                title="هذا الحقل لابد ان يكون حروف فقط">
                                            <label for="father_name" class=" col-form-label">اسم ولي الامر
                                                بالكامل
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="father_tel"
                                                placeholder="تليفون الاب" name="father_tel" pattern="\d*"
                                                title="الرقم غير صحيح" {{-- maxlength="11" minlength="11" --}}>
                                            <label for="father_tel" class=" col-form-label">تليفون الاب
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="father_tel"
                                                placeholder="وظيفة الاب" name="fatherJob">

                                            <label for="fatherJob" class=" col-form-label">وظيفه الاب
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="mother_name"
                                                placeholder="اسم الام" name="mother_name">
                                            <label for="mother_name" class="col-form-label">اسم الام بالكامل
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="mother_tel"
                                                placeholder="تليفون الام" name="mother_tel" pattern="\d*"
                                                title="الرقم غير صحيح" {{-- maxlength="11" minlength="11" --}}>
                                            <label for="mother_tel" class="col-form-label">تليفون الام
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="motherJob"
                                                placeholder="وظيفة الام" name="motherJob">

                                            <label for="motherJob" class=" col-form-label">وظيفه الام
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input type="text" class="form-control" id="another_tel"
                                                placeholder="رقم اخر للتواصل" name="another_tel" pattern="\d*"
                                                title="الرقم غير صحيح" {{-- maxlength="11" minlength="11" --}}>
                                            <label for="another_tel" class=" col-form-label">رقم اخر للتواصل
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="religion" id="religion">
                                                <option value="">اختر الديانة</option>
                                                <option value="1">مسلم</option>
                                                <option value="2">مسيحى</option>
                                            </select>
                                            <label for="name" class=" col-form-label">اسم الديانة
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input type="file" class="form-control" id="img" placeholder="صورة الطفل"
                                                name="img">
                                            <label for="img" class=" col-form-label">صورة الطفل
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 d-flex">
                                            <label class="switch switch-2-5" for="switch-2-5">
                                                <input type="checkbox" value="1" name="active" checked id="switch-2-5">
                                                <span class="slider round slider-2-5"></span>
                                            </label>
                                            <label class="form-check-label" for="switch-2-5">
                                                تفعيل
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="error"></div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-success-2 mr-3">
                                        <i class="fa fa-check text-light" aria-hidden="true"></i>
                                    </button>
                                    <button type="reset" class="btn bg-secondary">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card border border-1 mt-3 bg-light">
                        <div class="card-header ">
                            <h3 class="card-title " style="float:right; font-weight:bold;">بيانات الطفل</h3>
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
                                                    <th>اسم الطفل باللغة العربية</th>
                                                    <th>الرقم القومي</th>
                                                    <th>العنوان</th>
                                                    <th>تليفون الاب</th>
                                                    <th>اسم الام</th>
                                                    <th>تليفون الام</th>
                                                    <th>تفعيل</th>
                                                    <th>عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($addChilds as $key => $addChild)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $addChild->name_ar }}</td>
                                                    <td>{{ $addChild->id_number }}</td>
                                                    <td>{{ $addChild->address }}</td>
                                                    <td>{{ $addChild->father_tel }}</td>
                                                    <td>{{ $addChild->mother_name }}</td>
                                                    <td>{{ $addChild->mother_tel }}</td>
                                                    <td>
                                                        @if ($addChild->active == 0)
                                                        غير مفعل
                                                        @else
                                                        مفعل
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('addChild.edit', $addChild->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('addChild.destroy', $addChild->id) }}"
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
