@extends('admin.layouts.includes.master')
@section('title')تقرير سداد الرسوم@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                {{-- start card --}}
                <div class="row mt-1">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card card-info d-print-none">
                            <div class="card-header header-bg">
                                <h3 class="card-title" style="float: right">تقرير سداد الرسوم</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('admin.layouts.alerts.success')
                            @include('admin.layouts.alerts.error')
                            <form action="{{ route('childDontPaid.info.show') }}" method="GET">
                                <div class="card-body">
                                    {{-- row 1 --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-4 form-floating mb-3">
                                            <select required class="form-control" name="level_id" id="level_id">
                                                <option value="">اختر المرحلة</option>
                                                @foreach ($levels as $key => $level)
                                                    <option value="{{ $level->id }}">{{ $level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="level_id" class="col-form-label n_right2">اختر المرحلة</label>
                                        </div>
                                        <div class="col-sm-4 form-floating mb-3">
                                            <select required class="form-control" name="expenses_type" id="expenses_type">
                                                <option value="">اختر الرسوم</option>
                                            </select>
                                            <label for="expenses_type" class="col-form-label n_right2">اختر الرسوم</label>
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

                @isset($Level)
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
                                                @foreach($educationalExpensess as $key => $educationalExpense)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$educationalExpense->created_at}}</td>
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
                <div class="d-print-none">
                    {!! $educationalExpensess->withQueryString()->links() !!}
                </div>
                @endisset
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>






    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="level_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('educationalExpenseAjax.level.ajax', ['id' => ':id']) }}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#expenses_type').empty();
                            $.each(data, function(key, value) {
                                $('#expenses_type').append($(`<option>`, {
                                    value: value.id,
                                    text: value.name,
                                }));
                            });
                            $('#expenses_type').trigger('change');
                        }
                    });
                } else {
                    $('select[name="expenses_type"]').empty();
                }
            });
        });
    </script>
@endsection
