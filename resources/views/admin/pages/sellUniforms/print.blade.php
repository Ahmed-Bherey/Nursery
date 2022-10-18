<!doctype html>
<html lang="en">

<head>
    <title>قسيمة تحصيل</title>
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
                                <p class="mb-0"><b>رقم الفاتورة: {{str_pad($sellUniformTotals->id +
                                        1,7,'0',STR_PAD_LEFT)}}</b></p>
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
                                        <p><b class="ms-2">قسيمة تحصيل</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">بيع زى مدرسى</b></p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">الطفل: {{$sellUniformTotals->children->name_ar}}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">المرحلة: {{$sellUniformTotals->levels->name}}</b>
                                    </p>
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
                                        <th>اسم الصنف</th>
                                        <th>الكميه</th>
                                        <th>السعر</th>
                                        <th>الاجمالى</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sellUniforms as $key => $buyUniform)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$buyUniform->buyUniforms->name}}</td>
                                        <td>{{$buyUniform->quantity}}</td>
                                        <td>{{$buyUniform->price}}</td>
                                        <td>{{$buyUniform->subTotal}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table invoice-table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>الاجمالى العام {{$x}} ({{$Tafqeet}})</th>
                                    </tr>
                                </thead>
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
