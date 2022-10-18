@extends('admin.layouts.includes.master')
@section('title') المصروفات العامة @endsection
@section('content')
<script src="{{asset('public/select/jquery.min.js')}}"></script>
<!-- CSS forsearching -->
<link href="{{asset('public/select/select2.min.css')}}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{asset('public/select/select2.min.js')}}"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">المصروفات العامة</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('generalAccount.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{date('Y-m-d')}}" required>
                                        <label for="date" class="col-form-label n_right2">التاريخ </label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3 row">
                                        <div class="col-9 form-floating">
                                            <select required class="form-control js-example-basic-single"
                                                name="treasury_id" id="treasury_id">
                                                <option value="">اختر الخزينة</option>
                                                @foreach($treasuries as $key => $treasury)
                                                <option value="{{$treasury->id}}">{{$treasury->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="expenses_type" class="col-form-label n_right2">اختر الخزينة
                                            </label>
                                        </div>
                                        <div class="col-3 form-floating">
                                            <input type="number" class="form-control bank_balance" id="balance"
                                                placeholder="" readonly name="balance">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="generalExpensese_id" id="generalExpensese_id">
                                            <option value="">اختر المصروف</option>
                                            @foreach ($generalExpenseses as $generalExpensese)
                                            <option value="{{ $generalExpensese->id }}">{{ $generalExpensese->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="generalExpensese_id" class="col-form-label n_right2">اختر
                                            المصروف</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <input type="number" class="form-control" id="amount" step="0.1"
                                            placeholder="المبلغ" name="amount">
                                        <label for="amount" class="col-form-label n_ro3ya">المبلغ</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" type="reset">
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
                            <h3 class="card-title">المصروفات العامة</h3>
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
                                                        التاريخ </th>
                                                    <td>الخزينة</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        اسم المصروف</th>
                                                    <td>المبلغ</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($generalAccounts as $key =>
                                                $generalAccount)
                                                <tr class="odd">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$generalAccount->date}}</td>
                                                    <td>{{$generalAccount->treasuries->name}}</td>
                                                    <td>{{$generalAccount->generalExpenseses->name}}</td>
                                                    <td>{{$generalAccount->amount}}</td>
                                                    <td>
                                                        <a href="{{ route('generalAccount.edit', $generalAccount->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('generalAccount.destroy', $generalAccount->id) }}"
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
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="generalExpensese_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('generalAccount.Ajax',['id'=>':id'])}}';
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
                            $('#amount').empty();
                            $('#amount').val(data);
                            $('#amount').trigger('change');
                        }
                    });
                } else {
                    $('select[name="amount"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function () {
            $('select[name="treasury_id"]').on('change', function () {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('treasury.balance.ajax',['id'=>':id'])}}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function (x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#balance').empty();
                            $('#balance').val(data);
                            $('#balance').trigger('change');
                        }
                    });
                } else {
                    $('select[name="balance"]').empty();
                }
            });
        });
</script>


{{-- <script>
        let amount = document.getElementById('amount');
        let action = 0
        if(amount == action){
            amount.removeAttribute('readonly');
        }
</script> --}}
@endsection
