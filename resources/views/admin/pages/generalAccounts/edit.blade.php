@extends('admin.layouts.includes.master')
@section('title') تعديل المصروفات العامة @endsection
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
                        <form class="form-horizontal"
                            action="{{ route('generalAccount.update' , $generalAccounts->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-4 form-floating">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{$generalAccounts->date}}" required>
                                        <label for="date" class="col-form-label">التاريخ </label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="treasury_id" id="treasury_id">
                                            <option value="">اختر الخزينة</option>
                                            @foreach ($treasuries as $treasury)
                                            <option value="{{ $treasury->id }}" @if($generalAccounts->treasury_id ==
                                                $treasury->id) selected @endif>{{ $treasury->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="treasury_id" class="col-form-label">اختر الخزينة</label>
                                    </div>
                                    <div class="col-sm-4 form-floating mb-3">
                                        <select required class="form-control drop" name="generalExpensese_id"
                                            id="generalExpensese_id">
                                            <option value="">اختر المصروف</option>
                                            @foreach ($generalExpenseses as $generalExpensese)
                                            <option value="{{ $generalExpensese->id }}" @if ($generalAccounts->
                                                generalExpensese_id == $generalExpensese->id) selected @endif>
                                                {{$generalExpensese->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="generalExpensese_id" class="col-form-label">اختر المصروف</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <input type="number" class="form-control" step="0.1" value="{{$generalAccounts->amount}}"
                                            id="amount" placeholder="المبلغ" name="amount">
                                        <label for="amount" class="col-form-label">المبلغ</label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{route('generalAccount.create')}}"></a>
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
@endsection
