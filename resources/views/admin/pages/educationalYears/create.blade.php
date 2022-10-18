@extends('admin.layouts.includes.master')
@section('title')
اضافة سنة الدراسية
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">السنة الدراسية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('educationalYear.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3 n_education-year">
                                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6  col-12  form-floating">
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="name" class="col-form-label">الاسم</label>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12 form-floating">
                                        <input type="date" class="form-control mb-3" id="dateFrom" placeholder="التاريخ"
                                            name="dateFrom" value="{{ date('Y-m-d') }}" required>
                                        <label for="dateFrom" class="col-form-label">من</label>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12 form-floating">
                                        <input type="date" class="form-control mb-3" id="dateTo" placeholder="التاريخ"
                                            name="dateTo">
                                        <label for="dateTo" class="col-form-label">الى</label>
                                    </div>
                                    <div class="form-check col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                                        <label class="switch switch-2-5" for="switch-2-5">
                                            <input type="checkbox" value="1" name="active" id="switch-2-5" checked>
                                            <span class="slider round slider-2-5"></span>
                                        </label>
                                        <label class="form-check-label" for="switch-2-5">
                                            تفعيل
                                        </label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer ">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" type="reset" title="reset">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
            {{-- end card --}}
            {{-- start card table --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">السنة الدراسية</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>الاسم</td>
                                                    <td>من</td>
                                                    <td>الى</td>
                                                    <td>حالة التفعيل</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($educationalYears as $key => $educationalYear)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $educationalYear->name }}</td>
                                                    <td>{{ $educationalYear->dateFrom }}</td>
                                                    <td>{{ $educationalYear->dateTo }}</td>
                                                    <td @if ($educationalYear->active == 1) style="background:
                                                        #00ad818f;color: #fff;border-radius: 21px;" @endif>
                                                        @if ($educationalYear->active == 1)
                                                        مفعل
                                                        @else
                                                        غير مفعل
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('educationalYear.edit', $educationalYear->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('educationalYear.destroy', $educationalYear->id) }}"
                                                            type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.content-header -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
