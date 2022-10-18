@extends('admin.layouts.includes.master')
@section('title') شراء كتب مدرسية @endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="{{asset('public/select/jquery.min.js')}}"></script>
<!-- CSS forsearching -->
<link href="{{asset('public/select/select2.min.css')}}" rel="stylesheet" />
<!-- JS for searching -->
<script src="{{asset('public/select/select2.min.js')}}"></script>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- {{-- start card --}}
            <div class="row mt-1">
                <div class="col-sm-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header header-bg">
                            <h3 class="card-title header-title"> بيع الكتب الدراسيه </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('admin.layouts.alerts.success')
                        @include('admin.layouts.alerts.error')
                        <form class="form-horizontal" action="{{route('sellBooks.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating ">
                                        <input type="date" class="form-control" id="date"
                                            value="<?php echo date('Y-m-d'); ?>" name="date" required>
                                        <label for="date" class="col-form-label n_ro3ya"> التاريخ </label>
                                    </div>

                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating ">
                                        <select required class="form-control js-example-basic-single" name="level_id"
                                            id="level_id">
                                            <option value="">اختر المرحله</option>
                                            @foreach($levels as $key => $level)
                                            <option value="{{ $level->id }}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="namestore" class="col-form-label n_ro3ya"> اختر المرحله
                                        </label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating ">
                                        <select required class="form-control js-example-basic-single" name="child_id"
                                            id="child_id">
                                            <option value="">اختر الطفل</option>

                                        </select>
                                        <label for="namestore" class="col-form-label n_ro3ya"> اختر الطفل
                                        </label>
                                    </div>

                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating ">
                                        <textarea class="form-control" rows="1" placeholder="ملاحظات ..." name="note"
                                            id="n"></textarea>
                                        <label for="n" class=" col-form-label "> ملاحظات </label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating">
                                        <input type="number" class="form-control" id="pay" step="0.1" readonly
                                            placeholder="اجمالي " name="total" required>
                                        <label for="pay" class="col-form-label ">الاجمالى</label>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 form-floating ">
                                        <select type="text" class="form-control" id="date" name="treasury_id" required>
                                            <option value="">اختر الخزنه</option>
                                            @foreach($treasuries as $treasury)
                                            <option value="{{$treasury->id}}">{{$treasury->name}} </option>
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
                                            <th> اسم الكتاب</th>
                                            <th> الكميه</th>
                                            <th>السعر</th>
                                            <th>الاجمالي</th>
                                            <th>العملية</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr>
                                            <td>
                                                <select required class="form-control item_id " name="data[book_id][]"
                                                    id="book_id">
                                                    <option value="">اختر الكتاب</option>
                                                    @foreach($buyBooks as $buyBook)
                                                    <option value="{{$buyBook->id}}" price='{{$buyBook->sellPrice}}'>
                                                        {{$buyBook->name}} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control amount" step="0.1"
                                                    placeholder="الكميه" name="data[amount][]" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control buyPrice" step="0.1"
                                                    placeholder="السعر " name="data[price][]">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control sub-Total" step="0.1"
                                                    placeholder="الاجمالي " name="data[subTotal][]" readonly>
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
                                                        المرحله
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        التاريخ </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        اجمالي </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        عمليات
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sellBooks as $key=> $sellBook)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $key+1}}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{$sellBook->childs->name_ar}}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $sellBook->levels->name }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $sellBook->date }}
                                                    </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $sellBook->total }}
                                                    </td>
                                                    <td class="d-flex justify-content-center">

                                                        <button type="submit" class="btn bg-info">
                                                            <a href="{{ route('sellBooks.print', $sellBook->id) }}"
                                                                type="submit"><i class="fa-solid fa-print"></i></a>
                                                        </button>

                                                        <button type="submit" class="btn bg-secondary">
                                                            <a href="{{ route('sellBooks.show', ['date'=>$sellBook->date,'child_id'=>$sellBook->child_id,'level_id'=>$sellBook->level_id]) }}"
                                                                class="text-white"><i class="far fa-eye"
                                                                    aria-hidden="true"></i></a>
                                                        </button>

                                                        <button type="submit" class="btn bg-secondary"
                                                            onclick="return confirm('Are you sure?')">
                                                            <a href="{{ route('sellBooks.destroy', ['date'=>$sellBook->date,'child_id'=>$sellBook->child_id,'level_id'=>$sellBook->level_id]) }}"
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
    // حساب سعر الكتاب
    document.addEventListener('click',calculatePrice)
    function calculatePrice() {
        let item_id = document.querySelectorAll('.item_id'),
            amount = document.querySelectorAll(".amount"),
            subTota = document.querySelectorAll(".sub-Total"),
            buyPrice = document.querySelectorAll(".buyPrice");

        amount.forEach((ele,index)=>{
            document.addEventListener('keyup', ()=>{
                subTota[index].value =  buyPrice[index].value * 1 * ele.value * 1
            });
        })
        item_id.forEach((ele,index)=>{
            ele.addEventListener('click',()=>{
                    for(let i=1 ; i<ele.children.length ; i++){
                    if (ele.value*1 === ele.children[i].attributes.value.value*1){
                        buyPrice[index].value=ele.children[i].attributes.price.value
                    }
                }
            })

            ele.addEventListener('click',calculate)
        })
    }

   // دالة لحساب ناتج الضرب ال الكمبة * سعر الشراء
    let   pay = document.getElementById('pay'),
        price;
        pay.value = 0
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
// add new row
    let add = document.getElementById('add'),
        tbody = document.getElementById('tbody');
        add.addEventListener(('click'), () => {
            var new_row = document.createElement('tr')
            new_row.innerHTML =
                `
                <td>
                    <select required class="form-control item_id " name="data[book_id][]"
                        id="book_id">
                        <option value="">اختر الكتاب</option>
                        @foreach($buyBooks as $buyBook)
                        <option value="{{$buyBook->id}}" price='{{$buyBook->sellPrice}}'>{{$buyBook->name}}</option>

                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control amount" step="0.1"
                        placeholder="الكميه" name="data[amount][]" required>
                </td>
                <td>
                    <input type="number" class="form-control buyPrice" step="0.1"
                        placeholder="السعر " name="data[price][]">
                </td>
                <td>
                                                <input type="number" class="form-control sub-Total" step="0.1"
                                                    placeholder="الاجمالي " name="data[subTotal][]" readonly>
                                            </td>
                <td>
                    <button type="button" class="btn bg-danger" onclick='delet(this) ,calculate()'>
                        <i class="fas fa-trash-alt text-light"></i>
                    </button>
                </td>`;
            tbody.appendChild(new_row)
        })
        function delet (ele ) {
            ele.parentElement.parentElement.remove()
        }
</script>

<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="data[book_id][]"]').on('change', function() {
                var stateID = $(this).val();
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var route = '{{ route('sellBooks.sellPrice.book.ajax',['id'=>':id'])}}';
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

@endsection
