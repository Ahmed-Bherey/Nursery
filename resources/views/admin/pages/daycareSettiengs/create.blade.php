@extends('admin.layouts.includes.master')
@section('title')
بيانات الحضانة
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
                            <h3 class="card-title header-title "><i class="fas fa-server  ml-2"></i>بيانات الحضانة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal " action="{{ route('daycareSettieng.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body ">
                                <div class="row g-4 mb-3">
                                    <div class="col-lg-9 row g-3">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" class="form-control" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->name_ar }}" @endisset id="name"
                                                placeholder="الاسم باللغة العربية" name="name_ar">
                                            <label for="ar-name" class=" col-form-label">اسم باللغة العربيه</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->name_en }}" @endisset class="form-control"
                                                id="name" placeholder="الاسم باللغة الانجليزية" name="name_en">
                                            <label for="e-name" class=" col-form-label ">اسم باللغة الانجليزية</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="email" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->email }}" @endisset class="form-control"
                                                id="name" placeholder="البريد الاكترونى" name="email">
                                            <label for="e-mail" class=" col-form-label "> البريد
                                                الالكترونى</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->website }}" @endisset class="form-control"
                                                id="name" placeholder="موقع الويب" name="website">
                                            <label for="site" class=" col-form-label "> موقع
                                                الويب </label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->tel1 }}" @endisset class="form-control"
                                                id="name" placeholder="تليفون الحضانة" name="tel1" {{--
                                                pattern="[0-9]{11}" --}}
                                                title="لابد من كتابة رقم الهاتف المكون من 11 رقم">
                                            <label for="tel" class=" col-form-label "> تليفون
                                                الحضانة </label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->tel2 }}" @endisset class="form-control"
                                                id="name" placeholder="تليفون الحضانة" name="tel2" {{--
                                                pattern="[0-9]{11}" --}}
                                                title="لابد من كتابة رقم الهاتف المكون من 11 رقم">
                                            <label for="tel" class=" col-form-label "> تليفون
                                                اخر </label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->tel3 }}" @endisset class="form-control"
                                                id="name" placeholder="تليفون الحضانة" {{-- pattern="[0-9]{11}" --}}
                                                title="لابد من كتابة رقم الهاتف المكون من 11 رقم" name="tel3">
                                            <label for="tel" class=" col-form-label "> تليفون
                                                الحضانة </label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="number" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->fax }}" @endisset class="form-control"
                                                id="name" placeholder="فاكس" name="fax">
                                            <label for="tel" class=" col-form-label "> فاكس
                                                الحضانة </label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->address }}" @endisset class="form-control"
                                                id="name" placeholder="عنوان الحضانة" name="address">
                                            <label for="address" class=" col-form-label  "> عنوان
                                                الحضانة </label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="number" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->commercial_number }}" @endisset
                                                class="form-control" id="name" placeholder="السجل التجارى"
                                                name="commercial_number">
                                            <label for="tel" class=" col-form-label ">السجل التجارى</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" @isset($daycareSettiengs)
                                                value="{{ $daycareSettiengs->commercial_id }}" @endisset
                                                class="form-control" id="name" placeholder="البطاقة الضريبية"
                                                name="commercial_id" {{-- pattern="[0-9]{9}" --}}
                                                title="لابد من كنابه رقم الهاتف المكون من 9 رقم">
                                            <label for="tel" class=" col-form-label ">البطاقة
                                                الضريبية</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="file" class="form-control" accept="image/*" id="name" placeholder="اللوجو"
                                                name="logo">
                                            <label for="site" class=" col-form-label">لوجو الحضانة</label>

                                        </div>
                                        <div class="col-sm-6 mt-3 form-floating">
                                            <textarea class="form-control" rows="1" id="note" placeholder="الرؤية ..."
                                                name="vision">
@isset($daycareSettiengs)
{{ $daycareSettiengs->vision }}
@endisset
</textarea>
                                            <label for="note" class=" col-form-label n_ro3ya">الرؤية</label>
                                        </div>
                                        <div class="col-sm-6 mt-3 form-floating">
                                            <textarea class="form-control" rows="1" id="note" placeholder="الرسالة ..."
                                                name="mission">
@isset($daycareSettiengs)
{{ $daycareSettiengs->mission }}
@endisset
</textarea>
                                            <label for="note" class=" col-form-label n_ro3ya">الرسالة</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <img src=" @isset($daycareSettiengs) {{ asset('/public/' . Storage::url($daycareSettiengs->logo)) }} @endisset"
                                            style="max-width: 100%;" id="imgshow">

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn  bg-success"><i class="fa fa-check text-light"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div> <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
