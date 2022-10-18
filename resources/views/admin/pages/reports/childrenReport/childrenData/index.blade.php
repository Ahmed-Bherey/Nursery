@extends('admin.pages.reports.includes.master')
@section('title')جميع الاطفال@endsection
@section('content')
{{-- <div class="card-footer">
    <button class="btn bg-info me-auto" onclick="window.print() " data-bs-toggle="tooltip" data-bs-placement="top"
        title="اطبع الملف"><i class="fa-solid fa-file-pdf"></i>print</button>
</div> --}}
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
                                @foreach ($children as $key => $child)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $child->children->name_ar }}</td>
                                    <td>{{ $child->children->father_name }}</td>
                                    <td>{{ $child->children->father_tel }}</td>
                                    <td>{{ $child->children->id_number }}</td>
                                    {{-- <td>{{ $child->children->mother_name }}</td>
                                    <td>{{ $child->children->mother_tel }}</td> --}}
                                    <td>{{$child->levels->name}}</td>
                                    <td>{{$child->children->address}}</td>
                                    <td>{{$child->born_date}}</td>
                                    {{-- <td>
                                        @if($child->children->religion == 1)
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
                <div class="footer container">
                    <p><b>العنوان : </b>{{ $daycareSettieng->address }}</p>
                    <p><b>الرؤية : </b>{{ $daycareSettieng->vision }}</p>
                    <p><b>الرسالة : </b>{{ $daycareSettieng->mission }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-print-none">
    {!! $children->withQueryString()->links() !!}
</div>
</body>

</html>
@endsection
