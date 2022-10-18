@extends('admin.layouts.includes.master')
@section('title') اضافة مرحلة @endsection
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
                            <h3 class="card-title header-title">اضافة مرحلة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('leavel.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-6 form-floating">
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="name" class="col-form-label n_nameLevel">اسم المرحلة</label>
                                    </div>
                                    {{-- <div class="col-sm-4 form-floating">
                                        <input type="number" class="form-control" id="name" name="value" required>
                                        <label for="value" class="col-form-label">قيمة المرحلة</label>
                                    </div> --}}
                                    <div class="col-sm-6 form-floating">
                                        <textarea class="form-control " rows="1" id="note" placeholder="ملاحظات"
                                            name="notes"></textarea>
                                        <label for="note" class="col-form-label n_ro3ya">ملاحظات</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary"  type="reset">
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
                            <h3 class="card-title fw-bold">  اضافة مرحلة</h3>
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
                                                    <td>اسم المرحلة</td>
                                                    {{-- <td>قيمة المرحلة</td> --}}
                                                    <td>ملاحظات</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($leavels as $key => $leavel)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$leavel->name}}</td>
                                                    {{-- <td>{{$leavel->value}}</td> --}}
                                                    <td>{{$leavel->notes}}</td>
                                                    <td>
                                                        <a href="{{ route('leavel.edit', $leavel->id) }}" type="submit"
                                                            class="btn bg-secondary"><i class="far fa-edit"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('leavel.destroy', $leavel->id) }}"
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
