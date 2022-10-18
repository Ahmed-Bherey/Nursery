@extends('admin.layouts.includes.master')
@section('title')
    اطفال كل مرحلة
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                {{-- start card --}}
                <div class="row mt-1 d-print-none">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card card-info">
                            <div class="card-header header-bg">
                                <h3 class="card-title" style="float: right">اطفال كل مرحلة</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('admin.layouts.alerts.success')
                            @include('admin.layouts.alerts.error')
                            <form action="{{ route('childLevel.info.show') }}" method="GET">
                                <div class="card-body">
                                    {{-- row 1 --}}
                                    <div class="row mb-3">
                                        <div class="col-md-6 form-floating mb-3">
                                            <select required class="form-control" name="student_level" id="student_level">
                                                <option value="">اختر المرحلة</option>
                                                @foreach ($levels as $key => $level)
                                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="student_level" class="col-form-label n_right2">اختر المرحلة</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn bg-success-2 mr-3">
                                            <i class="fa fa-check text-light" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn bg-secondary" onclick="history.back()" type="submit">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </div>
                                    <button class="btn bg-info me-auto" onclick="window.print() " data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="اطبع الملف"><i
                                            class="fa-solid fa-file-pdf"></i></button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>

                @isset($childRegistrations)
                    <link rel="stylesheet" href="{{ asset('public/admin/dist/reports/bootstrap.css') }}">
                    <link rel="stylesheet" href="{{ asset('public/admin/dist/reports/style.css') }}">
                    <div class="page active body-report">
                        <div class="subpage">
                            <div class="as-invoice invoice_style2">
                                <div class="download-inner rounded mt-1" id="download_section">
                                    <header class="header as-header header-layout1">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-6">
                                                <p class="mb-0"><b>رقم التقرير: #935648</b></p>
                                            </div>
                                            <div class="col-6">
                                                <div class="header-logo"><img
                                                        src=" @isset($daycareSettieng) {{ asset('/public/' . Storage::url($daycareSettieng->logo)) }} @endisset">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="header-bottom">
                                            <div class="row align-items-center justify-content-between">
                                                <div class="col-auto">
                                                    <div class="header-bottom_left">
                                                        <p><b class="ms-2">اسم الحضانة:
                                                                {{ $daycareSettieng->name_ar }}</b>
                                                        </p>
                                                        <div class="shape"></div>
                                                        <div class="shape"></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="header-bottom_right">
                                                        <div class="shape"></div>
                                                        <div class="shape"></div>
                                                        <p><b class="ms-2"></b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <div class="booking-info">

                                                    <p><b class="ms-2">المرحلة : {{ $Level->name }}</b></p>

                                                </div>
                                            </div>
                                            {{-- <div class="col-auto">
                                            <div class="booking-info">
                                                <p><b class="ms-2">المريض: </b></p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="booking-info">
                                                <p><b class="ms-2">العيادة: </b></p>
                                            </div>
                                        </div> --}}
                                        </div>
                                    </header>

                                    <div class="contain">
                                        <div class="div-table">
                                            <table class="table invoice-table">
                                                <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>اسم الطالب</td>
                                                        <td>اسم الاب</td>
                                                        <td>تليفون الاب</td>
                                                        <td>الرقم القومى</td>
                                                        {{-- <td>اسم الام</td> --}}
                                                        {{-- <td>تليفون الام</td> --}}
                                                        <td>المرحلة</td>
                                                        <td>العنوان</td>
                                                        <td>تاريخ الميلاد</td>
                                                        {{-- <td>الديانة</td> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($childRegistrations as $key => $childRegistration)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $childRegistration->children->name_ar }}</td>
                                                            <td>{{ $childRegistration->children->father_name }}</td>
                                                            <td>{{ $childRegistration->children->father_tel }}</td>
                                                            <td>{{ $childRegistration->children->id_number }}</td>
                                                            {{-- <td>{{$childRegistration->children->mother_name}}</td>
                                                    <td>{{$childRegistration->children->mother_tel}}</td> --}}
                                                            <td>{{ $childRegistration->levels->name }}</td>
                                                            <td>{{ $childRegistration->children->address }}</td>
                                                            <td>{{ $childRegistration->born_date }}</td>
                                                            {{-- <td>
                                                        @if ($childRegistration->children->religion == 1)
                                                        مسلم
                                                        @else
                                                        مسيحى
                                                        @endif
                                                    </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <p class='p-2'><b>العنوان : </b>{{ $daycareSettieng->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-print-none">

                        {!! $childRegistrations->withQueryString()->links() !!}
                    </div>
                @endisset
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection
