@extends('admin.layouts.includes.master')
@section('title') غياب واستأذان الموظفين @endsection
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
                            <h3 class="card-title header-title">تقرير غياب الموظفين</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('employee.absence.info.show') }}" method="get">
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="dateFrom" required>
                                        <label for="date" class="col-form-label ">من</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="dateTo" required>
                                        <label for="date" class="col-form-label ">الى</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <select required class="form-control js-example-basic-single" name="employee_id"
                                            id="employee_id">
                                            <option value="">اختر الموظف</option>
                                            @foreach($employees as $key => $employee)
                                            <option value="{{$employee->id}}">{{$employee->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        <label for="employee_id" class="col-form-label ">اختر الموظف</label>
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
                            data-bs-placement="top" title="اطبع الملف"><i class="fa-solid fa-file-pdf"></i></button>
                    </div>
                    <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            {{-- end card --}}
            {{-- start card table --}}
        </div>
        <div class="row mt-1">
            @isset($absences)
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
                                                        <p><b class="ms-2">اسم الحضانة: {{ $daycareSettieng->name_ar
                                                                }}</b></p>
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
                                                    <p><b class="ms-2"></b></p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="booking-info">
                                                    <p><b class="ms-2">الموظف: {{ $employeess->name_ar }}</b></p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="booking-info">
                                                    <p><b class="ms-2"></b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <div class="contain">
                                        <div class="div-table">
                                            <table class="table invoice-table">
                                                <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>التاريخ</td>
                                                        <td>النوع</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($absences as $key => $absence)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $absence->date }}</td>
                                                        <td>
                                                            @if ($absence->type == 1)
                                                            غياب
                                                            @else
                                                            استأذان
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="footer container">
                                        <p><b>العنوان : </b>{{ $daycareSettieng->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-print-none">
                        {!! $absences->withQueryString()->links() !!}
                    </div>
                    @endisset
        </div>
    </div>
</div>
@endsection
