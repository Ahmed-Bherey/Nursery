<!doctype html>
<html lang="en">

<head>
    <title>تقرير الطلاب بالقاعه</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
                                    <td>{{\App\Models\ChildRegistration::where('child_id',$student->add_chlids->id)->value('born_date')}}</td>

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
</body>

</html>
