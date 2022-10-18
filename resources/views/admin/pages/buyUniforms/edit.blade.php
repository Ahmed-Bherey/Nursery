@extends('admin.layouts.includes.master')
@section('title')تعديل شراء زى مدرسى@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">شراء زى</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('buyUniform.update', $buyUniformTotals->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 form-floating">
                                        <input type="date" class="form-control" id="date"
                                            value="{{ $buyUniformTotals->date }}" name="date" required>
                                        <label for="date" class="col-form-label"> التاريخ </label>
                                    </div>
                                    <div class="col-md-3 form-floating">
                                        <input type="text" class="form-control"
                                            value="{{ $buyUniformTotals->supplier }}" id="date" placeholder=""
                                            name="supplier" required>
                                        <label for="namestore" class="col-form-label"> المورد
                                        </label>
                                    </div>
                                    <div class="col-md-3 form-floating">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="notes"
                                            id="n">{{ $buyUniformTotals->notes }}</textarea>
                                        <label for="n" class=" col-form-label"> ملاحظات </label>
                                    </div>
                                    <div class="col-md-3 form-floating">
                                        <input type="number" class="form-control"
                                            value="{{ $buyUniformTotals->total_sale }}" step="0.1" id="total_sale"
                                            placeholder="اجمالي " name="total_sale" required readonly>
                                        <label for="pay" class="col-form-label">اجمالى شراء</label>
                                    </div>
                                    <div class="col-md-3 form-floating mt-3" hidden>
                                        <input type="number" class="form-control"
                                            value="{{ $buyUniformTotals->total_buy }}" step="0.1" id="total_buy"
                                            readonly placeholder="اجمالي " name="total_buy">
                                        <label for="pay" class="col-form-label">اجمالى بيع</label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select type="text" class="form-control" id="date" name="treasury_id" required>
                                            <option value="">اختر الخزنه</option>
                                            @foreach ($treasuries as $treasury)
                                            <option value="{{ $treasury->id }}" @if ($buyUniformTotals->treasury_id ==
                                                $treasury->id) selected @endif>
                                                {{ $treasury->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label"> اختر الخزنه
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> اسم الصنف</th>
                                            <th> الكميه</th>
                                            <th> سعر الشراء للزى الواحد</th>
                                            <th> سعر البيع للزى الواحد</th>
                                            <td>الاجمالى</td>
                                            <th>العملية</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($buyUniforms as $key => $buyUniform)
                                        <tr>
                                            <td>
                                                <input type="name" class="form-control" value="{{ $buyUniform->name }}"
                                                    placeholder="شراء زى" name="data[name][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control amount" step="0.1"
                                                    value="{{ $buyUniform->quantity }}" placeholder="الكميه"
                                                    name="data[quantity][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control buyPrice" step="0.1"
                                                    value="{{ $buyUniform->buy_price }}" placeholder="سعر الشراء"
                                                    name="data[buy_price][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control salePrice" step="0.1"
                                                    value="{{ $buyUniform->sale_price }}" placeholder="سعر البيع"
                                                    name="data[sale_price][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control subTotal"
                                                    value="{{ $buyUniform->subTotal }}" step="0.1" readonly
                                                    placeholder="الاجمالى" name="data[subTotal][]">
                                            </td>
                                            <td>
                                                <button type="button" class="btn bg-success" id="add">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach

                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{ route('buyUniform.create') }}"></a>
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
    let add = document.getElementById('add'),
            tbody = document.getElementById('tbody');
        add.addEventListener(('click'), () => {
            var new_row = document.createElement('tr')
            new_row.innerHTML =
                `
            <td>
            <input type="text" class="form-control" placeholder="شراء زى"
            name="data[name][]" required>
            </td>
            <td>
            <input type="number" class="form-control amount"  step="0.1" id="quantity" placeholder="الكميه"
            name="data[quantity][]" required>
            </td>
            <td>
            <input type="number" class="form-control buyPrice"  step="0.1" placeholder="سعر الشراء"
            name="data[buy_price][]" required>
            </td>
            <td>
            <input type="number" class="form-control salePrice"  step="0.1" placeholder="سعر البيع"
            name="data[sale_price][]" required>
            </td>
            <td>
            <input type="number" class="form-control subTotal" step="0.1" readonly
            placeholder="الاجمالى" name="data[subTotal][]">
            </td>
            <td>
                    <button type="button" class="btn bg-danger" onclick='delet(this),calculate() '>
                        <i class="fas fa-trash-alt text-light"></i>
                    </button>
                </td>`;
            tbody.appendChild(new_row)
        })

        function delet(ele) {
            ele.parentElement.parentElement.remove()
        }
</script>
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="level_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('educationalExpense.level.ajax', ['id' => ':id']) }}';
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
                            $('#educationalExpense_id').empty();
                            $.each(data, function(key, value) {
                                $('#educationalExpense_id').append($('<option>', {
                                    value: value.id,
                                    text: value.name
                                }));
                            });
                            $('#educationalExpense_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="educationalExpense_id"]').empty();
                }
            });
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="treasury_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('treasury.balance.ajax', ['id' => ':id']) }}';
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


<script>
    let pay = document.getElementById('total_sale'),
            price;
        pay.value = 0
        // دالة لحساب ناتج الضرب ال الكمبة * سعر الشراء
        function calculate() {
            let amount = document.querySelectorAll(".amount"),
                subTotal = document.querySelectorAll(".subTotal"),
                buyPrice = document.querySelectorAll(".buyPrice");
            // حساب الاجمالي
            amount.forEach((ele, index) => {
                ele.addEventListener('keyup', () => {
                    subTotal[index].value = buyPrice[index].value * 1 * ele.value * 1
                });
            })

            buyPrice.forEach((ele, index) => {
                ele.addEventListener('keyup', () => {
                    subTotal[index].value = amount[index].value * 1 * ele.value * 1
                });
            })
            // حساب اجمالي السعر
            document.addEventListener('keyup', () => {
                price = 0
                subTotal.forEach((ele, index) => {
                    price = price * 1 + ele.value * 1
                    pay.value = price * 1
                })
            });
        }
        document.addEventListener('keyup', calculate);
</script>
@endsection
