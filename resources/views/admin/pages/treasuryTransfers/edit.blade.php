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
                        <form class="form-horizontal"
                            action="{{ route('treasuryTransfer.update', $treasuryTransfers->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 form-floating mb-3">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{ $treasuryTransfers->date }}" required>
                                        <label for="date" class="col-form-label n_ro3ya">التاريخ </label>
                                    </div>
                                    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12 row mb-3">
                                        <div class="col-9 form-floating">
                                            <select required class="form-control drop"
                                                name="treasuryFrom_id" id="treasuryFrom_id">
                                                <option value=""> التحويل من </option>
                                                @foreach ($treasuriesFrom as $treasuryFrom)
                                                <option value="{{ $treasuryFrom->id }}" @if($treasuryTransfers
                                                    ->treasuryFrom_id == $treasuryFrom->id) selected @endif>{{
                                                    $treasuryFrom->name }}
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
                                                <option value="{{ $treasuryTo->id }}" @if($treasuryTransfers
                                                ->treasuryTo_id == $treasuryTo->id) selected @endif>{{
                                                    $treasuryTo->name }}
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
                                        <input type="number" class="form-control" value="{{$treasuryTransfers->amount}}"
                                            step="0.1" id="amount" placeholder="المبلغ" name="amount" required>
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
