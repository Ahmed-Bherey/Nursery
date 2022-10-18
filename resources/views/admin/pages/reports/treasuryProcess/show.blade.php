@extends('admin.pages.reports.includes.master')
@section('title')حركات الخزنة@endsection
@section('content')
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
                                        src=" @isset($daycareSettieng->logo) {{ asset('/public/' . Storage::url($daycareSettieng->logo)) }} @endisset">
                                </div>
                            </div>
                        </div>
                        <div class="header-bottom">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="header-bottom_left">
                                        <p><b class="ms-2">اسم الحضانة: @isset($daycareSettieng->name_ar)@endisset</b>
                                        </p>
                                        <div class="shape"></div>
                                        <div class="shape"></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="header-bottom_right">
                                        <div class="shape"></div>
                                        <div class="shape"></div>
                                        <p><b class="ms-2">يومية الخزينة</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <div class="booking-info">

                                    <p><b class="ms-2">الخزنة : {{$treasury->name}}</b></p>

                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">من: {{$dateFrom}}</b></p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">الى: {{$dateTo}}</b></p>
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
                                        <td>دائن</td>
                                        <td>مدين</td>
                                        <td>تعليق</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($treasury_process as $key => $treasury_proces)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$treasury_proces->date}}</td>
                                        <td>{{$treasury_proces->credit}}</td>
                                        <td>{{$treasury_proces->debt}}</td>
                                        <td>{{$treasury_proces->comment}}</td>
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

</body>

</html>
@endsection
