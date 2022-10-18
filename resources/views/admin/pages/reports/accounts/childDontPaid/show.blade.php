@extends('admin.pages.reports.includes.master')
@section('title')الاطفال الغير مسددين@endsection
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
                                        <p><b class="ms-2">تقرير سداد الرسوم</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-around">
                            <div class="col-auto">
                                <div class="booking-info">

                                    <p><b class="ms-2">المرحلة : {{$Level->name}}</b></p>

                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="booking-info">
                                    <p><b class="ms-2">اسم الرسوم: {{$educationalExpense->name}}</b></p>
                                </div>
                            </div>
                            {{-- <div class="col-auto">
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
                                        <td>التاريخ</td>
                                        <td>اسم الطالب</td>
                                        <td>اجمالى الرسوم</td>
                                        <td>المدفوع</td>
                                        <td>المتبقى</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($educationalExpenses as $key => $educationalExpense)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$educationalExpense->created_at->diffForHumans()}}</td>
                                        <td>{{$educationalExpense->children->name_ar}}</td>
                                        <td>{{App\Models\IndebtednessLevel::where('child_id',$educationalExpense->children->id)->value('amount')}}
                                        </td>
                                        <td>{{$educationalExpense->total_paid}}</td>
                                        <td>{{$educationalExpense->rest}}</td>
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
    {!! $educationalExpenses->withQueryString()->links() !!}
</body>

</html>
@endsection
