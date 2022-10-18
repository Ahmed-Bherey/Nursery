@extends('admin.layouts.includes.master')
@section('title')
تعديل اضافة طفل
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
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>اضافة طفل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('addChild.update', $addChilds->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-4 mb-3">
                                    <div class="row g-3">
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="name_ar"
                                                placeholder="اسم الطفل باللغة العربية" name="name_ar"
                                                title="هذا الحقل لابد ان يكون حروف فقط"
                                                value="{{ $addChilds->name_ar }}">
                                            <label for="name_ar" class=" col-form-label">اسم الطفل
                                                بالكامل (ع)
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input type="text" class="form-control" id="name_en"
                                                placeholder="اسم الطفل باللغة الانجليزية" name="name_en"
                                                value="{{ $addChilds->name_en }}"
                                                title="هذا الحقل لابد ان يكون حروف فقط">
                                            <label for="name_en" class=" col-form-label">اسم الطفل باللغة الانجليزية
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="id_number"
                                                placeholder="الرقم القومى" name="id_number" pattern="\d*"
                                                title="الرقم غير صحيح" maxlength="14" minlength="14"
                                                value="{{ $addChilds->id_number }}">
                                            <label for="id_number" class=" col-form-label">الرقم القومى
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="address"
                                                placeholder="العنوان" name="address" value="{{ $addChilds->address }}">
                                            <label for="address" class=" col-form-label">العنوان
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="father_name"
                                                placeholder="اسم الاب" name="father_name"
                                                value="{{ $addChilds->father_name }}"
                                                title="هذا الحقل لابد ان يكون حروف فقط">
                                            <label for="father_name" class=" col-form-label">اسم ولي الامر
                                                بالكامل
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="father_tel"
                                                placeholder="تليفون الاب" name="father_tel" pattern="\d*"
                                                title="الرقم غير صحيح" maxlength="11" minlength="11"
                                                value="{{ $addChilds->father_tel }}">
                                            <label for="father_tel" class=" col-form-label">تليفون الاب
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="father_tel"
                                                placeholder="وظيفة الاب" name="fatherJob"
                                                value="{{ $addChilds->fatherJob }}">

                                            <label for="fatherJob" class=" col-form-label">وظيفه الاب
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="mother_name"
                                                placeholder="اسم الام" name="mother_name"
                                                value="{{ $addChilds->mother_name }}">
                                            <label for="mother_name" class="col-form-label">اسم الام بالكامل
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="mother_tel"
                                                placeholder="تليفون الام" name="mother_tel" pattern="\d*"
                                                value="{{ $addChilds->mother_tel }}" title="الرقم غير صحيح"
                                                maxlength="11" minlength="11">
                                            <label for="mother_tel" class="col-form-label">تليفون الام
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input required type="text" class="form-control" id="motherJob"
                                                placeholder="وظيفة الام" name="motherJob"
                                                value="{{ $addChilds->motherJob }}">

                                            <label for="motherJob" class=" col-form-label">وظيفه الام
                                            </label>
                                        </div>
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating ">
                                            <input type="text" class="form-control" id="another_tel"
                                                placeholder="رقم اخر للتواصل" name="another_tel" pattern="\d*"
                                                title="الرقم غير صحيح" maxlength="11" minlength="11"
                                                value="{{ $addChilds->another_tel }}">
                                            <label for="another_tel" class=" col-form-label">رقم اخر للتواصل
                                            </label>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="religion" id="religion">
                                                <option value="">اختر الديانة</option>
                                                <option value="1" @if ($addChilds->religion == 1) selected @endif>مسلم
                                                </option>
                                                <option value="2" @if ($addChilds->religion == 2) selected @endif>مسيحى
                                                </option>
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
                                                <input type="checkbox" name="active" value="1" @if($addChilds->active ==
                                                1)
                                                checked @endif
                                                id="switch-2-5">
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
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
