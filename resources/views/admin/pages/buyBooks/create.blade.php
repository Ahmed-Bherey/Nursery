@extends('admin.layouts.includes.master')
@section('title')
شراء كتب مدرسية
@endsection
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
                            <h3 class="card-title header-title"> شراء الكتب الدراسيه </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('buyBooks.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 form-floating">
                                        <input type="date" class="form-control" id="date"
                                            value="<?php echo date('Y-m-d'); ?>" name="date" required>
                                        <label for="date" class="col-form-label n_ro3ya"> التاريخ </label>
                                    </div>

                                    <div class="col-sm-4 form-floating">
                                        <input type="text" class="form-control" id="date" placeholder="" name="supplier"
                                            required>
                                        <label for="namestore" class="col-form-label n_ro3ya"> المورد
                                        </label>
                                    </div>
                                    <div class="col-sm-4 form-floating">
                                        <select type="text" class="form-control" id="date" name="treasury_id" required>
                                            <option value="">اختر الخزنه</option>
                                            @foreach ($treasuries as $treasury)
                                            <option value="{{ $treasury->id }}">{{ $treasury->name }} الرصيد
                                                --{{ $treasury->balance }}</option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label n_ro3ya"> اختر الخزنه
                                        </label>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4 form-floating ">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="note"
                                            id="n"></textarea>
                                        <label for="n" class=" col-form-label "> ملاحظات </label>
                                    </div>
                                    <div class="col-md-4 form-floating ">
                                        <input type="number" class="form-control" step="0.1" id="pay"
                                            placeholder="اجمالى سعر الشراء" name="total" required readonly>
                                        <label for="pay" class="col-form-label">اجمالى سعر الشراء</label>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> اسم الكتاب</th>
                                            <th> الكميه</th>
                                            <th> سعر الشراء للكتاب الواحد</th>
                                            <th> سعر البيع للكتاب الواحد</th>
                                            <td>الاجمالى</td>

                                            <th>العملية</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr>
                                            <td>
                                                <input type="name" class="form-control" placeholder="اسم الكتاب"
                                                    name="data[name][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control amount" step="0.1"
                                                    placeholder="الكميه" name="data[amount][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control buyPrice" step="0.1"
                                                    placeholder="سعر الشراء" name="data[buyPrice][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" step="0.1"
                                                    placeholder="سعر البيع" name="data[sellPrice][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control subTotal" step="0.1" readonly
                                                    placeholder="الاجمالى" name="data[subTotal][]">
                                            </td>
                                            <td>
                                                <button type="button" class="btn bg-success" id="add">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                </table>
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
                <div class="col-sm-12 col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float:right; font-weight:bold;"> شراء الكتب </h3>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        #
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        الاسم
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        التاريخ
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        المورد </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        اجمالى سعر الشراء</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($buyBooks as $key => $buyBook)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        عمليه الشراء رقم :{{ $buyBook->id }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $buyBook->date }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $buyBook->supplier }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $buyBook->totalBuyPrice }}
                                                    </td>
                                                    <td class="d-flex justify-content-center">

                                                        <button type="submit" class="btn bg-secondary">
                                                            <a href="{{ route('buyBooks.show', $buyBook->id) }}"
                                                                class="text-white"><i class="far fa-eye"
                                                                    aria-hidden="true"></i></a>
                                                        </button>


                                                        <button type="submit" class="btn bg-danger"
                                                            onclick="return confirm('Are you sure?')">
                                                            <a href="{{ route('buyBooks.destroy', $buyBook->id) }}"
                                                                class="text-white"><i class="far fa-trash-alt"
                                                                    aria-hidden="true"></i></a>
                                                        </button>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

<script>
    let add = document.getElementById('add'),
            tbody = document.getElementById('tbody');
        add.addEventListener(('click'), () => {
            var new_row = document.createElement('tr')
            new_row.innerHTML =
                `
                <td>
                    <input type="name" class="form-control" placeholder="اسم الكتاب"
                        name="data[name][]" required>
                </td>
                <td>
                    <input type="number" class="form-control amount" placeholder="الكميه"
                        name="data[amount][]" required>
                </td>
                <td>
                    <input type="number" class="form-control buyPrice"
                        placeholder="سعر الشراء" name="data[buyPrice][]" required>
                </td>
                <td>
                    <input type="number" class="form-control " placeholder="سعر البيع"
                        name="data[sellPrice][]" required>
                </td>
                <td>
                    <input type="number" class="form-control subTotal" step="0.1" placeholder="الاجمالى" readonly
                        name="data[subTotal][]">
                </td>
                <td>
                        <button type="button" class="btn bg-danger" onclick='delet(this),calculate()'>
                            <i class="fas fa-trash-alt text-light"></i>
                        </button>
                </td>`;
            tbody.appendChild(new_row)
        })

        function delet(ele) {
            ele.parentElement.parentElement.remove()
        }
</script>


<script>
    let pay = document.getElementById('pay'),
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
