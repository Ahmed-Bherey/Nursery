@extends('admin.layouts.includes.master')
@section('title') تعديل تحصيل الرسوم الدراسية @endsection
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
                            <h3 class="card-title header-title">تعديل تحصيل رسوم دراسية</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal"
                            action="{{ route('educationalExpensesCollection.update',$educationalExpensesCollections->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-sm-3 form-floating mb-3">
                                        <input type="date" class="form-control" id="date" placeholder="التاريخ"
                                            name="date" value="{{$educationalExpensesCollections->date}}" required>
                                        <label for="date" class="col-form-label n_right2">التاريخ</label>
                                    </div>
                                    <div class="col-sm-3 form-floating mb-3">
                                        <select required class="form-control drop js-example-basic-single"
                                            name="level_id" id="level_id">
                                            <option value="">اختر المرحلة</option>
                                            @foreach($levels as $key => $level)
                                            <option value="{{$level->id}}" @if($educationalExpensesCollections->level_id
                                                == $level->id) selected @endif>{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="level" class="col-form-label n_right2">اختر المرحلة</label>
                                    </div>
                                    <div class="col-sm-3 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="treasury_id"
                                            id="treasury_id">
                                            <option value="">اختر الخزينة</option>
                                            @foreach ($treasuries as $key => $treasury)
                                            <option value="{{ $treasury->id }}" @if($educationalExpensesCollections->
                                                treasury_id == $treasury->id) selected @endif>{{ $treasury->name }}
                                                --المبلغ
                                                {{$treasury->balance}}</option>
                                            @endforeach
                                        </select>
                                        <label for="treasury_id" class="col-form-label n_right2">الخزينة</label>

                                    </div>
                                    <div class="col-sm-3 form-floating mb-3">
                                        <select required class="form-control js-example-basic-single" name="child_id"
                                            id="child_id">
                                            <option value="">اختر الطفل</option>
                                            @foreach ($chlidren as $child)
                                            <option value="{{ $child->id }}" @if($educationalExpensesCollections->
                                                child_id == $child->id) selected @endif>{{$child->name_ar }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="child_id" class="col-form-label n_right2">اختر الطفل</label>
                                    </div>
                                    <div class="col-sm-3 row m-0 p-0 mb-3 selectValShow">
                                        <div class="col-9 form-floating">
                                            <select class="form-control js-example-basic-single" name="expenses_id"
                                                id="expenses_id">
                                                @if($educationalExpensesCollections->expenses_id != "")
                                                <option value="{{$educationalExpensesCollections->expenses_id}}">
                                                    {{$educationalExpensesCollections->educationalExpenses->name}}
                                                </option>
                                                @endif
                                                <option value="">اختر المصروفات الدراسيه</option>
                                            </select>
                                            <label for="expenses_type" class="col-form-label n_right2">نوع
                                                المصروف</label>
                                        </div>
                                        <div class="col-3 form-floating">
                                            <input type="number" class="form-control bank_balance" id="balance"
                                                placeholder="" readonly name="balance">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 form-floating mb-3">
                                        <input type="number" class="form-control" required
                                            value="{{$educationalExpensesCollections->total_paid}}" step="0.1" id="date"
                                            name="total_paid">
                                        <label for="date" class="col-form-label n_right2">اجمالى المدفوع</label>
                                    </div>
                                    <div class="col-sm-3 form-floating mb-3">
                                        <input type="number" class="form-control"
                                            value="{{$educationalExpensesCollections->rest}}" id="date" step="0.1"
                                            name="rest">
                                        <label for="date" class="col-form-label n_right2">المتبقى</label>
                                    </div>
                                    <div class="col-sm-3 form-floating mb-3">
                                        <textarea class="form-control" rows="4" placeholder="ملاحظات ..." name="notes"
                                            id="n">{{$educationalExpensesCollections->notes}}</textarea>
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

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="expenses_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('educationalExpensesCollection.expenses.Ajax',['id'=>':id'])}}';
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
            var route = '{{ route('level.expenses.ajax',['id'=>':id'])}}';
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
                                value: value.id,
                                text: value.name,
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
            var route = '{{ route('sellUniform.children.ajax',['id'=>':id'])}}';
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
@endsection
