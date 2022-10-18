@extends('admin.layouts.includes.master')
@section('title') الطلاب بالقاعه @endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1 d-print-none">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">تقرير الطلاب بالقاعه</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('classRoom.Students.info.show') }}" method="get">
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="classRoom_id" id="classRoom_id">
                                            <option value="">اختر القاعه</option>
                                            @foreach ($classRooms as $classRoom)
                                            <option value="{{ $classRoom->id }}">{{ $classRoom->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="treasury_id" class="col-form-label ">اختر القاعه</label>
                                    </div>
                                </div>
                            </div>
                            {{-- row 2 --}}
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

            @isset($boys)
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
                                                <p><b class="ms-2">اسم الحضانة: {{ $daycareSettieng->name_ar }}</b></p>
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

                                            <p><b class="ms-2">القاعة : {{$classRoom->name}}</b></p>

                                        </div>
                                    </div>

                                </div>
                            </header>

                            <div class="contain">
                                <div class="div-table">
                                    <table class="table invoice-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الطالب</th>
                                                <th> الديانه</th>
                                                <th> تاريخ الميلاد</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $key => $student)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$student->add_chlids->name_ar}}</td>
                                                <td>@if($student->add_chlids->religion == 1)
                                                    مسلم
                                                    @else
                                                    مسيحي
                                                    @endif</td>
                                                <td>{{\App\Models\ChildRegistration::where('child_id',$student->add_chlids->id)->value('born_date')}}
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <table>
                                    <tr>
                                        <th>بنين</th>
                                        <th>بنات</th>
                                        <th>مسلم</th>
                                        <th>مسيحي</th>
                                        <th>اجمالي</th>
                                    </tr>
                                    <tr>
                                        <td>{{$boys}}</td>
                                        <td>{{$girls}}</td>
                                        <td>{{$studentCount1}}</td>
                                        <td>{{$studentCount2}}</td>
                                        <td>{{$total}}</td>

                                    </tr>

                                </table>

                            </div>

                            <div class="footer container">
                                <p><b>العنوان : </b>{{ $daycareSettieng->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-print-none">
                {!! $students->withQueryString()->links() !!}
            </div>
            @endisset
        </div>
        @endsection
