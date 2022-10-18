@extends('admin.layouts.includes.master')
@section('title') تعديل شراء زى مدرسى @endsection
@section('content')
<script src="{{ asset('public/assets/plugins/jquery/jquery.min.js') }}"></script>
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
                    <div class="card card-info">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">بيع زى مدرسى</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('sellUniform.update', $sellUniformTotals->id) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-md-3 form-floating">
                                        <input type="date" class="form-control" id="date"
                                            value="{{ $sellUniformTotals->date }}" name="date" required>
                                        <label for="date" class="col-form-label"> التاريخ </label>
                                    </div>
                                    <div class="col-md-3 form-floating">
                                        <select required class="form-control js-example-basic-single" name="level_id"
                                            id="level_id">
                                            <option value="">اختر المرحلة</option>
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}" @if ($sellUniformTotals->level_id ==
                                                $level->id) selected @endif>
                                                {{ $level->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label"> المرحلة
                                        </label>
                                    </div>
                                    <div class="col-md-3 form-floating">
                                        <select required class="form-control  js-example-basic-single" name="child_id"
                                            id="child_id">
                                            @if($sellUniformTotals->child_id != "")
                                            <option value="{{$sellUniformTotals->child_id}}">
                                                {{$sellUniformTotals->children->name_ar}}</option>
                                            @endif
                                            <option value="">اختر الطفل</option>
                                        </select>
                                        <label for="namestore" class="col-form-label"> الطفل
                                        </label>
                                    </div>
                                    <div class="col-md-3 form-floating">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="notes"
                                            id="n">{{ $sellUniformTotals->notes }}</textarea>
                                        <label for="n" class=" col-form-label"> ملاحظات </label>
                                    </div>
                                    <div class="col-md-3 form-floating mt-3">
                                        <input type="number" class="form-control"
                                            value="{{ $sellUniformTotals->total }}" id="pay" step="0.1" readonly
                                            placeholder="اجمالى السعر" name="total" required>
                                        <label for="pay" class="col-form-label">اجمالى السعر</label>
                                    </div>
                                    <div class="col-md-3 form-floating mt-3">
                                        <select type="text" class="form-control" id="date" name="treasury_id" required>
                                            <option value="">اختر الخزينة</option>
                                            @foreach ($treasuries as $treasury)
                                            <option value="{{ $treasury->id }}" @if ($sellUniformTotals->treasury_id ==
                                                $treasury->id) selected @endif>
                                                {{ $treasury->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label"> اختر الخزينة
                                        </label>
                                    </div>
                                </div>
                                {{-- row 2 --}}
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>اختر الزى</th>
                                            <th>الكمية</th>
                                            <th>السعر</th>
                                            <th>العملية</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($sellUniforms as $key => $sellUniform)
                                        <tr>
                                            <td style="width: 25%;">
                                                <select required class="form-control items_id"
                                                    onchange="selectValue('items_id0',0)" name="data[buyUniform_id][]"
                                                    id="items_id0">
                                                    <option value="">اختر الزى</option>
                                                    @foreach($buyUniforms as $key => $buyUniform)
                                                    <option value="{{$buyUniform->id}}" @if($sellUniform->buyUniform_id
                                                        == $buyUniform->id) selected @endif>{{$buyUniform->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style=" width: 25%;">
                                                <input type="number" class="form-control amount"
                                                    value="{{ $sellUniform->quantity }}" id="name" step="0.1"
                                                    placeholder="الكمية" name="data[quantity][]">

                                            </td>
                                            <td style=" width: 25%;">
                                                <input type="number" class="form-control buyPrice"
                                                    value="{{ $sellUniform->price }}" id="name" step="0.1"
                                                    placeholder="السعر" name="data[price][]">

                                            </td>
                                            <td style=" width: 25%;">
                                                <input type="number" class="form-control" step="0.1" id="subTotal"
                                                    placeholder="الجملة" name="data[subTotal][]">
                                            </td>
                                            <td>
                                                <button type="button" class="btn bg-success" id="add">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-success-2 mr-3">
                                    <i class="fa fa-check text-light" aria-hidden="true"></i>
                                </button>
                                <button class="btn bg-secondary" title="back">
                                    <i class="fa fa-arrow-left"></i> <a href="{{ route('sellUniform.create') }}"></a>
                                </button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>

<script>
    let add = document.getElementById('add'),
        tbody = document.getElementById('tbody');

        add.addEventListener(('click'), () => {
            var new_row = document.createElement('tr')
            // new_row.classList.add('row')
            // new_row.classList.add('mb-3')
            // new_row.classList.add('align-items-center')
            new_row.innerHTML =
                `
                <td style="width: 25%;">
                <select required class="form-control items_id"
                onchange="selectValue('items_id0',0)" name="data[buyUniform_id][]"
                id="items_id0">
                <option value="">اختر الزى المدرسى</option>
                @foreach($buyUniforms as $key => $buyUniform)
                <option value="{{$buyUniform->id}}">{{$buyUniform->name}}</option>
                @endforeach
                </select>
                </td>
                <td style=" width: 25%;">
                <input type="number" class="form-control amount" step="0.1" id="name" placeholder="الكمية"
                name="data[quantity][]">
                </td>
                <td style=" width: 25%;">
                <input type="number" class="form-control buyPrice" step="0.1" id="name" placeholder="السعر"
                name="data[price][]">
                </td>
                <td style=" width: 25%;">
                <input type="number" class="form-control" step="0.1" id="subTotal"
                placeholder="الجملة" name="data[subTotal][]">
                </td>
                <td>
                <button type="button" class="btn bg-danger" onclick='delet(this),calculate()'>
                <i class="fas fa-trash-alt text-light"></i>
                </button>
                </td>`;
            tbody.appendChild(new_row)
        })
        function delet (ele) {
            ele.parentElement.parentElement.remove()
        }
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="data[buyUniform_id][]"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('sell.price.ajax',['id'=>':id'])}}';
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
                            $('.buyPrice').empty();
                            $('.buyPrice').val(data);
                            $('.buyPrice').trigger('change');
                        }
                    });
                } else {
                    $('select[name="amount"]').empty();
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

<script>
    let pay = document.getElementById('pay'),
            price;
        // دالة لحساب ناتج الضرب ال الكمبة * سعر الشراء
        function calculate() {
            let amount = document.querySelectorAll(".amount"),
                buyPrice = document.querySelectorAll(".buyPrice");
            price = 0
            for (let i = 0; i < amount.length; i++) {
                price = price + amount[i].value * 1 * buyPrice[i].value * 1
                pay.value = price * 1
            }
        }
        document.addEventListener('keyup', calculate);
</script>
@endsection
