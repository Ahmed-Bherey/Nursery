@extends('admin.layouts.includes.master')
@section('title')
نقل طفل الى قاعة
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
                            <h3 class="card-title header-title">التحويل من خزينة لاخرى</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('treasuryTransfer.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{ date('Y-m-d') }}" required>
                                        <label for="date" class="col-form-label n_ro3ya">التاريخ </label>
                                    </div>
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 row mb-3">
                                        <div class="col-9 form-floating">
                                            <select required class="form-control drop"
                                                name="treasuryFrom_id" id="treasuryFrom_id">
                                                <option value=""> التحويل من </option>
                                                @foreach ($treasuriesFrom as $treasuryFrom)
                                                <option value="{{ $treasuryFrom->id }}">{{ $treasuryFrom->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <label for="treasuryFrom_id" class="col-form-label n_ro3ya">التحويل
                                                من</label>
                                        </div>
                                        <div class="col-3 form-floating">
                                            <input type="number" class="form-control" step="0.1" id="balanceFrom"
                                                readonly placeholder="الرصيد" name="balanceFrom">
                                            <label for="balanceFrom" class="col-form-label n_ro3ya">الرصيد</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 row mb-3">
                                        <div class="col-9 form-floating">
                                            <select required class="form-control drop"
                                                name="treasuryTo_id" id="treasuryTo_id">
                                                <option value="">التحويل الي</option>
                                                @foreach ($treasuriesTo as $treasuryTo)
                                                <option value="{{ $treasuryTo->id }}">{{ $treasuryTo->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <label for="treasuryTo_id" class="col-form-label n_ro3ya">التحويل
                                                الي</label>
                                        </div>
                                        <div class="col-3 form-floating">
                                            <input type="number" class="form-control" step="0.1" id="balanceTo" readonly
                                                placeholder="الرصيد" name="balanceTo">
                                            <label for="balanceTo" class="col-form-label n_ro3ya">الرصيد</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <input type="number" class="form-control" step="0.1" id="amount"
                                            placeholder="المبلغ" name="amount" required>
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
                            <h3 class="card-title">التحويل من خزينة لاخرى</h3>
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
                                                        التحويل من</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        التحويل الى</th>
                                                    <td>المبلغ</td>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($treasuryTransfers as $key => $treasuryTransfer)
                                                <tr class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $treasuryTransfer->date }}</td>
                                                    <td>{{ $treasuryTransfer->treasury_from->name }}</td>
                                                    <td>{{ $treasuryTransfer->treasury_to->name }}</td>
                                                    <td>{{ $treasuryTransfer->amount }}</td>
                                                    <td>
                                                        <a href="{{ route('treasuryTransfer.edit', $treasuryTransfer->id) }}"
                                                            type="submit" class="btn bg-secondary"><i
                                                                class="far fa-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('treasuryTransfer.destroy', $treasuryTransfer->id) }}"
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
    var $drops = $('.drop');
        $drops.change(function() {
            $drops.find("option").show();
            $drops.each(function(index, el) {
                var val = $(el).val();
                if (val) {
                    var $other = $drops.not(this);
                    $other.find("option[value=" + $(el).val() + "]").hide();
                }
            });
        });
</script>


<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="treasuryFrom_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('treasuryTransfer.balanceFrom.ajax', ['id' => ':id']) }}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#balanceFrom').empty();
                            $('#balanceFrom').val(data);
                            $('#balanceFrom').trigger('change');
                        }
                    });
                } else {
                    $('select[name="treasuryFrom_id"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="treasuryTo_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('treasuryTransfer.balanceTo.ajax', ['id' => ':id']) }}';
                route = route.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#balanceTo').empty();
                            $('#balanceTo').val(data);
                            $('#balanceTo').trigger('change');
                        }
                    });
                } else {
                    $('select[name="treasuryTo_id"]').empty();
                }
            });
        });
</script>

@endsection
