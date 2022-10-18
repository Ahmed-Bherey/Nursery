@extends('admin.layouts.includes.master')
@section('title')
اضافة مديونية لمرحلة
@endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="{{ asset('public/select/jquery.min.js') }}"></script>
<!-- CSS forsearching -->
<link href="{{ asset('public/select/select2.min.css') }}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{ asset('public/select/select2.min.js') }}"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title">اضافه مديونيه لمرحله </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{ route('IndebtednessLevels.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-3 form-floating mt-3">
                                        <input required type="text" class="form-control" id="date" placeholder="" name="name" >
                                        <label for="date" class="col-form-label n_right2"> الاسم </label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 form-floating mt-3">
                                        <select required class="form-control js-example-basic-single" name="year_id"
                                            id="year_id">
                                            <option value="">اختر السنة الدراسية</option>
                                            @foreach($years as $key => $year)
                                            <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label n_right2">اختر السنة الدراسية
                                        </label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 form-floating mt-3">
                                        <select required class="form-control js-example-basic-single" name="level_id"
                                            id="level_id">
                                            <option value="">اختر المرحله</option>
                                            @foreach ($levels as $key => $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label n_right2"> اختر المرحله
                                        </label>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3 form-floating mt-3">
                                        <input type="number" class="form-control" step="0.1" id="pay"
                                            placeholder="اجمالي الرسوم" name="total" readonly>
                                        <label for="pay" class="col-form-label n_right2">الاجمالى</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-3 form-floating mt-3">
                                        <textarea class="form-control n_ro3ya" rows="1" placeholder="ملاحظات ..."
                                            name="note" id="n"></textarea>
                                        <label for="n" class=" col-form-label n_right2"> ملاحظات </label>
                                    </div>

                                </div>
                            </div>


                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>اختر الرسوم </th>
                                            <th> الكميه</th>
                                            <th>العملية</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr>
                                            <td class="select educationalExpense">
                                                <select required class="form-control  item_id"
                                                    name="educationalExpense_id[]" id="educationalExpense_id">
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control amount" step="0.1"
                                                    placeholder="قيمه الرسوم" name="amount[]" readonly="">
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
                            <h3 class="card-title" style="float:right; font-weight:bold;"> رسوم المراحل </h3>
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
                                                        المرحله
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        اجمالي الرسوم
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($IndebtednessLevels as $key => $IndebtednessLevel)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $IndebtednessLevel->name }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $IndebtednessLevel->levels->name }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $IndebtednessLevel->amount }}
                                                    </td>
                                                    <td class="d-flex justify-content-center">

                                                        <button type="submit" class="btn bg-secondary">
                                                            <a href="{{ route('IndebtednessLevels.show', [$IndebtednessLevel->name, $IndebtednessLevel->level_id]) }}"
                                                                class="text-white"><i class="far fa-eye"
                                                                    aria-hidden="true"></i></a>
                                                        </button>

                                                        <button type="submit" class="btn bg-secondary"
                                                            onclick="return confirm('Are you sure?')">
                                                            <a href="{{ route('IndebtednessLevels.destroy', [$IndebtednessLevel->name, $IndebtednessLevel->level_id]) }}"
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
                        <!-- /.card-body -->
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
                            $('.item_id').empty();
                            $.each(data, function(key, value) {
                                $('.item_id').append($('<option>', {
                                    value: value.id,
                                    text: value.name,
                                    price: value.amount,
                                }));
                            });
                            $('.item_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="educationalExpense_id"]').empty();
                }
            });


            $('select[name="educationalExpense_id[]"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route =
                    '{{ route('educationalExpense.ajaxAmount.ajax', ['level' => ':level', 'id' => ':id']) }}';
                route = route.replace(':level', stateID).replace(':id', $('.item_id option:selected')
                    .val());
                if (stateID) {
                    $.ajax({
                        beforeSend: function(x) {
                            return x.setRequestHeader('X-CSRF-TOKEN', csrf);
                        },
                        url: route,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('.amount').empty();
                            $('.amount').val(data);
                            $('.amount').trigger('change');
                        }
                    });
                } else {
                    $('select[name="unit_id"]').empty();
                }
            });


            $('select[name="year_id"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('educationalExpense.year.ajax', ['id' => ':id']) }}';
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
                            $('#level_id').empty();
                            $.each(data, function(key, value) {
                                $('#level_id').append($('<option>', {
                                    value: value.leavels.id,
                                    text: value.leavels.name,
                                }));
                            });
                            $('#level_id').trigger('change');
                        }
                    });
                } else {
                    $('select[name="year_id"]').empty();
                }
            });

        });
</script>
<script>
    let add = document.getElementById('add'),
            tbody = document.getElementById('tbody');

        add.addEventListener(('click'), () => {
            selectTd = document.querySelector('.select.educationalExpense');
            var new_row = document.createElement('tr')
            new_row.innerHTML =
                `<td> ${selectTd.innerHTML}</td>
                <td>
                    <input type="number" class="form-control amount" step="0.1"
                        placeholder="قيمه الرسوم" name="amount[]" readonly="">
                </td>
                <td>
                    <button type="button" class="btn bg-danger" onclick='delet(this)'>
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
    // حساب سعر الكتاب
        document.addEventListener('click', calculatePrice)
        pay.value = 0

        function calculatePrice() {
            let item_id = document.querySelectorAll('.item_id'),
                amount = document.querySelectorAll(".amount"),
                pay = document.getElementById('pay'),
                price;

            item_id.forEach((ele, index) => {
                ele.addEventListener('click', () => {
                    for (let i = 0; i < ele.children.length; i++) {
                        if (ele.value * 1 === ele.children[i].attributes.value.value * 1) {
                            amount[index].value = ele.children[i].attributes.price.value
                        }
                    }
                    price = 0
                    amount.forEach((ele, index) => {
                        price = price * 1 + ele.value * 1
                        pay.value = price * 1
                    })
                })
                // ele.addEventListener('click',calculate)
            })
        }
</script>
@endsection
