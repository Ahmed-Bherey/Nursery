@extends('admin.layouts.includes.master')
@section('title') غياب واستأذان الاطفال @endsection
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
                            <h3 class="card-title header-title">تقرير الغياب والاستأذان</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('absence.info.show') }}" method="get">
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
                                        <select required class="form-control drop js-example-basic-single" name="classroom_id"
                                            id="classroom_id">
                                            <option value="">اختر القاعة</option>
                                            @foreach ($classRooms as $classRoom)
                                            <option value="{{ $classRoom->id }}">{{ $classRoom->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="level_id" class="col-form-label ">اختر القاعة</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 form-floating">
                                        <select required class="form-control js-example-basic-single" name="addChild_id"
                                            id="addChild_id">
                                            <option value="">اختر الطفل</option>
                                        </select>
                                        <label for="addChild_id" class="col-form-label ">اختر الطفل</label>
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
            {{-- end card --}}
            {{-- start card table --}}

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
                                        <p class="mb-0"><b>رقم التقرير: {{str_pad($children->id +
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
                                                <p><b class="ms-2"></b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <div class="booking-info">
                                            <p><b class="ms-2">المرحلة : {{ $classroom->levels->name }}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="booking-info">
                                            <p><b class="ms-2">الطفل: {{ $children->name_ar }}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="booking-info">
                                            <p><b class="ms-2">القاعة: {{ $classroom->name }}</b></p>
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
                <div class="d-print-none">
                    {!! $absences->withQueryString()->links() !!}
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="classroom_id"]').on('change', function() {
            var stateID = $(this).val();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var route = '{{ route('classRoom.absence.Ajax',['id'=>':id','date'=>':date'])}}';
            route = route.replace(':id', stateID).replace(':date', $('input[name="date"]').val());
            if (stateID) {
                $.ajax({
                    beforeSend: function(x) {
                        return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                    },
                    url: route,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#addChild_id').empty();
                        $.each(data, function(key, value) {
                            $('#addChild_id').append($(`<option>`, {
                                value: value.id,
                                text: value.name_ar,
                            }));
                        });
                        $('#addChild_id').trigger('change');
                    }
                });
            } else {
                $('select[name="classroom_id"]').empty();
            }
        });
        });
</script>
@endsection





















