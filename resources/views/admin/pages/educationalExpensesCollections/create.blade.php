@extends('admin.layouts.includes.master')
@section('title')
تحصيل الرسوم الدراسية
@endsection
@section('content')
<script src="{{ asset('public/select/jquery.min.js') }}"></script>
<!-- CSS forsearching -->
<link href="{{ asset('public/select/select2.min.css') }}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{ asset('public/select/select2.min.js') }}"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">تحصيل رسوم دراسية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('educationalExpensesCollection.store') }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{ date('Y-m-d') }}" required>
                                        <label for="date" class="col-form-label n_right2">التاريخ</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="level_id" id="level_id">

                                            <option value="">اختر المرحلة</option>
                                            @foreach ($levels as $key => $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="level" class="col-form-label n_right2">اختر المرحلة</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="treasury_id"
                                            id="treasury_id">
                                            <option value="">اختر الخزينة</option>
                                            @foreach ($treasuries as $key => $treasury)
                                            <option value="{{ $treasury->id }}">{{ $treasury->name }} --المبلغ
                                                {{ $treasury->balance }}</option>
                                            @endforeach
                                        </select>
                                        <label for="treasury_id" class="col-form-label n_right2">الخزينة</label>

                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating">
                                        <select required class="form-control js-example-basic-single" name="child_id"
                                            id="child_id">
                                            <option value="">اختر الطفل</option>

                                        </select>
                                        <label for="child_id" class="col-form-label n_right2">اختر الطفل</label>
                                    </div>
                                    <div
                                        class="col-xxl-4 col-xl-4 col-lg-8 col-md-6 col-12 row m-0 p-0 selectValShow">
                                        <div class="col-6 form-floating">
                                            <select class="form-control js-example-basic-single" name="expenses_id"
                                                id="expenses_id">
                                                <option value=""> المصروفات الدراسيه</option>
                                            </select>
                                            <label for="expenses_type" class="col-form-label n_right2">نوع
                                                المصروف</label>
                                        </div>
                                        <div class="col-3 form-floating">
                                            <input type="number" class="form-control balance" id="balance"
                                                placeholder="" readonly name="balance">
                                        </div>
                                        <div class="col-3 form-floating">
                                            <!-- بدلت ال id="balance" ب id="minus" -->
                                            <input type="number" class="form-control balance"
                                                placeholder="" name="balance" id="minus">
                                                <label for="expenses_type" class="col-form-label n_right2" >
                                                    الخصم</label>
                                        </div>
                                        <div class="col-3 form-floating">
                                            <input type="number" class="form-control bank_balance" id="hidden_data"
                                                placeholder="" name="hidden_data" hidden>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating">
                                        <input required type="number" class="form-control total_paid" step="0.1"
                                            id="date" name="total_paid">
                                        <label for="date" class="col-form-label n_right2">اجمالى المدفوع</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating">
                                        <input type="number" class="form-control rest" step="0.1" id="rest" readonly
                                            name="rest">
                                        <label for="date" class="col-form-label n_right2">المتبقى</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="notes"
                                            id="n"></textarea>
                                        <label for="n" class="col-form-label n_right2">ملاحظات</label>
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
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">تحصيل رسوم دراسية</h3>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        المرحلة</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الخزينة</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الطفل</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        نوع المصروف</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        اجمالى المدفوع</th>
                                                    <td>المتبقى</td>
                                                    <td>ملاحظات</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($educationalExpensesCollections as $key =>
                                                $educationalExpensesCollection)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $educationalExpensesCollection->date }}</td>
                                                    <td>
                                                        {{ $educationalExpensesCollection->levels->name }}
                                                    </td>
                                                    <td>{{ $educationalExpensesCollection->treasuries->name }}</td>
                                                    <td>{{ $educationalExpensesCollection->children->name_ar }}
                                                    </td>
                                                    <td>{{ $educationalExpensesCollection->educationalExpenses->name }}
                                                    </td>
                                                    <td>{{ $educationalExpensesCollection->total_paid }}</td>
                                                    <td>{{ $educationalExpensesCollection->rest }}</td>
                                                    <td>{{ $educationalExpensesCollection->notes }}</td>
                                                    <td>
                                                        <a href="{{ route('educationalExpensesCollection.print', $educationalExpensesCollection->id) }}"
                                                            type="submit" class="btn btn-info"><i
                                                                class="fa-solid fa-print"></i></a>
                                                        <a href="{{ route('educationalExpensesCollection.edit', $educationalExpensesCollection->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('educationalExpensesCollection.destroy', $educationalExpensesCollection->id) }}"
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

<script>
    let bank_balance = document.querySelector('.bank_balance'),
            balance = document.querySelector('.balance'),
            total_paid = document.querySelector('.total_paid'),
            rest = document.querySelector('.rest');
        //     '' ' '''
        total_paid.addEventListener('keyup', () => {
            if (bank_balance.value == '' || bank_balance.value == 0) {
                if (balance.value * 1 < total_paid.value * 1) {
                    total_paid.value = balance.value
                }
                rest.value = balance.value * 1 - total_paid.value * 1
            } else {
                if (bank_balance.value * 1 < total_paid.value * 1) {
                    total_paid.value = bank_balance.value
                }
                rest.value = bank_balance.value * 1 - total_paid.value * 1
            }
        })
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="expenses_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('educationalExpensesCollection.expenses.Ajax', ['id' => ':id']) }}';
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

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="level_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('level.expenses.ajax', ['id' => ':id']) }}';
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
                            $('#expenses_id').empty();
                            $.each(data, function(key, value) {
                                $('#expenses_id').append($(`<option>`, {
                                    value: value.educational_expenses.id,
                                    text: value.educational_expenses.name,
                                }));
                            });
                            $('#expenses_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="expenses_id"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="level_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('sellUniform.children.ajax', ['id' => ':id']) }}';
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
                            $('#child_id').empty();
                            $.each(data, function(key, value) {
                                $('#child_id').append($(`<option>`, {
                                    value: value.children.id,
                                    text: value.children.name_ar,
                                }));
                            });
                            $('#child_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="child_id"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="child_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('child.rest.ajax', ['id' => ':id']) }}';
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
                            $('#hidden_data').empty();
                            $('#hidden_data').val(data);
                            $('#hidden_data').trigger('change');
                        }
                    });
                } else {
                    $('select[name="child_id"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="child_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('child.rest.ajax', ['id' => ':id']) }}';
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
                            $('#rest').empty();
                            $('#rest').val(data);
                            $('#rest').trigger('change');
                        }
                    });
                } else {
                    $('select[name="child_id"]').empty();
                }
            });
        });
</script>


<script>
    let minuss = document.getElementById('minus');
    let balancee = document.getElementById('balance');

    minuss.onkeyup = function() {
        balancee.value -=minuss.value;
    }
</script>
@endsection
