@extends('admin.layouts.includes.master')
@section('title') اضافة خزينة @endsection
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
                            <h3 class="card-title header-title">الخزائن</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('treasury.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-sm-6 form-floating">
                                        <input type="text" class="form-control" id="treasury" placeholder="اسم الخزينة"
                                            required name="name">
                                        <label for="treasury" class="col-form-label n_ro3ya">اسم الخزينة</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 form-floating">
                                        <input type="text" class="form-control" id="honest" placeholder="امين الخزينة"
                                            required name="treasury_secretary">
                                        <label for="honest" class="col-form-label n_ro3ya">امين الخزينة</label>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 form-floating">
                                        <input type="number" class="form-control" step="0.1" id="value"
                                            placeholder="قيمة الخزينة" name="balance">
                                        <label for="value" class="col-form-label n_ro3ya">قيمة الخزينة</label>
                                    </div>
                                    <div class="form-check col-lg-3 col-sm-6 n_box mt-3">
                                        <div>
                                            <input class="form-check-input" type="checkbox" value="1" name="active"
                                                checked id="flexCheckDefault">
                                        </div>
                                        <div>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                تفعيل
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button type="reset" class="btn bg-secondary">
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
                <div class="col-sm-12 col-md-12  col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float:right; font-weight:bold;"> الخزائن </h3>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        اسم الخزينة </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        امين الخزينة </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        قيمة الخزينة </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        حالة التفعيل</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($treasuries as $treasury)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $treasury->name }}</td>
                                                    <td>{{ $treasury->treasury_secretary }}</td>
                                                    <td>{{ $treasury->balance }}</td>
                                                    <td>
                                                        @if($treasury->active == 1)
                                                        مفعل
                                                        @else
                                                        غير مفعل
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('treasury.edit', $treasury->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('treasury.destroy', $treasury->id) }}" hidden
                                                            type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            {{-- end table --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card table --}}
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
@endsection
