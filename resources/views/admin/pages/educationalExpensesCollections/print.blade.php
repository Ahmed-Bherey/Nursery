<!doctype html>
<html lang="en">

<head>
    <title>تقرير غياب واستأذان</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('public/admin/dist/logo.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{ asset('public/admin/dist/reports/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/dist/reports/style.css') }}">
</head>

<body>
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
                                    <p><b class="ms-2">شراء زى مدرسى</b></p>
                                </div>
                            </div>
                            {{-- <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">الطفل: </b></p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">القاعة: </b></p>
                                </div>
                            </div> --}}
                        </div>
                    </header>
                    <div class="contain">
                        <div class="div-table">
                            <table class="table invoice-table">
                                <thead>
                                    <tr>
                                        <th>التاريخ</th>
                                        <th>المرحلة</th>
                                        <th>الخزينة</th>
                                        <th>الطفل</th>
                                        <td>نوع المصروف</td>
                                        <td>اجمالى المدفوع</td>
                                        <td>المتبقى</td>
                                        <td>ملاحظات</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$educationalExpensesCollections->date}}</td>
                                        <td>{{$educationalExpensesCollections->levels->name}}</td>
                                        <td>{{$educationalExpensesCollections->treasuries->name}}</td>
                                        <td>{{$educationalExpensesCollections->children->name_ar}}</td>
                                        <td>{{$educationalExpensesCollections->educationalExpenses->name}}</td>
                                        <td>{{$educationalExpensesCollections->total_paid}}</td>
                                        <td>{{$educationalExpensesCollections->rest}}</td>
                                        <td>{{$educationalExpensesCollections->notes}}</td>
                                    </tr>
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
